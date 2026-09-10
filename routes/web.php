<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SeoController;
use App\Http\Middleware\CacheSiteResponse;
use Illuminate\Support\Facades\Route;

Route::post('/contato', [ContactController::class, 'store'])->name('contacts.store');

Route::middleware(CacheSiteResponse::class)->group(function (): void {
    Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');
    Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/{slug}', [PageController::class, 'show'])
        ->where('slug', '^(?!ctn-admin$).+')
        ->name('pages.show');
});
