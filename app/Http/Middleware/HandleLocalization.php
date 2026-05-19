<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleLocalization
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
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
