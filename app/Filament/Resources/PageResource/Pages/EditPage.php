<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Models\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Icons\Heroicon;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('togglePublished')
                ->label(fn (Page $record): string => $record->is_published ? 'Desativar' : 'Ativar')
                ->icon(fn (Page $record): Heroicon => $record->is_published ? Heroicon::OutlinedEyeSlash : Heroicon::OutlinedEye)
                ->color(fn (Page $record): string => $record->is_published ? 'gray' : 'success')
                ->action(function (Page $record): void {
                    $record->update(['is_published' => ! $record->is_published]);

                    $this->refreshFormData(['is_published']);

                    Notification::make()
                        ->title($record->is_published ? 'Página ativada' : 'Página desativada')
                        ->body($record->is_published ? 'Ela voltou a aparecer no site.' : 'Ela saiu do site, mas o conteúdo continua salvo.')
                        ->success()
                        ->send();
                }),
        ];
    }
}
