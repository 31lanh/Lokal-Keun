# LokalKeun - UMKM Marketplace

## Overview
LokalKeun is a Laravel-based marketplace platform for Indonesian UMKM (small and medium enterprises). Users can browse, search, and discover local businesses across various categories.

## Tech Stack
- **Backend**: Laravel 12 (PHP 8.4)
- **Frontend**: Blade templates with Tailwind CSS, Alpine.js
- **Build Tool**: Vite
- **Database**: PostgreSQL (Neon-backed via Replit)

## Project Structure
```
app/                    # Laravel application code
  Http/Controllers/     # Request handlers
  Models/               # Eloquent models
bootstrap/              # Laravel bootstrap files
config/                 # Configuration files
database/migrations/    # Database migrations
public/                 # Public assets and entry point
resources/
  views/                # Blade templates
  css/                  # Stylesheets
  js/                   # JavaScript files
routes/                 # Route definitions
storage/                # File storage, cache, logs
```

## Running the Application
The application runs via the Laravel development server on port 5000:
```bash
php artisan serve --host=0.0.0.0 --port=5000
```

## Building Assets
```bash
npm run build
```

## Key Features
- User authentication (register/login)
- Multiple user roles: pembeli (buyer), penjual (seller), admin
- UMKM directory and search
- Category browsing
- Seller dashboard for managing business profiles
- Admin dashboard for moderation

## Environment Variables
Key environment variables are managed through Replit's secrets:
- APP_KEY: Application encryption key
- DB_CONNECTION: pgsql
- Database credentials (DB_HOST, DB_DATABASE, etc.)

## Recent Changes
- 2026-01-21: Initial setup on Replit with PostgreSQL database
- Configured trust proxy middleware for Replit's proxy environment
- Vite configured to allow all hosts for development
