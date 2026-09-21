# Verification notes

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

This is a browser and functional review, not a complete accessibility audit. The preview observations above describe the prelaunch state; the launch record below supersedes their publication status.

## Public launch verification — September 19, 2026

- Owner approved publication and confirmed completion of a DigitalOcean snapshot before launch.
- Published `kerry-thornhill-horizon` and native pages 53–55; page 53 is the static front page. Previous theme files remain installed, and former homepage 6 is preserved as a draft. Existing About page 2 remains published.
- Opened the public homepage, Research, and Trajectory without preview parameters. Each showed the intended content, one H1 and main landmark, and a correct canonical URL. Research and Trajectory images loaded successfully.
- Confirmed intended typography and the public Research layout visually. Contact email and X profile links match the owner's supplied details.
- WordPress `blog_public` is enabled. Public pages have no preview noindex directive or preview banner. This permits indexing; it does not establish search-engine inclusion.
- Phone and tablet coverage is documented in the preceding preview review; this launch check used the same approved styles on public desktop routes.

## September 21 release verification

- Compared live native content and theme files with the prior release before editing. Native revisions retain the old page text; page 2 remains recoverable as a draft. WPVibe backed up the active theme on publication.
- Reviewed Home, Research, and Trajectory on desktop and representative 320/390px phone frames. The full college name remains readable; measured phone content does not overflow its viewport.
- All three public routes have one H1/main, correct canonical URLs, complete affiliation, no unresolved tokens, no preview banner/noindex, and no broken in-page anchors. See `2026-09-21-live-checks.json`.
- Confirmed `/sample-page/` navigates to the current Trajectory. The PHP redirect uses status 301. The old page is no longer published.
- Reviewed new images and the retained portrait, contact and X links, research cross-links, and academic-status wording. No incorrect MA, CompTIA, DG Humana, or old performance percentage remains in the inspected active pages.
- Uploaded PHP files passed WPVibe syntax validation. `2026-09-21-home.jpg` records the public homepage.
- This was a browser/layout review, not a formal accessibility audit or a native-device/printed-PDF certification. No final résumé or preprint file was supplied for this release.
