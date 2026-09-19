# Draft verification

- All three static pages have one H1, one main landmark, distinct titles, and preview noindex.
- Local page links, section anchors, images, and stylesheet paths resolve.
- All images have appropriate alternative-text attributes; purely conceptual decoration uses empty alt text.
- Navigation works without JavaScript. Focus indicators, skip link, responsive CSS, and print styles are included.
- Professional descriptions were checked against supplied biographical material. Proposed studies and future contributions are not presented as completed work.

## Hosted preview verification — September 19, 2026

- All three pages render in the isolated WPVibe draft on WordPress 7.1.1 / PHP 8.3.33. Uploaded PHP files passed WPVibe's syntax checks.
- Browser inspection covered desktop views of all three pages, the full Trajectory page, Home at 390 and 320 pixel frame widths, Research at 320 pixels, and Trajectory at 390 pixels.
- Home measured no horizontal overflow at either phone width. Secondary phone layouts were checked visually; automated frame measurement was unavailable after frame navigation.
- Main navigation preserves the draft preview token; the Research and Trajectory links loaded their expected titles and content. Local section anchors resolve.
- WordPress generates image dimensions and responsive sources from Media Library attachments 50–52. The portrait and both illustrations render. Fonts are self-hosted; the preview uses the intended IBM Plex typography.
- Draft output includes noindex/nofollow. No temporary diagnostics or preview tokens are committed to this repository.
- A Blocksy Companion editor enqueue callback required functions from the old theme. The new theme removes only those incompatible editor callbacks from its own frontend request. The plugin remains active for the live site.
- The preview also excludes Customizer CSS inherited from the old theme. No saved Customizer settings were changed.

This is a browser and functional review, not a complete accessibility audit. Existing legacy builder pages, publication settings, and post-activation behavior still require review before launch. A recent complete database and files backup has not been verified; obtain it before publication.

New draft pages and media attachments were added. Existing published content, the active theme, and DNS were not changed.
