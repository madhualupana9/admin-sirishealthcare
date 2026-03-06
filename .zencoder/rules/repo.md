---
description: Repository Information Overview
alwaysApply: true
---

# Admin Siris Healthcare Information

## Summary
Admin Siris Healthcare is a Laravel 11-based administrative portal designed for managing healthcare services. It features a modern frontend built with **Livewire**, **Volt**, and **Tailwind CSS**, providing a reactive and streamlined management interface. The system includes models for handling doctors, consultations, blogs, and hostels, suggesting a comprehensive management solution for a healthcare provider.

## Structure
- **app/**: Core application logic including Models, Controllers, and Service Providers.
- **bootstrap/**: Application initialization and configuration (e.g., `app.php` for routing and middleware).
- **config/**: Configuration files for various Laravel services (auth, database, mail, etc.).
- **database/**: Database schema migrations, factories, and seeders.
- **public/**: Web server root containing publicly accessible assets.
- **resources/**: Frontend source assets including CSS (Tailwind), JS (Vite), and Blade/Livewire views.
- **routes/**: Route definitions for web, console, and authentication.
- **tests/**: Automated tests (Feature and Unit) using PHPUnit.

## Language & Runtime
**Language**: PHP  
**Version**: ^8.2  
**Build System**: Composer, npm, Vite  
**Package Manager**: Composer (PHP), npm (Node.js)

## Dependencies
**Main Dependencies**:
- **laravel/framework**: ^11.31 (Core Framework)
- **livewire/livewire**: ^3.4 (Frontend Interactivity)
- **livewire/volt**: ^1.7.0 (Functional Livewire components)
- **laravel/tinker**: ^2.9 (REPL for Laravel)

**Development Dependencies**:
- **phpunit/phpunit**: ^11.0.1 (Testing)
- **laravel/breeze**: ^2.3 (Authentication scaffolding)
- **laravel/pint**: ^1.13 (Code styling)
- **laravel/sail**: ^1.26 (Dockerized development environment)
- **tailwindcss**: ^3.1.0 (CSS Framework)
- **vite**: ^6.0.11 (Frontend Asset Bundling)

## Build & Installation
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Build frontend assets
npm run build

# Generate application key
php artisan key:generate

# Run migrations (creates SQLite database by default if not present)
php artisan migrate
```

## Testing
**Framework**: PHPUnit  
**Test Location**: `tests/`  
**Naming Convention**: `*Test.php`  
**Configuration**: `phpunit.xml`

**Run Command**:
```bash
php artisan test
# OR
./vendor/bin/phpunit
```

## Main Files & Resources
- **app/Models/**: `Doctor.php`, `Consultation.php`, `Blog.php`, `Hostel.php`, `User.php`.
- **bootstrap/app.php**: Application bootstrapping, routing, and middleware configuration.
- **routes/web.php**: Main web entry point.
- **resources/js/app.js** & **resources/css/app.css**: Frontend entry points.
- **vite.config.js**: Vite configuration for asset bundling.
- **.env.example**: Template for environment variables.
