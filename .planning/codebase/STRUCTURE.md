# Directory Structure

**Analysis Date:** 2026-08-07

## Core Organization
- `app/`: Core application code (Models, Controllers, Providers).
- `bootstrap/`: Application bootstrapping script.
- `config/`: Application configuration files.
- `database/`: Database migrations, model factories, and seeders.
- `public/`: Publicly accessible directory, containing `index.php` and compiled assets.
- `resources/`: Uncompiled assets, views (Blade templates), and language files.
- `routes/`: Application route definitions (`web.php`).
- `storage/`: Compiled Blade templates, file based sessions, and file caches.
- `tests/`: Automated tests (Feature and Unit).

## Key Files
- `composer.json` / `composer.lock`: PHP dependency management.
- `package.json` / `package-lock.json`: Frontend dependency management.
- `vite.config.js`: Vite build configuration for frontend assets.
- `.env`: Environment-specific configuration.
- `phpunit.xml`: Pest / PHPUnit testing configuration.

---
*Codebase analysis: 2026-08-07*
<!-- refreshed: 2026-08-07 -->
