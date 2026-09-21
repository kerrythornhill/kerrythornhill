# WordPress installation and maintenance

Target: https://kerrythornhill.com only.

## Current installation — September 21, 2026

The approved website is live. The active theme is `kerry-thornhill-horizon`; Home 53, Research 54, and Trajectory 55 are published. The static homepage is page 53. The owner confirmed completion of a DigitalOcean snapshot before publication. The previous theme remains installed. Former homepage 6 and the legacy About page 2 are preserved as drafts. `/sample-page/` and the legacy page-ID request redirect with HTTP 301 to `/trajectory/`. Native page revisions preserve the September 19 text. WPVibe saved the prior active theme as `kerry-thornhill-horizon-wpvibe-backup` during this update.

The instructions below describe a fresh installation or future review cycle. Do not reimport existing pages or treat the original draft theme as the current active theme.

## Before installation

Take a complete database and files backup. On the Droplet, the owner’s handoff additionally calls for a database export outside the web root before site changes. Preserve the active theme, existing homepage, existing About page, menus, and site options.

Before this launch, the site used Blocksy and Stackable. Existing builder content must not be replaced by an unreviewed bulk update. This theme provides ordinary fallback templates for existing pages, but their visual compatibility requires review before activation.

## Draft preview

The preferred route is WPVibe’s draft-theme workflow with its current plugin installed and activated. Create a new draft named **Kerry Thornhill — Horizon**, read the scaffold, and adapt it with these theme sources. Preserve the WPVibe draft preview hook if a hybrid scaffold is used. The shipped source itself uses ordinary CSS and does not require Tailwind.

For image assets, use the WordPress Media Library and record attachment IDs when deploying through WPVibe. The portable theme uses local optimized WebP assets for a conventional file installation. Never hotlink private Drive images or commit temporary preview tokens.

The original WordPress review draft was `kerry-thornhill-horizon-wpvibe-draft`. Its `config.json` records attachment IDs 50 (architecture), 51 (inquiry), 52 (portrait), 60 (evidence illustration), and 61 (machine-room illustration). On the configured domain, the renderer turns asset image tokens into native WordPress images with accurate responsive sources. On another installation, update the media mapping or use the bundled assets. The header retains WPVibe's preview token stylesheet hook.

Blocksy Companion's old-theme editor asset callbacks and inherited Customizer CSS are isolated within the new preview. No live plugin or Customizer settings were modified.

The theme includes its complete default content, so the design can be previewed before importing database pages. In a WPVibe draft, `site_view=home`, `site_view=research`, and `site_view=trajectory` select known routes; the draft token is preserved on navigation. Outside the draft, this query selector is ignored.

## Editable WordPress pages

After the backup, run the optional importer from the target WordPress installation:

```sh
wp eval-file /absolute/path/to/this-repository/tools/import-drafts.php
```

The script verifies the domain and creates new draft pages only. It preserves previously imported pages and refuses conflicting slugs. It does not activate the theme, publish pages, modify the old homepage, change settings, or execute arbitrary queries.

The pages use the `_horizon_route` metadata key with values `home`, `research`, and `trajectory`. Content is ordinary HTML and can be maintained through WordPress’s code editor. `[[research]]`, `[[trajectory]]`, and `[[home]]` tokens retain preview-aware links; `[[asset:filename.webp]]` tokens resolve bundled assets. Preserve the outer `main` element and section IDs when editing. If database content is edited, export it back into `content/` before rebuilding; do not overwrite it with an older repository snapshot.

The deployed pages are Home 53, Research 54, and Trajectory 55. Their HTML is wrapped in one Gutenberg Custom HTML block, which preserves the supplied page structure. Do not import duplicates.

## Publication

Review all three pages at desktop and phone widths, verify the current complete backup, and obtain explicit publication approval. Then publish the imported pages, activate the reviewed theme using the relevant host/plugin workflow, and assign the imported Home page as the static homepage. Preserve the old homepage as an archived draft only after confirming the replacement is working. The September 21 brief authorized consolidating the legacy About page into Trajectory; preserve its draft and the permanent redirect.

Confirm stable `/research/` and `/trajectory/` routes, metadata and canonical URLs, the email link, images, 404 page, and removal of preview noindex. Review existing plugin CSS, security controls, and caching in the actual host environment. Research links point to the corresponding stable Contestability records.

No server configuration, DNS, security settings, credentials, or other domains should be changed by this installation.

## Routine edits

Edit `content/*.html`, then run `python tools/build.py` to update the static preview and bundled theme fallbacks. Styles live in `theme/assets/site.css`; page titles and descriptions live in `theme/config.json`. Font licenses are included in `theme/assets/fonts/`. The design requires no client-side JavaScript and adds no analytics or submission form.
