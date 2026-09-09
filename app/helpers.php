<?php

use App\Models\SiteSetting;

if (! function_exists('media_url')) {
    function media_url(?string $path): string
    {
        if (blank($path)) {
            return '';
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            return $path;
        }

        $path = ltrim($path, '/');

        if (str_starts_with($path, 'images/')) {
            return asset($path);
        }

        return asset('storage/'.$path);
    }
}

if (! function_exists('wa_url')) {
    function wa_url(?string $phone, string $text = ''): string
    {
        $phone = preg_replace('/\D+/', '', (string) $phone) ?: '';
        $query = $text !== '' ? '&text='.rawurlencode($text) : '';

        return 'https://api.whatsapp.com/send?phone='.$phone.$query;
    }
}

if (! function_exists('setting')) {
    function setting(string $key, mixed $default = null): mixed
    {
        return SiteSetting::getValue($key, $default);
    }
}

if (! function_exists('setting_array')) {
    /**
     * @param  array<string, mixed>  $default
     * @return array<string, mixed>
     */
    function setting_array(string $key, array $default = []): array
    {
        $value = SiteSetting::getValue($key);

        if (is_array($value)) {
            return $value;
        }

        if (blank($value)) {
            return $default;
        }

        $decoded = json_decode((string) $value, true);

        return is_array($decoded) ? $decoded : $default;
    }
}
