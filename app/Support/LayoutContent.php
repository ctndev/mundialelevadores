<?php

namespace App\Support;

class LayoutContent
{
    /**
     * Cabeçalho global do site — igual em todas as páginas.
     *
     * @return array<string, mixed>
     */
    public static function header(): array
    {
        $img = 'images';

        return [
            'logo' => $img.'/mef-logo-sm.png',
            'logo_alt' => 'Logo da Mundial Elevadores Fortaleza',
            'brand_name' => 'Mundial Elevadores',
            'brand_subtitle' => 'Fortaleza · Ceará',
            'whatsapp_label' => 'WhatsApp',
            'whatsapp_text' => 'Olá! Gostaria de falar com a Mundial Elevadores.',
            'menu' => [
                ['label' => 'Início', 'url' => '/'],
                ['label' => 'Serviços', 'url' => '/#servicos'],
                ['label' => 'Plataformas', 'url' => '/#plataformas'],
                ['label' => 'Elevac 200', 'url' => '/elevac'],
                ['label' => 'Marcas', 'url' => '/#marcas'],
                ['label' => 'Fornecedores', 'url' => '/#fornecedores'],
                ['label' => 'Contato', 'url' => '#contato'],
            ],
        ];
    }

    /**
     * Rodapé global do site — igual em todas as páginas.
     *
     * @return array<string, mixed>
     */
    public static function footer(): array
    {
        $img = 'images';

        return [
            'logo' => $img.'/mef-logo-sm.png',
            'whatsapp_icon' => $img.'/whatsapp-logo.svg',
            'whatsapp_text' => 'Olá! Gostaria de falar com a Mundial Elevadores.',
            'text' => 'Manutenção, modernização, montagem, assistência técnica e vendas de elevadores, plataformas de acessibilidade e monta-cargas em Fortaleza e em todo o Ceará.',
            'copyright' => 'Mundial Elevadores Fortaleza',
            'links' => [
                ['label' => 'Serviços', 'url' => '/#servicos'],
                ['label' => 'Plataformas', 'url' => '/#plataformas'],
                ['label' => 'Marcas', 'url' => '/#marcas'],
                ['label' => 'Fornecedores', 'url' => '/#fornecedores'],
                ['label' => 'Elevac 200', 'url' => '/elevac'],
            ],
            'columns' => [
                ['text' => 'Mundial Elevadores Fortaleza'],
                ['text' => 'Rua Coronel João Carneiro, 261 - Fátima'],
                ['text' => '(85) 9.8802-8067 · (85) 3231-6180'],
                ['text' => 'CREA-CE · ART em todos os serviços'],
            ],
        ];
    }
}
