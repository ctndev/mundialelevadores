<?php

namespace App\Filament;

use App\Support\SiteCache;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;

class Dashboard extends BaseDashboard
{
    /**
     * @return array<Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('clearSiteCache')
                ->label('Limpar cache do site')
                ->icon(Heroicon::OutlinedArrowPath)
                ->color('gray')
                ->requiresConfirmation()
                ->modalHeading('Limpar todo o cache do site?')
                ->modalDescription('As páginas públicas serão atualizadas e o cache será recriado nos próximos acessos.')
                ->modalSubmitActionLabel('Limpar cache')
                ->action(function (): void {
                    SiteCache::flush();

                    Notification::make()
                        ->success()
                        ->title('Cache do site limpo')
                        ->send();
                }),
        ];
    }
}
