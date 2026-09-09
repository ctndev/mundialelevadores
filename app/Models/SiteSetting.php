<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

#[Fillable(['key', 'value'])]
class SiteSetting extends Model
{
    public static function getValue(string $key, mixed $default = null): mixed
    {
        $all = static::allCached();

        return $all[$key] ?? $default;
    }

    /**
     * @return array<string, string|null>
     */
    public static function allCached(): array
    {
        return Cache::rememberForever('site_settings', function () {
            return static::query()->pluck('value', 'key')->all();
        });
    }

    public static function setValue(string $key, mixed $value): void
    {
        static::query()->updateOrCreate(
            ['key' => $key],
            ['value' => is_bool($value) ? ($value ? '1' : '0') : (is_array($value) ? json_encode($value) : $value)],
        );

        Cache::forget('site_settings');
    }

    /**
     * @param  array<string, mixed>  $values
     */
    public static function setMany(array $values): void
    {
        foreach ($values as $key => $value) {
            static::setValue($key, $value);
        }
    }

    public static function boolean(string $key, bool $default = false): bool
    {
        $value = static::getValue($key);

        if ($value === null || $value === '') {
            return $default;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @return list<string>
     */
    public static function contactNotificationEmails(): array
    {
        $emails = [];

        foreach (setting_array('contact_notification_emails') as $email) {
            $email = strtolower(trim((string) $email));

            if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emails[] = $email;
            }
        }

        return $emails;
    }
}
