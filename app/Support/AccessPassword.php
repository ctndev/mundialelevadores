<?php

namespace App\Support;

use App\Jobs\SendAccessCredentialsMailJob;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class AccessPassword
{
    public static function generateTemporary(): string
    {
        return str_pad((string) random_int(0, 999_999), 6, '0', STR_PAD_LEFT);
    }

    public static function rule(): Password
    {
        return Password::min(10)
            ->mixedCase()
            ->numbers()
            ->symbols();
    }

    public static function issue(User $user, bool $isReset = false): string
    {
        $temporaryPassword = self::generateTemporary();

        $user->forceFill([
            'password' => $temporaryPassword,
            'must_change_password' => true,
        ])->save();

        self::send($user, $temporaryPassword, $isReset);

        return $temporaryPassword;
    }

    public static function send(User $user, string $temporaryPassword, bool $isReset = false): void
    {
        SendAccessCredentialsMailJob::dispatch($user, $temporaryPassword, $isReset);
    }
}
