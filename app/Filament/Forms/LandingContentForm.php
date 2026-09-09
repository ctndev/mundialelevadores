<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs\Tab;

class LandingContentForm
{
    /**
     * @return array<int, Tab>
     */
    public static function tabs(): array
    {
        return [
            Tab::make('Hero')->schema([
                HomeContentForm::visibilityToggle('hero')->columnSpanFull(),
                TextInput::make('content.hero.eyebrow')->label('Linha auxiliar'),
                TextInput::make('content.hero.title')->label('Título')->columnSpanFull(),
                Textarea::make('content.hero.text')->label('Texto')->rows(4)->columnSpanFull(),
                TextInput::make('content.hero.primary_cta_label')->label('Botão principal'),
                TextInput::make('content.hero.primary_cta_text')->label('Mensagem WhatsApp do botão'),
                TextInput::make('content.hero.secondary_cta_label')->label('Botão secundário'),
                TextInput::make('content.hero.secondary_cta_url')->label('Link do botão secundário'),
                ...HomeContentForm::imageField('content.hero.image', 'Imagem de fundo'),
                Repeater::make('content.hero.slides')->label('Slides (opcional)')->schema([
                    ...HomeContentForm::imageField('image'),
                ])->collapsible()->reorderable(),
                Repeater::make('content.hero.badges')->label('Destaques')->schema([
                    TextInput::make('label')->label('Texto')->required(),
                ])->collapsible()->reorderable(),
            ])->columns(2),

            Tab::make('Sobre')->schema([
                HomeContentForm::visibilityToggle('about')->columnSpanFull(),
                TextInput::make('content.about.eyebrow'),
                TextInput::make('content.about.title')->columnSpanFull(),
                ...HomeContentForm::imageField('content.about.image'),
                TextInput::make('content.about.image_alt')->label('Alt da imagem'),
                Repeater::make('content.about.paragraphs')->label('Parágrafos')->schema([
                    Textarea::make('text')->rows(3)->required(),
                ])->columnSpanFull(),
                Repeater::make('content.about.stats')->label('Números')->schema([
                    TextInput::make('value')->label('Valor')->required(),
                    TextInput::make('label')->label('Rótulo')->required(),
                ])->columns(2),
            ])->columns(2),

            Tab::make('Vantagens')->schema([
                HomeContentForm::visibilityToggle('advantages')->columnSpanFull(),
                TextInput::make('content.advantages.eyebrow'),
                TextInput::make('content.advantages.title')->columnSpanFull(),
                Textarea::make('content.advantages.lead')->columnSpanFull(),
                Repeater::make('content.advantages.cards')->label('Cards')->schema([
                    TextInput::make('title')->label('Título')->required(),
                    Textarea::make('text')->label('Texto')->rows(2)->required(),
                ])->collapsible()->reorderable(),
            ]),

            Tab::make('Galeria')->schema([
                HomeContentForm::visibilityToggle('gallery')->columnSpanFull(),
                TextInput::make('content.gallery.eyebrow'),
                TextInput::make('content.gallery.title')->columnSpanFull(),
                TextInput::make('content.gallery.lead')->label('Linha auxiliar')->columnSpanFull(),
                Repeater::make('content.gallery.items')->schema([
                    ...HomeContentForm::imageField('image'),
                    TextInput::make('alt')->label('Alt'),
                ])->collapsible()->reorderable(),
            ]),

            Tab::make('Contato')->schema([
                HomeContentForm::visibilityToggle('contact')->columnSpanFull(),
                TextInput::make('content.contact.eyebrow'),
                TextInput::make('content.contact.title')->columnSpanFull(),
                Textarea::make('content.contact.text')->label('Texto')->rows(3)->columnSpanFull(),
                Textarea::make('content.contact.address')->label('Endereço')->rows(3),
                TextInput::make('content.contact.email')->email(),
                TextInput::make('content.contact.form_title')->label('Título do formulário'),
                TextInput::make('content.contact.form_product')->label('Produto no WhatsApp'),
                TextInput::make('content.contact.select_label')->label('Rótulo do select'),
                TextInput::make('content.contact.select_name')->label('Nome do campo (ex: paradas)'),
                TextInput::make('content.contact.form_button')->label('Botão do formulário'),
                Textarea::make('content.contact.form_note')->label('Nota do formulário'),
                Repeater::make('content.contact.phones')->label('Telefones')->schema([
                    TextInput::make('display')->label('Exibição')->required(),
                    TextInput::make('tel')->label('Tel (ex: +5585...)')->required(),
                ])->columns(2),
                Repeater::make('content.contact.subjects')->label('Opções do select')->schema([
                    TextInput::make('label')->required(),
                ]),
            ])->columns(2),
        ];
    }
}
