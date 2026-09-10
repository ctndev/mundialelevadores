<?php

namespace App\Filament\Actions;

use App\Models\User;
use App\Support\AccessPassword;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class ResetUserPasswordAction
{
    public static function make(): Action
    {
        return Action::make('resetPassword')
            ->label('Resetar senha')
            ->icon(Heroicon::OutlinedKey)
            ->color('warning')
            ->requiresConfirmation()
            ->modalHeading('Resetar senha deste usuário?')
            ->modalDescription('Uma senha temporária de 6 números será enviada por e-mail. No próximo acesso, o usuário precisará definir uma senha segura.')
            ->modalSubmitActionLabel('Resetar senha')
            ->hidden(fn (User $record): bool => $record->is(Auth::user()))
            ->action(function (User $record): void {
                AccessPassword::issue($record, isReset: true);

                Notification::make()
                    ->success()
                    ->title('Senha resetada')
                    ->body('Um e-mail com a senha temporária foi enviado para '.$record->email.'.')
                    ->send();
            });
    }
}
