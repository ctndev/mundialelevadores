<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $page = Page::query()->published()->where('slug', 'home')->firstOrFail();

        return view('pages.home', [
            'page' => $page,
            'settings' => SiteSetting::allCached(),
        ]);
    }

    public function show(string $slug): View
    {
        if ($slug === 'home') {
            abort(404);
        }

        $page = Page::query()->published()->where('slug', $slug)->firstOrFail();

        if ($page->template === 'home') {
            return view('pages.home', [
                'page' => $page,
                'settings' => SiteSetting::allCached(),
            ]);
        }

        if ($page->template === 'landing') {
            return view('pages.landing', [
                'page' => $page,
                'settings' => SiteSetting::allCached(),
            ]);
        }

        return view('pages.simple', [
            'page' => $page,
            'settings' => SiteSetting::allCached(),
        ]);
    }
}
