<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use App\Support\LayoutContent;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

/**
 * @property-read Schema $form
 */
class LayoutSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static ?string $navigationLabel = 'Cabeçalho e Rodapé';

    protected static ?string $title = 'Cabeçalho e Rodapé';

    protected static ?int $navigationSort = 10;

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'header' => setting_array('header', LayoutContent::header()),
            'footer' => setting_array('footer', LayoutContent::footer()),
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
                Section::make('Cabeçalho')
                    ->description('Aparece igual em todas as páginas do site.')
                    ->schema([
                        ...self::imageField('header.logo', 'Logo'),
                        TextInput::make('header.logo_alt')->label('Texto alternativo da logo'),
                        TextInput::make('header.brand_name')->label('Nome da marca'),
                        TextInput::make('header.brand_subtitle')->label('Subtítulo'),
                        TextInput::make('header.whatsapp_label')->label('Texto do botão WhatsApp'),
                        TextInput::make('header.whatsapp_text')->label('Mensagem padrão do WhatsApp')->columnSpanFull(),
                        Repeater::make('header.menu')
                            ->label('Menu')
                            ->schema([
                                TextInput::make('label')->label('Rótulo')->required(),
                                TextInput::make('url')->label('Link')->required()->helperText('Ex.: /, /elevac, /#servicos ou #contato.'),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->reorderable()
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Rodapé')
                    ->description('Aparece igual em todas as páginas do site.')
                    ->schema([
                        ...self::imageField('footer.logo', 'Logo'),
                        ...self::imageField('footer.whatsapp_icon', 'Ícone do WhatsApp flutuante'),
                        Textarea::make('footer.text')->label('Texto')->rows(3)->columnSpanFull(),
                        TextInput::make('footer.copyright')->label('Nome no copyright'),
                        TextInput::make('footer.whatsapp_text')->label('Mensagem do botão flutuante'),
                        Repeater::make('footer.links')
                            ->label('Links')
                            ->schema([
                                TextInput::make('label')->label('Rótulo')->required(),
                                TextInput::make('url')->label('Link')->required(),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->reorderable()
                            ->columnSpanFull(),
                        Repeater::make('footer.columns')
                            ->label('Coluna de informações')
                            ->schema([
                                TextInput::make('text')->label('Linha')->required(),
                            ])
                            ->collapsible()
                            ->reorderable()
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    /**
     * @return array<int, TextInput|FileUpload>
     */
    protected static function imageField(string $name, string $label): array
    {
        return [
            TextInput::make($name)
                ->label($label.' (URL ou caminho)')
                ->helperText('Cole uma URL ou o caminho gerado pelo envio ao lado.'),
            FileUpload::make($name.'_upload')
                ->label($label.' (enviar)')
                ->disk('public')
                ->directory('cms')
                ->image()
                ->visibility('public')
                ->dehydrated(false)
                ->afterStateUpdated(function ($state, Set $set) use ($name): void {
                    if (filled($state)) {
                        $set($name, is_array($state) ? (string) array_values($state)[0] : (string) $state);
                    }
                }),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        SiteSetting::setMany([
            'header' => $data['header'] ?? [],
            'footer' => $data['footer'] ?? [],
        ]);

        Notification::make()
            ->title('Cabeçalho e rodapé salvos')
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
