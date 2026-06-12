# Dr. Manobendro Majumder, DVM — Portfolio Website

A professional portfolio WordPress website for **Dr. Manobendro Majumder**,
Upazila Livestock Officer, Baliakandi, Rajbari, Bangladesh.

The repository contains everything needed to launch the site on any standard
WordPress installation:

| Path | What it is |
|------|------------|
| `dist/dr-manobendro-portfolio.zip` | **Ready-to-upload theme ZIP** — install via *Appearance → Themes → Add New → Upload Theme* |
| `wp-content/themes/dr-manobendro-portfolio/` | Custom WordPress theme (PHP, CSS, JS, sample SVG images, block patterns, bundled demo content) |
| `demo-content/demo-content.xml` | Optional WXR demo content (same pages/posts, for manual import via the WordPress Importer) |

## Why it works with any page builder

All demo pages (Home, About, Services, Gallery, Contact) are composed of
**standard Gutenberg core blocks** — cover, columns, media-text, gallery,
buttons, tables and lists. Nothing is hard-coded into theme templates, so the
content can be opened and edited with:

- the built-in **Block Editor (Gutenberg)**,
- **Elementor**, **Divi**, **Beaver Builder**, **Brizy**, **SeedProd** and
  similar builders (they all edit regular page content).

The theme also ships two page templates for builders:

- **Full Width (Builder Friendly)** — theme header/footer, edge-to-edge
  content area, no page title (used by the demo Home page).
- **Blank Canvas (No Header/Footer)** — a completely blank page, ideal when a
  builder supplies its own header and footer (equivalent to "Elementor
  Canvas").

Three ready-made **block patterns** (hero, services grid, call-to-action) are
registered under the "Dr. Manobendro Portfolio" pattern category so sections
can be re-inserted anywhere.

## Installation (two steps)

1. **Install WordPress** (6.0+) on your host as usual.
2. **Upload the theme ZIP**: in the WordPress admin go to *Appearance →
   Themes → Add New → Upload Theme*, choose `dist/dr-manobendro-portfolio.zip`
   and click *Install Now*, then **Activate**.

That's it. On first activation the theme automatically installs the demo
website: it creates the Home, About, Services, Gallery, Blog and Contact
pages, three sample blog posts with categories and tags, builds the primary
navigation menu, enables pretty permalinks and sets Home as the static front
page. The installer runs only once and never touches existing content — if a
"home" page already exists it just wires up the front-page settings.

### Alternative: manual demo import

If you prefer to import content yourself (or want it on a site where the
demo installer already ran), use *Tools → Import → WordPress* with
`demo-content/demo-content.xml`. Note the XML version references images at a
root-relative path, so it assumes WordPress is installed at the domain root;
the bundled installer has no such limitation.

## Customising

- **Sample data**: every date, statistic, degree and phone number in the demo
  content is clearly marked sample data — replace it with real information
  before going live. The contact email used is `princedvm@gmail.com`.
- **Images**: the bundled images are original SVG illustrations stored in the
  theme at `assets/images/`. Replace them with real photographs by editing the
  image blocks in any builder, or upload photos to the Media Library and swap
  them in.
- **Colors and fonts**: edit `theme.json` (block editor palette) and the CSS
  variables at the top of `assets/css/main.css`.
- **Contact form**: install a form plugin (WPForms, Contact Form 7, Fluent
  Forms) and drop its block/shortcode into the Contact page where indicated.
- **Footer**: add widgets to the *Footer Widgets* area to replace the default
  contact details rendered by the theme.

## Theme features

- Sticky responsive header with mobile hamburger navigation
- Hero banner styling for inner pages, card-style blog archive
- Full block-editor support: wide/full alignments, editor styles, custom
  color palette and font sizes via `theme.json`
- Custom logo, two nav menu locations, footer widget area
- Translation-ready (`dr-manobendro-portfolio` text domain) — suitable for a
  Bengali translation
- No build step and no external dependencies (system font stack, bundled SVGs)
