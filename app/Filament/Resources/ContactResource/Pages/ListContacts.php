<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Resources\Pages\ListRecords;

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
}
