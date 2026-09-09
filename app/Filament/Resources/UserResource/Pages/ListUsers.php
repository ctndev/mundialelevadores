<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    public function getTitle(): string
    {
        return 'Usuários';
    }

    public function getSubheading(): ?string
    {
        return 'Quem pode acessar o painel e quando entrou pela última vez.';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Novo usuário'),
        ];
    }
}
