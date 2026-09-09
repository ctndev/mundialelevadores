<?php

namespace App\Support;

class LandingContent
{
    /**
     * Conteúdo padrão da landing Elevac 200, a partir do modelo em HTML.
     *
     * @return array<string, mixed>
     */
    public static function elevac(): array
    {
        $img = 'images';

        return [
            'hero' => [
                'eyebrow' => 'Elevador residencial',
                'title' => 'Elevac 200',
                'text' => 'Elevador inteligente, panorâmico e muito charmoso, para novas construções e ideal para edificações já prontas. O Elevac atende de 2 a 4 andares em casas, apartamentos duplex e tríplex, escritórios e outros ambientes.',
                'primary_cta_label' => 'Pedir orçamento no WhatsApp',
                'primary_cta_text' => 'Olá! Quero um orçamento do Elevac 200.',
                'secondary_cta_label' => 'Ver galeria',
                'secondary_cta_url' => '#galeria',
                'image' => $img.'/elevac1-2000x1335.jpg',
                'slides' => [],
                'badges' => [
                    ['label' => '2 a 4 andares'],
                    ['label' => 'Sem poço e sem casa de máquinas'],
                    ['label' => 'Instalação em 3 a 5 dias'],
                    ['label' => 'Visão panorâmica de 360º'],
                ],
            ],
            'about' => [
                'id' => 'sobre',
                'eyebrow' => 'Praticidade',
                'title' => 'Conforto e status, sem grandes obras',
                'image' => $img.'/elevac2-1400x934.jpg',
                'image_alt' => 'Elevador residencial panorâmico Elevac 200 instalado em residência',
                'paragraphs' => [
                    ['text' => 'O Elevac 200 é muito prático, pois dispensa grandes obras de instalação, sem a necessidade de poço e de casa de máquinas, cabos ou pistões. É autoportante e instalado entre 3 e 5 dias, conforme o número de paradas.'],
                    ['text' => 'Tanto para quem quer valorizar o imóvel, introduzindo um item de extremo conforto e status, quanto para pessoas com dificuldades de locomoção, o Elevac 200 é uma alternativa excelente entre custo e benefício. É transparente e oferece uma visão panorâmica de 360º.'],
                ],
                'stats' => [
                    ['value' => '2-4', 'label' => 'paradas atendidas'],
                    ['value' => '3-5', 'label' => 'dias de instalação'],
                    ['value' => '360º', 'label' => 'visão panorâmica'],
                ],
            ],
            'advantages' => [
                'eyebrow' => 'Vantagens',
                'title' => 'Por que escolher o Elevac 200',
                'lead' => 'Um elevador leve, silencioso e econômico, pensado para residências e ambientes já prontos.',
                'cards' => [
                    ['title' => 'Instalação simplificada', 'text' => 'Sem quebra-quebra e sem interferir na rotina da casa.'],
                    ['title' => 'Não precisa de poço nem casa de máquinas', 'text' => 'Estrutura autoportante, sem cabos e sem pistões.'],
                    ['title' => 'Ideal para imóveis prontos', 'text' => 'Também indicado para novas construções e reformas.'],
                    ['title' => 'Leve e super-resistente', 'text' => 'Estrutura em alumínio e policarbonato compacto.'],
                    ['title' => 'Baixíssimo consumo de energia', 'text' => 'Consumo comparável a um eletrodoméstico comum.'],
                    ['title' => 'Superseguro', 'text' => 'Funcionamento seguro mesmo em falta de energia elétrica.'],
                ],
            ],
            'gallery' => [
                'eyebrow' => 'Galeria',
                'title' => 'Elevac 200 instalado',
                'lead' => 'Clique nas fotos para ampliar.',
                'items' => [
                    ['image' => $img.'/elevac1-2000x1335-800x534.jpg', 'alt' => 'Elevac 200 panorâmico em sala de estar'],
                    ['image' => $img.'/elevac2-1400x934-800x533.jpg', 'alt' => 'Elevac 200 instalado em residência de dois pavimentos'],
                    ['image' => $img.'/elevac3-1400x934-800x533.jpg', 'alt' => 'Cabine transparente do Elevac 200'],
                    ['image' => $img.'/elevac4-1400x934-800x533.jpg', 'alt' => 'Elevac 200 em ambiente interno com acabamento em vidro'],
                    ['image' => $img.'/elevac5-2000x1335-800x534.jpg', 'alt' => 'Detalhe da estrutura em alumínio do Elevac 200'],
                    ['image' => $img.'/elevac6-2000x1335-800x534.jpg', 'alt' => 'Elevac 200 servindo pavimento superior de casa'],
                    ['image' => $img.'/4-2000x1335-800x534.jpg', 'alt' => 'Instalação de elevador residencial pela Mundial Elevadores'],
                    ['image' => $img.'/8-2000x1335-800x534.jpg', 'alt' => 'Elevador residencial entregue pela Mundial Elevadores em Fortaleza'],
                ],
            ],
            'contact' => [
                'eyebrow' => 'Contato',
                'title' => 'Quer o Elevac 200 na sua casa?',
                'text' => 'Fale com a nossa equipe: fazemos a avaliação do ambiente, indicamos o modelo ideal e enviamos a proposta técnica. Atendemos Fortaleza e todo o estado do Ceará.',
                'address' => "Rua Coronel João Carneiro, 261 - Fátima\n60040-560 Fortaleza - Ceará",
                'email' => 'mundialelevadores.for@gmail.com',
                'form_title' => 'Solicite um orçamento do Elevac 200',
                'form_button' => 'Enviar pelo WhatsApp',
                'form_note' => 'Ao enviar, abrimos o WhatsApp com a sua mensagem preenchida.',
                'form_product' => 'Elevac 200',
                'select_label' => 'Número de paradas',
                'select_name' => 'paradas',
                'phones' => [
                    ['display' => '(85) 9.8802-8067', 'tel' => '+5585988028067'],
                    ['display' => '(85) 9.9991-0050', 'tel' => '+5585999910050'],
                    ['display' => '(85) 3231-6180', 'tel' => '+558532316180'],
                ],
                'subjects' => [
                    ['label' => '2 paradas'],
                    ['label' => '3 paradas'],
                    ['label' => '4 paradas'],
                    ['label' => 'Ainda não sei'],
                ],
            ],
            'product' => [
                'name' => 'Elevac 200 — Elevador Residencial Panorâmico',
                'description' => 'Elevador residencial panorâmico para 2 a 4 andares, autoportante, sem poço e sem casa de máquinas, instalado em 3 a 5 dias.',
                'image' => $img.'/elevac1-2000x1335.jpg',
                'brand' => 'Elevac',
            ],
        ];
    }
}
