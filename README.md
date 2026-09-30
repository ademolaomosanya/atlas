# Atlas

Enterprise content and digital experiences platform on WordPress. Built as a production-style engineering project: plugin + block theme, Composer PHP, Gutenberg, REST, tests, and CI.

Events exist only as a **data-architecture fixture**. The primary content type is **Experiences**.

## Stack

- PHP 8.3, Composer PSR-4 (`Atlas\` → `src/`)
- WordPress in Docker (`http://localhost:8080`)
- Block theme (`wordpress/wp-content/themes/atlas`)
- Plugin bootstrap (`wordpress/wp-content/plugins/atlas/atlas.php`)
- `@wordpress/scripts` for editor JS and `atlas/feature-card`

## Architecture

| Layer | Location | Responsibility |
|---|---|---|
| Bootstrap | `atlas.php` | Constants, autoload, activation rewrite flush |
| Orchestration | `src/Plugin.php` | Hooks only |
| Content | `src/PostTypes`, `src/Meta` | CPTs and registered meta (REST + caps) |
| HTTP | `src/Rest`, `src/Http` | Public `atlas/v1` API and pagination |
| Blocks | `src/Blocks`, `blocks/*/src` | `block.json` + webpack `build/` |
| Front | `src/Frontend` | Escaped experience details on singles |

PHP classes live in the repo `src/` and load via Composer. WordPress only sees the plugin under `wp-content/plugins/atlas/`. Inside namespaced PHP, use `\ATLAS_PLUGIN_DIR` (global constant).

## Local development

Do **not** run `docker compose down -v` (destroys MySQL volume).

```bash
docker compose up -d
composer install
npm install
npm run build
```

Unit tests require PHP 8.3 (the Docker WordPress image and GitHub Actions use 8.3; macOS `php` may still be 8.1):

```bash
php vendor/bin/phpunit
```

After pulling CPT/rewrite changes, deactivate and reactivate the Atlas plugin (or visit Permalinks and save) so `/experiences/` resolves.

## Product surfaces

- Theme: Site Editor templates, `theme.json` v3, hero pattern, skip link, reduced-motion and focus styles
- Experiences: `/experiences/`, editor “Experience details” panel (audience, CTA URL)
- Block: **Feature Card** (`atlas/feature-card`) — title, description, link text, URL
- REST (published only): `GET http://localhost:8080/wp-json/atlas/v1/experiences`

## Security and performance

- Meta writes require `edit_post` for that post
- REST list is public and **published** experiences only; output is titles/excerpts/permalinks/CTA
- Frontend strings and URLs are escaped
- `should_load_separate_core_block_assets` so unused block CSS/JS is not loaded globally
- Editor script is enqueued only in the block editor

## CI

GitHub Actions runs `composer test` and `npm run build` on `main` and pull requests.
