<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $navigationLabel = 'Usuários';

    protected static ?string $slug = 'usuarios';

    protected static ?string $modelLabel = 'usuário';

    protected static ?string $pluralModelLabel = 'Usuários';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 30;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Nome')->required()->maxLength(255),
                TextInput::make('email')->label('E-mail')->email()->required()->unique(ignoreRecord: true)->maxLength(255),
                TextInput::make('password')
                    ->label('Senha')
                    ->password()
                    ->revealable()
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->confirmed()
                    ->helperText(fn (string $operation): string => $operation === 'edit' ? 'Deixe em branco para manter a senha atual.' : ''),
                TextInput::make('password_confirmation')
                    ->label('Confirmar senha')
                    ->password()
                    ->revealable()
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->dehydrated(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nome')->searchable()->sortable(),
                TextColumn::make('email')->label('E-mail')->searchable()->sortable(),
                TextColumn::make('last_access_at')
                    ->label('Último acesso')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('Nunca')
                    ->sortable(),
            ])
            ->defaultSort('last_access_at', 'desc')
            ->recordActions([
                EditAction::make()->label('Editar'),
                DeleteAction::make()
                    ->label('Excluir')
                    ->hidden(fn (User $record): bool => $record->is(Auth::user())),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Excluir selecionados')
                        ->using(function ($records): void {
                            $records
                                ->reject(fn (User $record): bool => $record->is(Auth::user()))
                                ->each->delete();
                        }),
                ]),
            ])
            ->emptyStateHeading('Nenhum usuário cadastrado')
            ->emptyStateDescription('Crie um usuário para acessar o painel.');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
