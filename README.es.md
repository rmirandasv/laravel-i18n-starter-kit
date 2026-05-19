# Laravel i18n Starter Kit

Un kit de inicio profesional basado en el [Starter Kit oficial de Laravel para React](https://laravel.com/docs/13.x/starter-kits#react) (**Laravel 13**, **Inertia.js v3** y **React 19**), con una capa extra de **internacionalización (i18n)** completamente sincronizada para el frontend y el backend.

[Read in English](README.md)

## Características

- **Base Oficial**: Construido directamente sobre el starter kit oficial de Laravel + Inertia + React.
- **i18n Full Stack**: Cambio de idioma sincronizado entre React (frontend) y Laravel (backend).
- **Soporte Bilingüe**: Listo para usar en **Inglés** y **Español**.
- **Localización Frontend**: Impulsado por `i18next` y `react-i18next`.
- **Localización Backend**: Middleware personalizado que lee la preferencia de idioma del frontend (vía cookie) y actualiza el locale de Laravel.
- **Selector de Idioma**: Componente de interfaz integrado en la cabecera lateral principal.
- **Interfaz Traducida**: Los ajustes de perfil, seguridad (incluyendo 2FA), gestión de equipos, panel de control y todas las páginas de autenticación (Login, Registro, etc.) ya están traducidos.
- **Validaciones Traducidas**: Conjunto completo de traducciones al español para los mensajes de validación por defecto de Laravel, autenticación y líneas de restablecimiento de contraseña.
- **Inertia v3 y React 19**: Aprovechando las últimas características del ecosistema.
- **Tailwind CSS v4**: Estilos modernos para todos los componentes.

## Requisitos

- PHP 8.3+
- Node.js y NPM
- SQLite (por defecto) u otra base de datos compatible.

## Instalación

### Usando el Instalador de Laravel
Puedes crear un nuevo proyecto usando el flag `--using`:
```bash
laravel new mi-app --using rmirandasv/laravel-i18n-starter-kit
```

### Usando Composer
Alternativamente, puedes usar `composer create-project`:
```bash
composer create-project rmirandasv/laravel-i18n-starter-kit mi-app
```

## Configuración

1. **Entrar al directorio del proyecto**:
   ```bash
   cd mi-app
   ```

2. **Ejecutar el script de configuración**:
   ```bash
   composer run setup
   ```
   *Esto instalará las dependencias, copiará el .env, generará las llaves y ejecutará las migraciones.*

3. **Iniciar desarrollo**:
   ```bash
   composer run dev
   ```

## Archivos Clave

- `resources/js/i18n/`: Configuración de i18next y archivos JSON de traducción.
- `app/Http/Middleware/HandleLocalization.php`: Sincroniza el idioma entre el frontend y el backend.
- `lang/`: Archivos de traducción PHP del backend (incluyendo el directorio `es`).

## Licencia

La Licencia MIT (MIT). Consulte el [Archivo de Licencia](LICENSE.md) para obtener más información.
