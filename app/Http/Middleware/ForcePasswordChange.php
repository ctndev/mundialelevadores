<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordChange
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user instanceof User || ! $user->must_change_password) {
            return $next($request);
        }

        $panel = Filament::getCurrentOrDefaultPanel();

        if ($request->routeIs([
            $panel->generateRouteName('auth.profile'),
            $panel->generateRouteName('auth.logout'),
        ])) {
            return $next($request);
        }

        Notification::make()
            ->warning()
            ->title('Altere sua senha')
            ->body('Você está usando uma senha temporária. Defina uma senha segura para continuar.')
            ->send();

        return redirect()->to(Filament::getProfileUrl());
    }
}
