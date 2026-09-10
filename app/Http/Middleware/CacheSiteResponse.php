<?php

namespace App\Http\Middleware;

use App\Support\SiteCache;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheSiteResponse
{
    private const CSRF_PLACEHOLDER = '__SITE_CSRF_TOKEN__';

    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->isMethod('GET')) {
            return $next($request);
        }

        $cacheKey = 'response:'.hash('sha256', $request->getSchemeAndHttpHost().$request->getRequestUri());
        $cached = SiteCache::get($cacheKey);

        if (is_array($cached)) {
            return $this->responseFromCache($cached, $request);
        }

        $response = $next($request);

        if ($response->isSuccessful()) {
            SiteCache::put($cacheKey, [
                'content' => str_replace($request->session()->token(), self::CSRF_PLACEHOLDER, (string) $response->getContent()),
                'content_type' => $response->headers->get('Content-Type', 'text/html; charset=UTF-8'),
                'status' => $response->getStatusCode(),
            ]);
        }

        return $response;
    }

    /**
     * @param  array{content: string, content_type: string, status: int}  $cached
     */
    private function responseFromCache(array $cached, Request $request): Response
    {
        return new Response(
            str_replace(self::CSRF_PLACEHOLDER, $request->session()->token(), $cached['content']),
            $cached['status'],
            ['Content-Type' => $cached['content_type']],
        );
    }
}
