<?php

namespace App\Filament\Resources;

use App\Filament\Forms\HomeContentForm;
use App\Filament\Forms\LandingContentForm;
use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Páginas';

    protected static ?string $modelLabel = 'página';

    protected static ?string $pluralModelLabel = 'Páginas';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Página')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Dados')->schema([
                            TextInput::make('title')->label('Título')->required()->maxLength(255),
                            TextInput::make('slug')->label('Slug')->required()->unique(ignoreRecord: true)->helperText('Use home para a página inicial.'),
                            Select::make('template')
                                ->label('Modelo')
                                ->options([
                                    'home' => 'Home (landing)',
                                    'landing' => 'Landing (produto)',
                                    'simple' => 'Página simples',
                                ])
                                ->required()
                                ->live(),
                            Toggle::make('is_published')->label('Publicada')->default(true),
                            RichEditor::make('body')
                                ->label('Conteúdo')
                                ->columnSpanFull()
                                ->hidden(fn (Get $get): bool => in_array($get('template'), ['home', 'landing'], true)),
                        ])->columns(2),
                        Tab::make('SEO da página')->schema([
                            self::withCharacterLimit(TextInput::make('meta_title')->label('Meta title'), 70),
                            self::withCharacterLimit(Textarea::make('meta_description')->label('Meta description')->rows(3), 180),
                            TextInput::make('canonical')->label('Canonical (URL)'),
                            TextInput::make('og_title')->label('OG title'),
                            Textarea::make('og_description')->label('OG description')->rows(3),
                            TextInput::make('og_image')->label('OG image (URL ou caminho)'),
                            TextInput::make('robots')->label('Robots')->default('index,follow'),
                        ])->columns(2),
                        ...self::homeTabs(),
                        ...self::landingTabs(),
                    ]),
            ]);
    }

    /**
     * Mostra o limite enquanto o texto é digitado e explica o erro em português,
     * já que a aplicação não carrega as mensagens de validação traduzidas.
     */
    protected static function withCharacterLimit(TextInput|Textarea $field, int $limit): TextInput|Textarea
    {
        return $field
            ->maxLength($limit)
            ->live(onBlur: true)
            ->hint(fn (?string $state): string => mb_strlen((string) $state)."/{$limit}")
            ->hintColor(fn (?string $state): string => mb_strlen((string) $state) > $limit ? 'danger' : 'gray')
            ->validationMessages(['max' => "Use no máximo {$limit} caracteres."]);
    }

    /**
     * @return array<int, Tab>
     */
    protected static function homeTabs(): array
    {
        return array_map(function (Tab $tab): Tab {
            return $tab->hidden(fn (Get $get): bool => $get('template') !== 'home');
        }, HomeContentForm::tabs());
    }

    /**
     * @return array<int, Tab>
     */
    protected static function landingTabs(): array
    {
        return array_map(function (Tab $tab): Tab {
            return $tab->hidden(fn (Get $get): bool => $get('template') !== 'landing');
        }, LandingContentForm::tabs());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Título')->searchable()->sortable(),
                TextColumn::make('slug')->searchable(),
                TextColumn::make('template')->label('Modelo')->badge(),
                IconColumn::make('is_published')->label('Publicada')->boolean(),
                TextColumn::make('updated_at')->label('Atualizada')->since()->sortable(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
