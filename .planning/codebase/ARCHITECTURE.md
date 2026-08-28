# Architecture

**Analysis Date:** 2026-08-07

## Pattern
- **MVC (Model-View-Controller)**: Standard Laravel application architecture.

## Data Flow
- **Entry Point**: `public/index.php` processes all incoming requests.
- **Routing**: Defined in `routes/web.php` and `routes/console.php`.
- **Controllers**: Located in `app/Http/Controllers/`.
- **Views**: Blade templates located in `resources/views/`.

## Layers
- **Routing**: `routes/` directory maps URLs to closures or controller methods.
- **Business Logic**: `app/Models/` (Eloquent ORM) and Controllers.
- **Service Providers**: `app/Providers/` for bootstrapping application services.

---
*Codebase analysis: 2026-08-07*
<!-- refreshed: 2026-08-07 -->
