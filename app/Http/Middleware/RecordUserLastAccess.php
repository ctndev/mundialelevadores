<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecordUserLastAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user instanceof User && ($user->last_access_at === null || $user->last_access_at->lt(now()->subMinute()))) {
            $user->forceFill(['last_access_at' => now()])->saveQuietly();
        }

        return $next($request);
    }
}
