# Project Structure

This document is generated from the current project index and code graph. It is intended as a quick map of the repository, not a full file dump.

## Overview

This is a Laravel 13 application with an Inertia + Vue 3 frontend and a Docker-based deployment path.

Main areas:

- `app/` contains the backend domain logic, controllers, models, middleware, and shared support code.
- `resources/` contains the Inertia/Vue UI and frontend styles.
- `routes/` defines web and console routes.
- `database/` contains migrations, factories, and seed data.
- `config/` contains application configuration.
- `public/` is the web root and build output target.
- `.github/workflows/` contains CI/CD automation for container publishing.

## Top-Level Tree

```text
.
├── .github/
│   └── workflows/
│       └── publish-ghcr.yml
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   ├── Providers/
│   └── Support/
├── bootstrap/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   ├── js/
│   │   ├── Components/
│   │   ├── Layouts/
│   │   └── Pages/
│   └── views/
├── routes/
├── tests/
├── Dockerfile
├── docker-compose.yml
├── docker-compose.prod.yml
├── .dockerignore
└── README.md
```

## Backend Structure

### `app/Http/Controllers`

Controllers are split by area:

- `Public/` handles public blog pages.
- `Admin/` handles CMS/admin actions such as posts, categories, settings, profile, visits, contacts, and security.
- `Auth/` handles login.

### `app/Http/Middleware`

- `HandleInertiaRequests.php` integrates shared props for Inertia.
- `TrackDailyVisit.php` tracks visit activity.

### `app/Http/Requests`

Form request validation is separated by feature area:

- `Auth/`
- `Admin/`
- `Public/`

### `app/Models`

Core data models:

- `User`
- `Post`
- `Category`
- `Contact`
- `Profile`
- `Setting`
- `DailyVisit`

### `app/Support`

- `WebpImage.php` handles image conversion and storage as WebP.

### `app/Providers`

- `AppServiceProvider.php` sets global view data and bootstrap-level defaults.

## Frontend Structure

### `resources/js/Layouts`

- `PublicLayout.vue` renders the public-facing site shell.
- `AdminLayout.vue` renders the CMS shell.

### `resources/js/Pages`

Pages are grouped by surface:

- `Public/` contains blog-facing pages such as home, post detail, contact, search, about, work, and category pages.
- `Admin/` contains dashboard and management screens for posts, categories, settings, profile, visits, contacts, auth, and security.

### `resources/js/Components`

Reusable UI pieces such as:

- pagination
- post lists
- sidebar cards

### `resources/js/app.js`

Bootstraps the Inertia app and loads Vue pages dynamically.

## Data Layer

### `database/migrations`

The schema includes:

- users
- categories
- posts
- contacts
- settings
- profiles
- daily visits
- cache and jobs tables
- profile avatar update

### `database/seeders`

- `DatabaseSeeder.php` populates initial admin data, categories, settings, profile data, and sample posts.

### `database/factories`

- `UserFactory.php`
- `CategoryFactory.php`
- `PostFactory.php`

## Routing

### `routes/web.php`

Main HTTP routing for public and admin pages.

### `routes/console.php`

Console route definitions and artisan command hooks.

## View Layer

### `resources/views/app.blade.php`

Main Blade entrypoint for the Inertia app.

## Build and Deployment

### Docker

- `Dockerfile` builds the production image.
- `docker-compose.yml` contains local support services.
- `docker-compose.prod.yml` is the production compose stack.
- `.dockerignore` reduces Docker build context.

### GitHub Actions

- `.github/workflows/publish-ghcr.yml` builds and pushes the image to GHCR for `linux/amd64`.

## Key Files

- [`routes/web.php`](/Users/loc/Herd/my-blog/routes/web.php)
- [`app/Providers/AppServiceProvider.php`](/Users/loc/Herd/my-blog/app/Providers/AppServiceProvider.php)
- [`app/Support/WebpImage.php`](/Users/loc/Herd/my-blog/app/Support/WebpImage.php)
- [`resources/js/app.js`](/Users/loc/Herd/my-blog/resources/js/app.js)
- [`database/seeders/DatabaseSeeder.php`](/Users/loc/Herd/my-blog/database/seeders/DatabaseSeeder.php)
- [`Dockerfile`](/Users/loc/Herd/my-blog/Dockerfile)
- [`docker-compose.prod.yml`](/Users/loc/Herd/my-blog/docker-compose.prod.yml)
- [`.github/workflows/publish-ghcr.yml`](/Users/loc/Herd/my-blog/.github/workflows/publish-ghcr.yml)

