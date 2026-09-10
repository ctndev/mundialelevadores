<?php

namespace App\Support;

use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class SiteCache
{
    private const VERSION_KEY = 'site-cache-version';

    public static function get(string $key): mixed
    {
        return Cache::get(self::key($key));
    }

    public static function put(string $key, mixed $value): void
    {
        Cache::put(self::key($key), $value, Carbon::now()->addHours(24));
    }

    public static function remember(string $key, Closure $callback): mixed
    {
        return Cache::remember(
            self::key($key),
            Carbon::now()->addHours(24),
            $callback,
        );
    }

    public static function flush(): void
    {
        $version = (int) Cache::get(self::VERSION_KEY, 1);

        Cache::forever(self::VERSION_KEY, $version + 1);
    }

    private static function key(string $key): string
    {
        $version = (int) Cache::get(self::VERSION_KEY, 1);

        return "site-cache:{$version}:{$key}";
    }
}
