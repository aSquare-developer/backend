## BlogiBlogi Backend – Headless API (CakePHP 5)

This repository contains the **backend REST API** for BlogiBlogi, built with [CakePHP](https://cakephp.org) 5.x.
It is designed as a **headless JSON API** to be consumed by a separate frontend (e.g. Next.js).

## Requirements

- PHP 8.2+  
- Composer  
- A database supported by CakePHP (MySQL/MariaDB, PostgreSQL, etc.)  
- Web server (Apache/Nginx) or PHP built‑in server for local development

## Installation

1. **Clone the repository**

   ```bash
   git clone https://github.com/NTAVA/backend.git
   cd backend
   ```

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

3. **Configure environment**

   Copy the local config file if it does not exist yet and adjust it:

   ```bash
   cp config/app_local.example.php config/app_local.php
   ```

   Then edit `config/app_local.php` and set:

   - database connection under `'Datasources'`
   - any other environment‑specific options you need

4. **Set writable directories**

   Make sure the following directories are writable by the web server user:

   - `logs/`
   - `tmp/`

## Running the API

### Using the built‑in server (local development)

From the project root:

```bash
bin/cake server -p 8765
```

The API will be available at:

- `http://localhost:8765/` – health check / welcome JSON
- `http://localhost:8765/api/...` – future API endpoints

### Using Apache / Nginx

Point your virtual host document root to the `webroot/` directory and ensure
URL rewriting is enabled so that all requests go through `webroot/index.php`.

## API Overview

- Root route `/` is mapped to `ApiController::index()` and returns a simple JSON
  payload confirming that the API is online:

  ```json
  {
    "message": "Welcome to BlogiBlogi API",
    "version": "1.0.0",
    "status": "online"
  }
  ```

- All future resources will live under `/api` (see `config/routes.php`).
- `AppController` is configured to:
  - use `JsonView` globally
  - automatically serialize variables set via `$this->set()` into JSON
- `ErrorController` returns errors as JSON instead of HTML templates.

## Development notes

- Global middleware is defined in `src/Application.php` (routing, error handling, JSON body parsing).
- Shared controller logic and JSON configuration lives in `src/Controller/AppController.php`.
- API‑specific controllers are placed under `src/Controller/` (e.g. `ApiController`).

Feel free to adapt this README as the API grows (add endpoints, authentication,
versioning details, etc.).
