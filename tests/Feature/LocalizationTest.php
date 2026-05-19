<?php

use Illuminate\Support\Facades\App;

it('sets the locale based on the i18nextLng cookie', function (string $locale) {
    $this->withUnencryptedCookie('i18nextLng', $locale)
        ->get('/')
        ->assertStatus(200);

    expect(App::getLocale())->toBe($locale);
})->with(['en', 'es']);

it('defaults to app locale if no cookie is present', function () {
    $this->get('/')
        ->assertStatus(200);

    expect(App::getLocale())->toBe(config('app.locale'));
});

it('sanitizes region codes in the cookie', function () {
    $this->withUnencryptedCookie('i18nextLng', 'es-ES')
        ->get('/')
        ->assertStatus(200);

    expect(App::getLocale())->toBe('es');
});

it('ignores unsupported locales', function () {
    $defaultLocale = config('app.locale');

    $this->withUnencryptedCookie('i18nextLng', 'fr')
        ->get('/')
        ->assertStatus(200);

    expect(App::getLocale())->toBe($defaultLocale);
});
