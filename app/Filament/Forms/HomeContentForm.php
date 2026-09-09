<?php

namespace App\Filament\Forms;

use App\Models\Page;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Set;

class HomeContentForm
{
    public static function visibilityToggle(string $section): Toggle
    {
        return Toggle::make("content.{$section}.is_visible")
            ->label('Exibir esta seção no site')
            ->default(true)
            // O cast booleano do Toggle transforma a chave ausente em `false`,
            // por isso o valor gravado é lido direto do registro.
            ->formatStateUsing(fn (?Page $record): bool => data_get($record?->content, "{$section}.is_visible", true));
    }

    /**
     * @return array<int, TextInput|FileUpload>
     */
    public static function imageField(string $name, string $label = 'Imagem'): array
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

    /**
     * @return array<int, Tab>
     */
    public static function tabs(): array
    {
        return [
            Tab::make('Hero')->schema([
                self::visibilityToggle('hero')->columnSpanFull(),
                TextInput::make('content.hero.eyebrow')->label('Linha auxiliar'),
                TextInput::make('content.hero.title')->label('Título')->columnSpanFull(),
                Textarea::make('content.hero.text')->label('Texto')->rows(4)->columnSpanFull(),
                TextInput::make('content.hero.primary_cta_label')->label('Botão principal'),
                TextInput::make('content.hero.primary_cta_text')->label('Mensagem WhatsApp do botão'),
                TextInput::make('content.hero.secondary_cta_label')->label('Botão secundário'),
                TextInput::make('content.hero.secondary_cta_url')->label('Link do botão secundário'),
                Repeater::make('content.hero.slides')->label('Slides')->schema([
                    ...self::imageField('image'),
                ])->collapsible()->reorderable(),
                Repeater::make('content.hero.badges')->label('Destaques')->schema([
                    TextInput::make('label')->label('Texto')->required(),
                ])->collapsible()->reorderable(),
            ])->columns(2),

            Tab::make('Sobre')->schema([
                self::visibilityToggle('about')->columnSpanFull(),
                TextInput::make('content.about.eyebrow'),
                TextInput::make('content.about.title')->columnSpanFull(),
                ...self::imageField('content.about.image'),
                TextInput::make('content.about.image_alt')->label('Alt da imagem'),
                Repeater::make('content.about.paragraphs')->label('Parágrafos')->schema([
                    Textarea::make('text')->label('Texto')->rows(3)->required(),
                ])->columnSpanFull(),
                Repeater::make('content.about.stats')->label('Números')->schema([
                    TextInput::make('value')->label('Valor')->required(),
                    TextInput::make('label')->label('Descrição')->required(),
                ])->columns(2)->columnSpanFull(),
            ])->columns(2),

            Tab::make('Serviços')->schema([
                self::visibilityToggle('services')->columnSpanFull(),
                TextInput::make('content.services.eyebrow'),
                TextInput::make('content.services.title')->columnSpanFull(),
                Textarea::make('content.services.lead')->label('Introdução')->columnSpanFull(),
                Repeater::make('content.services.cards')->label('Cards com foto')->schema([
                    ...self::imageField('image'),
                    TextInput::make('image_alt')->label('Alt'),
                    TextInput::make('title')->label('Título')->required(),
                    Textarea::make('text')->label('Texto')->rows(3),
                ])->collapsible()->reorderable()->columnSpanFull(),
                Repeater::make('content.services.mini_cards')->label('Cards menores')->schema([
                    TextInput::make('title')->label('Título')->required(),
                    Textarea::make('text')->label('Texto')->rows(2),
                ])->columns(2)->collapsible()->reorderable()->columnSpanFull(),
            ]),

            Tab::make('Plataformas')->schema([
                self::visibilityToggle('platforms')->columnSpanFull(),
                TextInput::make('content.platforms.eyebrow'),
                TextInput::make('content.platforms.title')->columnSpanFull(),
                Textarea::make('content.platforms.lead')->label('Introdução (HTML permitido)')->rows(4)->columnSpanFull(),
                Repeater::make('content.platforms.cards')->label('Modelos')->schema([
                    ...self::imageField('image'),
                    TextInput::make('image_alt')->label('Alt'),
                    TextInput::make('title')->required(),
                    Textarea::make('text')->rows(2),
                ])->collapsible()->reorderable()->columnSpanFull(),
                Repeater::make('content.platforms.features')->label('Diferenciais')->schema([
                    TextInput::make('label')->required(),
                ])->columnSpanFull(),
                Section::make('Crédito acessibilidade')->schema([
                    TextInput::make('content.credit.eyebrow'),
                    TextInput::make('content.credit.title')->columnSpanFull(),
                    ...self::imageField('content.credit.image'),
                    TextInput::make('content.credit.image_alt')->label('Alt'),
                    TextInput::make('content.credit.cta_label')->label('Botão'),
                    TextInput::make('content.credit.cta_text')->label('Mensagem WhatsApp'),
                    Repeater::make('content.credit.paragraphs')->label('Parágrafos')->schema([
                        Textarea::make('text')->rows(3)->required(),
                    ])->columnSpanFull(),
                ])->columns(2)->columnSpanFull(),
            ]),

            Tab::make('Elevac')->schema([
                self::visibilityToggle('elevac')->columnSpanFull(),
                TextInput::make('content.elevac.eyebrow'),
                TextInput::make('content.elevac.title')->columnSpanFull(),
                Textarea::make('content.elevac.text')->rows(4)->columnSpanFull(),
                TextInput::make('content.elevac.cta_label')->label('Botão'),
                TextInput::make('content.elevac.cta_url')->label('Link do botão')->helperText('Use /elevac para a página do produto.'),
                ...self::imageField('content.elevac.image'),
                TextInput::make('content.elevac.image_alt')->label('Alt'),
            ])->columns(2),

            Tab::make('Marcas')->schema([
                self::visibilityToggle('brands')->columnSpanFull(),
                TextInput::make('content.brands.eyebrow'),
                TextInput::make('content.brands.title')->columnSpanFull(),
                Textarea::make('content.brands.lead')->columnSpanFull(),
                Textarea::make('content.brands.note')->label('Nota')->columnSpanFull(),
                Repeater::make('content.brands.items')->label('Marcas')->schema([
                    TextInput::make('name')->label('Nome')->required(),
                ]),
            ]),

            Tab::make('Fornecedores')->schema([
                self::visibilityToggle('suppliers')->columnSpanFull(),
                TextInput::make('content.suppliers.eyebrow'),
                TextInput::make('content.suppliers.title')->columnSpanFull(),
                Textarea::make('content.suppliers.lead')->columnSpanFull(),
                Repeater::make('content.suppliers.items')->schema([
                    TextInput::make('name')->label('Nome')->required(),
                    TextInput::make('text')->label('Descrição'),
                    Toggle::make('highlight')->label('Destaque'),
                ])->columns(3)->collapsible(),
            ]),

            Tab::make('Galeria')->schema([
                self::visibilityToggle('gallery')->columnSpanFull(),
                TextInput::make('content.gallery.eyebrow'),
                TextInput::make('content.gallery.title')->columnSpanFull(),
                Repeater::make('content.gallery.items')->schema([
                    ...self::imageField('image'),
                    TextInput::make('alt')->label('Alt'),
                ])->collapsible()->reorderable(),
            ]),

            Tab::make('FAQ')->schema([
                self::visibilityToggle('faq')->columnSpanFull(),
                TextInput::make('content.faq.eyebrow'),
                TextInput::make('content.faq.title')->columnSpanFull(),
                Repeater::make('content.faq.items')->schema([
                    TextInput::make('question')->label('Pergunta')->required(),
                    Textarea::make('answer')->label('Resposta')->rows(3)->required(),
                ])->collapsible(),
            ]),

            Tab::make('Contato')->schema([
                self::visibilityToggle('contact')->columnSpanFull(),
                TextInput::make('content.contact.eyebrow'),
                TextInput::make('content.contact.title')->columnSpanFull(),
                Textarea::make('content.contact.address')->label('Endereço')->rows(3),
                TextInput::make('content.contact.email')->email(),
                TextInput::make('content.contact.map_title')->label('Título do mapa'),
                TextInput::make('content.contact.map_embed')->label('URL do iframe do mapa')->columnSpanFull(),
                TextInput::make('content.contact.form_title')->label('Título do formulário'),
                TextInput::make('content.contact.form_button')->label('Botão do formulário'),
                Textarea::make('content.contact.form_note')->label('Nota do formulário'),
                Repeater::make('content.contact.phones')->label('Telefones')->schema([
                    TextInput::make('display')->label('Exibição')->required(),
                    TextInput::make('tel')->label('Tel (ex: +5585...)')->required(),
                ])->columns(2),
                Repeater::make('content.contact.subjects')->label('Assuntos')->schema([
                    TextInput::make('label')->required(),
                ]),
            ])->columns(2),
        ];
    }
}
