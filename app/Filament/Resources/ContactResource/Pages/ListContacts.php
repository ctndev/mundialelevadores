<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\TagsInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    public function getTitle(): string
    {
        return 'Contatos do site';
    }

    public function getSubheading(): ?string
    {
        return 'Pedidos de orçamento e vistoria enviados pelo formulário do site.';
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('notificationEmails')
                ->label('E-mails de aviso')
                ->icon(Heroicon::OutlinedEnvelope)
                ->fillForm(fn (): array => [
                    'emails' => SiteSetting::contactNotificationEmails(),
                ])
                ->schema([
                    TagsInput::make('emails')
                        ->label('Destinatários')
                        ->placeholder('Digite um e-mail e pressione Enter')
                        ->nestedRecursiveRules(['email'])
                        ->helperText('Cada endereço recebe um e-mail separado quando alguém envia o formulário do site.'),
                ])
                ->action(function (array $data): void {
                    $emails = [];

                    foreach ($data['emails'] ?? [] as $email) {
                        $email = strtolower(trim((string) $email));

                        if ($email !== '') {
                            $emails[] = $email;
                        }
                    }

                    SiteSetting::setValue('contact_notification_emails', array_values($emails));

                    Notification::make()
                        ->title('E-mails de aviso salvos')
                        ->success()
                        ->send();
                }),
        ];
    }
}
