<?php

namespace App\Filament\Auth;

use App\Support\AccessPassword;
use Filament\Actions\Action;
use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Facades\Hash;
use SensitiveParameter;

class EditProfile extends BaseEditProfile
{
    private bool $wasForcedPasswordChange = false;

    public function getTitle(): string
    {
        return $this->mustChangePassword() ? 'Definir nova senha' : parent::getTitle();
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeSave(#[SensitiveParameter] array $data): array
    {
        if ($this->mustChangePassword() && filled($data['password'] ?? null)) {
            $this->wasForcedPasswordChange = true;
            $data['must_change_password'] = false;
        }

        return $data;
    }

    protected function getRedirectUrl(): ?string
    {
        return $this->wasForcedPasswordChange ? Filament::getUrl() : null;
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label($this->mustChangePassword() ? 'Nova senha' : __('filament-panels::auth/pages/edit-profile.form.password.label'))
            ->validationAttribute(__('filament-panels::auth/pages/edit-profile.form.password.validation_attribute'))
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->rule(AccessPassword::rule())
            ->showAllValidationMessages()
            ->autocomplete('new-password')
            ->required($this->mustChangePassword())
            ->helperText('Use no mínimo 10 caracteres, com letras minúsculas e maiúsculas, números e símbolos.')
            ->dehydrated(fn (#[SensitiveParameter] $state): bool => filled($state))
            ->dehydrateStateUsing(fn (#[SensitiveParameter] $state): string => Hash::make($state))
            ->live(debounce: 500)
            ->same('passwordConfirmation');
    }

    protected function getPasswordConfirmationFormComponent(): Component
    {
        return TextInput::make('passwordConfirmation')
            ->label(__('filament-panels::auth/pages/edit-profile.form.password_confirmation.label'))
            ->validationAttribute(__('filament-panels::auth/pages/edit-profile.form.password_confirmation.validation_attribute'))
            ->password()
            ->autocomplete('new-password')
            ->revealable(filament()->arePasswordsRevealable())
            ->required()
            ->visible(fn (Get $get): bool => $this->mustChangePassword() || filled($get('password')))
            ->dehydrated(false);
    }

    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->hidden($this->mustChangePassword());
    }

    private function mustChangePassword(): bool
    {
        $user = $this->getUser();

        return (bool) $user->getAttribute('must_change_password');
    }
}
