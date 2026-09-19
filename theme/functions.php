<?php
if (!defined('ABSPATH')) { exit; }
function horizon_config() {
    static $config = null;
    if ($config === null) { $config = json_decode(file_get_contents(__DIR__ . '/config.json'), true); }
    return $config;
}
function horizon_is_draft() { return get_option('wpvibe_draft_theme') === get_stylesheet(); }
function horizon_key() {
    $pages = horizon_config()['pages'];
    if (horizon_is_draft() && isset($_GET['site_view'])) {
        $key = sanitize_key(wp_unslash($_GET['site_view']));
        if (isset($pages[$key])) { return $key; }
    }
    if (is_front_page()) { return 'home'; }
    $key = get_post_meta(get_queried_object_id(), '_horizon_route', true);
    return isset($pages[$key]) ? $key : '';
}
function horizon_record($key) {
    if (!isset(horizon_config()['pages'][$key])) { return null; }
    $posts = get_posts(array('post_type'=>'page','post_status'=>horizon_is_draft() ? array('publish','draft','pending') : 'publish','numberposts'=>1,'meta_key'=>'_horizon_route','meta_value'=>$key,'orderby'=>'ID','order'=>'ASC'));
    return $posts ? $posts[0] : null;
}
function horizon_url($key) {
    if (!isset(horizon_config()['pages'][$key])) { return home_url('/'); }
    if (horizon_is_draft()) {
        $args = array('site_view'=>$key);
        if (isset($_GET['wpvibe_preview'])) { $args['wpvibe_preview'] = sanitize_text_field(wp_unslash($_GET['wpvibe_preview'])); }
        return add_query_arg($args, home_url('/'));
    }
    if ($key === 'home') { return home_url('/'); }
    $post = horizon_record($key);
    return $post ? get_permalink($post) : home_url('/' . $key . '/');
}
function horizon_tokens($html) {
    // Let WordPress generate accurate image dimensions and responsive sources.
    // A different installation falls back to the portable assets in this theme.
    $media = horizon_config()['media'] ?? array();
    if (untrailingslashit(home_url()) === horizon_config()['domain'] && $media) {
        $html = preg_replace_callback('/<img\b[^>]*>/i', function($match) use ($media) {
            $tag = new WP_HTML_Tag_Processor($match[0]);
            if (!$tag->next_tag('IMG')) { return $match[0]; }
            $src = $tag->get_attribute('src');
            if (!is_string($src) || !preg_match('/^\[\[asset:([a-z]+)-\d+\.webp\]\]$/', $src, $asset)) { return $match[0]; }
            $id = (int) ($media[$asset[1]] ?? 0);
            if (!$id) { return $match[0]; }
            $attrs = array('alt'=>(string) $tag->get_attribute('alt'));
            foreach (array('class','sizes','loading','fetchpriority','decoding') as $name) {
                $value = $tag->get_attribute($name);
                if (is_string($value)) { $attrs[$name] = $value; }
            }
            return wp_get_attachment_image($id, 'full', false, $attrs) ?: $match[0];
        }, $html);
    }
    return preg_replace_callback('/\[\[(asset:)?([a-zA-Z0-9_.\/-]+)\]\]/', function($m) {
        if (!empty($m[1])) {
            if (strpos($m[2], '..') !== false) { return ''; }
            return esc_url(get_template_directory_uri() . '/assets/' . $m[2]);
        }
        return esc_url(horizon_url($m[2]));
    }, $html);
}
function horizon_partial($name) {
    if (!in_array($name, array('header','footer'), true)) { return; }
    $html = file_get_contents(__DIR__ . '/partials/' . $name . '.html');
    $key = horizon_key();
    if ($key) { $html = str_replace('data-route="' . $key . '"', 'data-route="' . $key . '" aria-current="page"', $html); }
    echo horizon_tokens($html); // Trusted theme HTML; token URLs are escaped above.
}
function horizon_render($key) {
    if (!isset(horizon_config()['pages'][$key])) { return; }
    $post = horizon_record($key);
    if ($post && trim($post->post_content) !== '') {
        echo horizon_tokens(apply_filters('the_content', $post->post_content));
    } else {
        echo horizon_tokens(file_get_contents(__DIR__ . '/content/' . $key . '.html'));
    }
}
add_action('after_setup_theme', function() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form','gallery','caption','style','script'));
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_editor_style('editor.css');
});
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('horizon-design', get_template_directory_uri() . '/assets/site.css', array(), filemtime(__DIR__ . '/assets/site.css'));
});
// Blocksy Companion can register its old theme's editor assets before WPVibe
// switches a request to this preview. Those callbacks require Blocksy functions.
// Remove only that integration from this theme's frontend enqueue hook.
add_action('wp_enqueue_scripts', function() {
    global $wp_filter;
    if (function_exists('blocksy_get_wp_parent_theme') || empty($wp_filter['wp_enqueue_scripts'])) { return; }
    foreach ($wp_filter['wp_enqueue_scripts']->callbacks as $priority => $callbacks) {
        foreach ($callbacks as $callback) {
            $fn = $callback['function'];
            $scope = '';
            if ($fn instanceof Closure) {
                $class = (new ReflectionFunction($fn))->getClosureScopeClass();
                $scope = $class ? $class->getName() : '';
            } elseif (is_array($fn)) {
                $scope = is_object($fn[0]) ? get_class($fn[0]) : (string) $fn[0];
            }
            if (strpos($scope, 'Blocksy\\Editor\\') === 0) { remove_action('wp_enqueue_scripts', $fn, $priority); }
        }
    }
}, 0);

// The draft must not inherit Customizer CSS belonging to the live theme.
add_filter('wp_get_custom_css', function($css) { return horizon_is_draft() ? '' : $css; }, 100);
add_filter('body_class', function($classes) { $classes[] = horizon_config()['body_class']; return $classes; });
add_filter('pre_get_document_title', function($title) {
    $key = horizon_key();
    return $key ? horizon_config()['pages'][$key]['title'] : $title;
});
add_action('wp_head', function() {
    $key = horizon_key();
    if (!$key) { return; }
    $page = horizon_config()['pages'][$key];
    echo '<meta name="description" content="' . esc_attr($page['description']) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($page['title']) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($page['description']) . '">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    if (!horizon_is_draft()) { echo '<meta property="og:url" content="' . esc_url(horizon_url($key)) . '">' . "\n"; }
    if (!has_site_icon()) {
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"><rect width="64" height="64" fill="#112c40"/><text x="32" y="42" text-anchor="middle" font-size="29" font-family="Georgia,serif" fill="#f5f3ec">KT</text></svg>';
        echo '<link rel="icon" href="data:image/svg+xml,' . esc_attr(rawurlencode($icon)) . '" type="image/svg+xml">' . "\n";
    }
}, 5);
add_filter('wp_robots', function($robots) {
    if (horizon_is_draft()) { $robots['noindex'] = true; $robots['nofollow'] = true; unset($robots['index']); }
    return $robots;
});
add_action('template_redirect', function() {
    if (horizon_is_draft()) { nocache_headers(); header('X-Robots-Tag: noindex, nofollow', true); }
});
