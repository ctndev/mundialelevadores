<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Support\HomeContent;
use App\Support\LandingContent;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (($data['template'] ?? null) === 'home' && empty($data['content'])) {
            $data['content'] = HomeContent::default();
        }

        if (($data['template'] ?? null) === 'landing' && empty($data['content'])) {
            $data['content'] = LandingContent::elevac();
        }

        return $data;
    }
}
