<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Support\AccessPassword;
use Filament\Resources\Pages\CreateRecord;
use SensitiveParameter;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    private ?string $temporaryPassword = null;

    public function getTitle(): string
    {
        return 'Novo usuário';
    }

    public function getSubheading(): ?string
    {
        return 'Uma senha temporária de 6 números será enviada por e-mail. O usuário deverá alterá-la no primeiro acesso.';
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(#[SensitiveParameter] array $data): array
    {
        $this->temporaryPassword = AccessPassword::generateTemporary();
        $data['password'] = $this->temporaryPassword;
        $data['must_change_password'] = true;

        return $data;
    }

    protected function afterCreate(): void
    {
        if ($this->temporaryPassword === null) {
            return;
        }

        AccessPassword::send($this->getRecord(), $this->temporaryPassword);
    }
}
