# Kerry Thornhill — Horizon

A personal research website connecting practical experience, interdisciplinary inquiry, and public purpose.

## Pages

- Home: human judgment and technological possibility.
- Research: meaningful challenge, independent evidence around AI, relational answerability, and the work ahead.
- Trajectory: leadership, infrastructure, operational experience, and graduate study.

`content/` is the editable HTML source. `theme/` is the portable classic WordPress theme. `preview/` contains a static rendering of the same content and styling.

Build locally with Python 3:

```sh
python tools/build.py
```

Open `review.html` for a self-contained review with page and viewport controls. It embeds the selected artwork and fonts and needs no server. Alternatively, open `preview/index.html` or serve the repository with a local static HTTP server. No npm installation or JavaScript framework is required. The production website itself does not require JavaScript; only the standalone review controls use it.

## Status

Live at https://kerrythornhill.com/ since September 19, 2026, using `kerry-thornhill-horizon`. Home, Research, and Trajectory are published, editable WordPress pages (IDs 53, 54, and 55); page 53 is the static homepage. The former homepage is preserved as a draft, and the former theme remains installed. Publication followed owner approval and confirmation of a completed DigitalOcean snapshot. This repository does not automatically deploy.

See [INSTALL.md](INSTALL.md) for the WordPress import and review process, and [qa/NOTES.md](qa/NOTES.md) for validation limits.

## Design

Warm paper, deep navy, copper-orange, and luminous architectural imagery. IBM Plex Sans Condensed headings, IBM Plex Serif reading text, and IBM Plex Mono labels are self-hosted. The accompanying OFL files cover the font assets.

Theme code is GPL-2.0-or-later. Text, portrait, and supplied artwork are not included in that code license; see [ASSETS.md](ASSETS.md).
