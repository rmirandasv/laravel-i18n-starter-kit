# Internationalization (i18n) Integration Skill

This skill provides precise instructions for implementing a synchronized internationalization (i18n) system in Laravel + Inertia + React applications. It ensures that both the frontend (UI) and backend (validation messages, emails, etc.) share the same locale state seamlessly.

## Prerequisites & Validation

Before starting, you MUST verify that the project uses the correct technology stack:
1. Use the `mcp_laravel-boost_application-info` tool to inspect the project.
2. Confirm the presence of:
   - `laravel/framework`
   - `inertiajs/inertia-laravel`
   - `@inertiajs/react`
   - `react`
3. If any of these are missing, inform the user that this skill is specifically designed for Laravel + Inertia + React stacks.

## Required File Structure

- `lang/{locale}/`: Laravel PHP translation files.
- `resources/js/i18n/`: i18next configuration.
- `resources/js/i18n/locales/`: Frontend JSON translation files.
- `app/Http/Middleware/HandleLocalization.php`: Backend locale synchronization.

## Implementation Instructions

### Phase 1: Dependencies and Frontend Core
1. **Install dependencies:** Run `npm install i18next react-i18next i18next-browser-languagedetector`.
2. **Configure i18next:** Create `resources/js/i18n/index.ts`. It MUST be configured to cache the language in a cookie so the backend can read it.
   ```typescript
   import i18n from "i18next";
   import LanguageDetector from "i18next-browser-languagedetector";
   import { initReactI18next } from "react-i18next";
   import en from "./locales/en.json";
   import es from "./locales/es.json";

   const resources = {
     en: { translation: en },
     es: { translation: es },
   };

   i18n
     .use(LanguageDetector)
     .use(initReactI18next)
     .init({
       resources,
       supportedLngs: ["en", "es"],
       fallbackLng: "en",
       detection: {
         order: ["cookie", "localStorage", "navigator"],
         lookupCookie: "i18nextLng",
         caches: ["cookie", "localStorage"],
         cookieOptions: { path: "/", sameSite: "lax" },
       },
       interpolation: {
         escapeValue: false,
       },
     });

   export default i18n;
   ```
3. **Translation Hook:** Create `resources/js/hooks/use-translation.ts` exporting `useTranslation` from `react-i18next`.
4. **App Initialization:** Add `import "./i18n";` to `resources/js/app.tsx`.

### Phase 2: Backend Synchronization (Middleware)
To ensure Laravel recognizes the language changed in React, create a middleware that reads the `i18nextLng` cookie.

1. **Create Middleware:** Run `php artisan make:middleware HandleLocalization`.
2. **Implement Logic:**
   ```php
   <?php

   namespace App\Http\Middleware;

   use Closure;
   use Illuminate\Http\Request;
   use Symfony\Component\HttpFoundation\Response;

   class HandleLocalization
   {
       public function handle(Request $request, Closure $next): Response
       {
           $locale = $request->cookie('i18nextLng');
           
           // i18next sometimes saves formats like "en-US", we just want the primary locale "en"
           if ($locale) {
               $locale = explode('-', $locale)[0];
           } else {
               $locale = config('app.locale');
           }

           if (in_array($locale, ['en', 'es'])) {
               app()->setLocale($locale);
           }

           return $next($request);
       }
   }
   ```
3. **Register Middleware:** Add `HandleLocalization::class` to the `web` middleware group in `bootstrap/app.php`.
4. **Cookie Encryption Exception:** In `bootstrap/app.php`, add `'i18nextLng'` to the `$middleware->encryptCookies(except: ['i18nextLng'])` array so the middleware can read the raw cookie set by the frontend.

### Phase 3: UI Components
1. **LanguageSelector:** Create a UI component (e.g., in `resources/js/components/language-selector.tsx`).
   - It must call `i18n.changeLanguage(code)` when a user selects a language.
   - Example: `<button onClick={() => i18n.changeLanguage('es')}>Español</button>`
2. **Layout Integration:** Place the `<LanguageSelector />` component in the main application header or sidebar layout.

### Phase 4: Validation and SSR
1. **HTML Lang Attribute:** Update `resources/views/app.blade.php` to set the language dynamically:
   `<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">`

## Verification Checklist
- [ ] Is the tech stack verified using `mcp_laravel-boost_application-info`?
- [ ] Does changing the language in the UI update React components instantly?
- [ ] Upon refreshing the page (`F5`), does the backend return validation messages or strings in the selected language?
- [ ] Is the `i18nextLng` cookie present in network requests?
- [ ] Does the `<html lang="...">` attribute update to match the active language?
