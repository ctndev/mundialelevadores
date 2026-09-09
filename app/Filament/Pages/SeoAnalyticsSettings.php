<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

/**
 * @property-read Schema $form
 */
class SeoAnalyticsSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static ?string $navigationLabel = 'SEO e Analytics';

    protected static ?string $title = 'SEO e Analytics';

    protected static ?int $navigationSort = 20;

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'ga_enabled' => SiteSetting::boolean('ga_enabled'),
            'ga_measurement_id' => SiteSetting::getValue('ga_measurement_id', ''),
            'robots_extra' => SiteSetting::getValue('robots_extra', ''),
            'site_name' => SiteSetting::getValue('site_name', ''),
            'whatsapp' => SiteSetting::getValue('whatsapp', ''),
            'email' => SiteSetting::getValue('email', ''),
            'address' => SiteSetting::getValue('address', ''),
            'postal_code' => SiteSetting::getValue('postal_code', ''),
            'city' => SiteSetting::getValue('city', ''),
            'region' => SiteSetting::getValue('region', ''),
            'area_served' => SiteSetting::getValue('area_served', ''),
            'jsonld_description' => SiteSetting::getValue('jsonld_description', ''),
            'og_image' => SiteSetting::getValue('og_image', ''),
            'logo' => SiteSetting::getValue('logo', ''),
        ]);
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema
            ->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Google Analytics')
                    ->schema([
                        Toggle::make('ga_enabled')->label('Ativar Google Analytics'),
                        TextInput::make('ga_measurement_id')
                            ->label('ID de medição (GA4)')
                            ->placeholder('G-XXXXXXXXXX')
                            ->helperText('O script gtag só é inserido no site se estiver ativo e com ID.'),
                    ]),
                Section::make('robots.txt')
                    ->schema([
                        Textarea::make('robots_extra')
                            ->label('Regras extras')
                            ->rows(6)
                            ->helperText('O arquivo já bloqueia /ctn-admin e aponta o sitemap. Use este campo para linhas adicionais.'),
                    ]),
                Section::make('Dados do negócio (SEO estruturado)')
                    ->schema([
                        TextInput::make('site_name')->label('Nome do site'),
                        TextInput::make('whatsapp')->label('WhatsApp (somente números, com DDI)'),
                        TextInput::make('email')->email()->label('E-mail'),
                        Textarea::make('address')->label('Endereço')->rows(2),
                        TextInput::make('postal_code')->label('CEP'),
                        TextInput::make('city')->label('Cidade'),
                        TextInput::make('region')->label('UF'),
                        TextInput::make('area_served')->label('Área de atuação'),
                        Textarea::make('jsonld_description')->label('Descrição (JSON-LD)')->rows(3),
                        TextInput::make('og_image')->label('Imagem padrão OG (URL)'),
                        TextInput::make('logo')->label('Logo (URL ou caminho)'),
                    ])->columns(2),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        SiteSetting::setMany($data);

        Notification::make()
            ->title('Configurações salvas')
            ->success()
            ->send();
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getFormContentComponent(),
            ]);
    }

    public function getFormContentComponent(): Component
    {
        return Form::make([EmbeddedSchema::make('form')])
            ->id('form')
            ->livewireSubmitHandler('save')
            ->footer([
                Actions::make([
                    Action::make('save')
                        ->label('Salvar')
                        ->submit('save'),
                ]),
            ]);
    }
}
