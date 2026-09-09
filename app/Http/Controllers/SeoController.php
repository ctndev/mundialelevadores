<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function robots(): Response
    {
        $extra = trim((string) SiteSetting::getValue('robots_extra', ''));
        $sitemap = rtrim((string) config('app.url'), '/').'/sitemap.xml';

        $lines = [
            'User-agent: *',
            'Allow: /',
            'Disallow: /ctn-admin',
            'Disallow: /ctn-admin/',
            '',
            'Sitemap: '.$sitemap,
        ];

        if ($extra !== '') {
            $lines[] = '';
            $lines[] = $extra;
        }

        return response(implode("\n", $lines)."\n", 200)
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    public function sitemap(): Response
    {
        $pages = Page::query()->published()->orderBy('slug')->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        foreach ($pages as $page) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>'.e($page->publicUrl())."</loc>\n";
            $xml .= '    <lastmod>'.$page->updated_at->toAtomString()."</lastmod>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
