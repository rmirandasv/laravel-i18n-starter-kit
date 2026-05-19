# Laravel i18n Starter Kit

A professional starter kit based on the official [Laravel React Starter Kit](https://laravel.com/docs/13.x/starter-kits#react) (**Laravel 13**, **Inertia.js v3**, and **React 19**), featuring an extra layer for a fully synchronized **internationalization (i18n)** system for both frontend and backend.

[Leer en Español](README.es.md)

## Features

- **Official Base**: Built directly on top of the official Laravel + Inertia + React starter kit.
- **Full Stack i18n**: Synchronized language switching between React (frontend) and Laravel (backend).
- **Dual Language Support**: Ready to use in **English** and **Spanish**.
- **Frontend Localization**: Powered by `i18next` and `react-i18next`.
- **Backend Localization**: Custom middleware that reads the frontend language preference (via cookie) and updates the Laravel locale.
- **Language Selector**: Integrated UI component in the main sidebar header.
- **Translated UI**: Profile settings, Security (including 2FA), Team management, Dashboard, and all Auth pages (Login, Register, etc.) are already translated.
- **Translated Validations**: Full set of Spanish translations for Laravel's default validation messages, authentication, and password reset lines.
- **Inertia v3 & React 19**: Leveraging the latest features of the ecosystem.
- **Tailwind CSS v4**: Modern styling for all components.

## Requirements

- PHP 8.3+
- Node.js & NPM
- SQLite (default) or other supported database.

## Installation

### Using Laravel Installer
You can create a new project using the `--using` flag:
```bash
laravel new my-app --using rmirandasv/laravel-i18n-starter-kit
```

### Using Composer
Alternatively, you can use `composer create-project`:
```bash
composer create-project rmirandasv/laravel-i18n-starter-kit my-app
```

## Setup

1. **Enter the project directory**:
   ```bash
   cd my-app
   ```

2. **Run the setup script**:
   ```bash
   composer run setup
   ```
   *This will install dependencies, copy .env, generate keys, and run migrations.*

3. **Start development**:
   ```bash
   composer run dev
   ```

## Key Files

- `resources/js/i18n/`: i18next configuration and JSON translation files.
- `app/Http/Middleware/HandleLocalization.php`: Synchronizes language between frontend and backend.
- `lang/`: Backend PHP translation files (including the `es` directory).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
