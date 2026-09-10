<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Actions\ResetUserPasswordAction;
use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public function getTitle(): string
    {
        return 'Editar usuário';
    }

    protected function getHeaderActions(): array
    {
        return [
            ResetUserPasswordAction::make(),
            DeleteAction::make()
                ->label('Excluir')
                ->hidden(fn (User $record): bool => $record->is(Auth::user())),
        ];
    }
}
