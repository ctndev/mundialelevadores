<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInbox;

    protected static ?string $navigationLabel = 'Contatos do site';

    protected static ?string $slug = 'contatos';

    protected static ?string $modelLabel = 'contato';

    protected static ?string $pluralModelLabel = 'Contatos do site';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 5;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        $count = Contact::query()->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Contatos enviados pelo formulário do site';
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components(self::detailEntries());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->label('Recebido')->dateTime('d/m/Y H:i')->sortable(),
                TextColumn::make('name')->label('Nome')->searchable()->sortable(),
                TextColumn::make('phone')
                    ->label('Telefone')
                    ->searchable()
                    ->url(fn (Contact $record): string => wa_url($record->phone))
                    ->openUrlInNewTab()
                    ->tooltip('Abrir conversa no WhatsApp'),
                TextColumn::make('message')->label('Mensagem')->limit(60)->wrap()->placeholder('—')->searchable(),
                TextColumn::make('product')->label('Produto')->placeholder('—')->toggleable(),
                TextColumn::make('page')->label('Página')->placeholder('—')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Filter::make('with_message')
                    ->label('Somente com mensagem')
                    ->query(fn ($query) => $query->whereNotNull('message')),
            ])
            ->recordActions([
                ViewAction::make()->label('Ver')->infolist(self::detailEntries()),
                DeleteAction::make()->label('Excluir'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Excluir selecionados'),
                ]),
            ])
            ->emptyStateHeading('Nenhum contato recebido ainda')
            ->emptyStateDescription('Os pedidos enviados pelo formulário do site aparecem aqui.');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
        ];
    }

    /**
     * @return array<int, TextEntry>
     */
    protected static function detailEntries(): array
    {
        return [
            TextEntry::make('name')->label('Nome'),
            TextEntry::make('phone')
                ->label('Telefone / WhatsApp')
                ->url(fn (Contact $record): string => wa_url($record->phone))
                ->openUrlInNewTab(),
            TextEntry::make('message')->label('Mensagem')->placeholder('Não informada')->columnSpanFull(),
            TextEntry::make('product')->label('Produto')->placeholder('—'),
            TextEntry::make('page')->label('Página de origem')->placeholder('—'),
            TextEntry::make('created_at')->label('Recebido em')->dateTime('d/m/Y H:i'),
        ];
    }
}
