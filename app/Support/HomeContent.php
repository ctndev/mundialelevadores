<?php

namespace App\Support;

class HomeContent
{
    /**
     * @return array<string, mixed>
     */
    public static function default(): array
    {
        $img = 'images';

        return [
            'hero' => [
                'eyebrow' => 'Mais de 30 anos elevando Fortaleza',
                'title' => 'Manutenção, modernização e instalação de elevadores em todo o Ceará',
                'text' => 'Assistência técnica multimarcas, montagem, vendas, elevadores residenciais, monta-cargas e plataformas de acessibilidade. Empresa registrada no CREA-CE, com emissão de ART em todos os serviços.',
                'primary_cta_label' => 'Falar no WhatsApp',
                'primary_cta_text' => 'Olá! Gostaria de um orçamento da Mundial Elevadores.',
                'secondary_cta_label' => 'Agendar vistoria gratuita',
                'secondary_cta_url' => '#contato',
                'slides' => [
                    ['image' => $img.'/1-2000x1335-800x534.jpg'],
                    ['image' => $img.'/modernize-600x399.jpg'],
                    ['image' => $img.'/5-2000x1335-800x534.jpg'],
                ],
                'badges' => [
                    ['label' => '+30 anos de tradição'],
                    ['label' => 'CREA-CE · ART em todos os serviços'],
                    ['label' => 'Atendimento em todo o Ceará'],
                    ['label' => 'Equipe certificada nas principais marcas'],
                ],
            ],
            'about' => [
                'eyebrow' => 'Sobre nós',
                'title' => 'Tradição e inovação a serviço da sua segurança',
                'image' => $img.'/3-2000x1335-800x534.jpg',
                'image_alt' => 'Técnico da Mundial Elevadores em manutenção de casa de máquinas',
                'paragraphs' => [
                    ['text' => 'Há mais de 30 anos em Fortaleza, a Mundial Elevadores alia tradição e inovação para oferecer manutenção preventiva e corretiva, modernização e instalação de elevadores, plataformas de acessibilidade e sistemas a vácuo. Nosso maior diferencial é a confiança que conquistamos — de síndicos, administradoras e usuários finais — resultado de um atendimento transparente, próximo e comprometido com a segurança.'],
                    ['text' => 'Oferecemos vistoria técnica gratuita e sem compromisso, avaliando sistema de comando, portas, botoeiras e demais componentes, com propostas personalizadas de otimização ou modernização. Registrados no CREA-CE e com emissão de ART em todos os serviços, garantimos conformidade com as normas mais rigorosas.'],
                ],
                'stats' => [
                    ['value' => '30+', 'label' => 'anos de mercado'],
                    ['value' => '184', 'label' => 'municípios atendidos no CE'],
                    ['value' => '24h', 'label' => 'suporte para emergências'],
                ],
            ],
            'services' => [
                'eyebrow' => 'Serviços',
                'title' => 'Soluções completas para o seu elevador',
                'lead' => 'Da manutenção de rotina à modernização completa, com peças de fornecedores homologados e equipe técnica própria.',
                'cards' => [
                    ['image' => $img.'/modernize-600x399.jpg', 'image_alt' => 'Modernização de elevadores', 'title' => 'Modernização de elevadores', 'text' => 'Renove hoje o seu elevador: economia de energia, conforto de viagem e segurança com quadros de comando, portas e botoeiras atualizados.'],
                    ['image' => $img.'/manuteno-600x399.jpg', 'image_alt' => 'Manutenção preventiva e corretiva de elevadores', 'title' => 'Manutenção preventiva e corretiva', 'text' => 'Consertos, reparos e planos de manutenção que prolongam a vida útil do equipamento e reduzem paradas inesperadas.'],
                    ['image' => $img.'/elevac-600x399.jpg', 'image_alt' => 'Elevador residencial Elevac 200', 'title' => 'Elevadores residenciais', 'text' => 'O elevador panorâmico Elevac 200 para casas, duplex, tríplex, escritórios, buffets e salões.'],
                ],
                'mini_cards' => [
                    ['title' => 'Montagem e instalação', 'text' => 'Projeto, montagem e comissionamento de novos equipamentos.'],
                    ['title' => 'Assistência técnica', 'text' => 'Atendimento de chamados em rotina ou emergência, com agilidade.'],
                    ['title' => 'Monta-cargas', 'text' => 'Soluções de transporte vertical de cargas para indústria e comércio.'],
                    ['title' => 'Plataformas e sistemas a vácuo', 'text' => 'Acessibilidade e elevadores a vácuo para reformas e novas obras.'],
                ],
            ],
            'platforms' => [
                'eyebrow' => 'Plataformas de acessibilidade',
                'title' => 'Representantes da Máximo Elevadores no Ceará',
                'lead' => 'Somos os representantes da <strong>Máximo Elevadores</strong> aqui no Ceará e realizamos a venda, instalação e manutenção das plataformas de acessibilidade em todo o estado. Equipamentos internos e externos, sob medida, em conformidade com a norma <strong>NBR ISO 9386-1</strong>.',
                'cards' => [
                    ['image' => $img.'/plataformas/modelos-basicos-73.jpg', 'image_alt' => 'Plataforma de acessibilidade modelo básico', 'title' => 'Modelos básicos', 'text' => 'Solução econômica para vencer pequenos desníveis com segurança.'],
                    ['image' => $img.'/plataformas/modelos-cabinados-45.jpg', 'image_alt' => 'Plataforma cabinada pintada e em inox', 'title' => 'Cabinados pintados e em inox', 'text' => 'Acabamentos em chapa pintada, inox, vidro ou piso vinílico.'],
                    ['image' => $img.'/plataformas/plataformas-enclausuradas-01.jpg', 'image_alt' => 'Plataforma enclausurada', 'title' => 'Plataformas enclausuradas', 'text' => 'Percursos maiores com enclausuramento próprio, sem obra de poço.'],
                    ['image' => $img.'/plataformas/meia-cabine-portinhola-03.jpg', 'image_alt' => 'Plataforma meia cabine com portinhola', 'title' => 'Meia cabine com portinhola', 'text' => 'Ideal para residências e ambientes com pé-direito reduzido.'],
                    ['image' => $img.'/plataformas/meia-cabine-cabinado-portas-01.jpg', 'image_alt' => 'Plataforma meia cabine e cabinado com portas', 'title' => 'Meia cabine e cabinado com portas', 'text' => 'Portas de pavimento para mais conforto, privacidade e segurança.'],
                    ['image' => $img.'/plataformas/locacao-eventos-01.webp', 'image_alt' => 'Plataforma para locação em eventos', 'title' => 'Locação para eventos', 'text' => 'Plataformas adaptadas sob medida, com base removível e sem furação em pisos e paredes.'],
                ],
                'features' => [
                    ['label' => 'Conformidade com a NBR ISO 9386-1'],
                    ['label' => 'Modelos internos e externos'],
                    ['label' => 'Acabamentos em vidro, inox, chapa pintada e piso vinílico'],
                    ['label' => 'Alimentação 220V, consumo de eletrodoméstico comum'],
                    ['label' => 'Nobreak opcional para queda de energia'],
                    ['label' => 'Prazo médio de 35 a 45 dias, com instalação em todo o Ceará'],
                ],
            ],
            'credit' => [
                'eyebrow' => 'Facilite a sua compra',
                'title' => 'Você conhece o Crédito Acessibilidade?',
                'image' => $img.'/plataformas/credito-01.jpg',
                'image_alt' => 'Crédito acessibilidade para compra de plataforma',
                'cta_label' => 'Quero um orçamento de plataforma',
                'cta_text' => 'Olá! Quero saber sobre plataformas de acessibilidade.',
                'paragraphs' => [
                    ['text' => 'É uma linha de crédito especial que auxilia pessoas com deficiência (PCD) a adquirir bens e serviços que favoreçam conforto, segurança e autonomia. Os bancos participantes são Banco do Brasil, Bradesco, Caixa e Santander.'],
                    ['text' => 'Como é um crédito social, tem juros mais baixos que o empréstimo tradicional e, dependendo do banco, pode financiar até 100% do equipamento. Fale com a nossa equipe para receber a proposta técnica necessária.'],
                ],
            ],
            'elevac' => [
                'eyebrow' => 'Elevac 200',
                'title' => 'Elevador residencial panorâmico e inteligente',
                'text' => 'Elevador inteligente, panorâmico e muito charmoso, para novas construções e ideal para edificações já prontas. O Elevac atende de 2 a 4 andares em casas, apartamentos duplex e tríplex, escritórios e outros ambientes.',
                'cta_label' => 'Conhecer o Elevac 200',
                'cta_url' => '/elevac',
                'image' => $img.'/2-1400x1050.jpg',
                'image_alt' => 'Elevador residencial panorâmico Elevac 200 instalado',
            ],
            'brands' => [
                'eyebrow' => 'Multimarcas',
                'title' => 'Trabalhamos com elevadores de todas as marcas',
                'lead' => 'Nossa equipe é certificada e experiente nas principais marcas do mercado — atendemos equipamentos de qualquer fabricante, com destaque para:',
                'note' => 'Também atendemos elevadores de outros fabricantes e equipamentos sem cobertura de assistência no estado.',
                'items' => [
                    ['name' => 'Atlas Schindler'],
                    ['name' => 'Otis'],
                    ['name' => 'Thyssenkrupp (TKE)'],
                    ['name' => 'Kone'],
                ],
            ],
            'suppliers' => [
                'eyebrow' => 'Fornecedores e parceiros',
                'title' => 'Peças e componentes de quem é referência',
                'lead' => 'Trabalhamos com fornecedores homologados para garantir originalidade, disponibilidade de peças e conformidade técnica em cada serviço.',
                'items' => [
                    ['name' => 'Schmersal', 'text' => 'Quadros de comando', 'highlight' => false],
                    ['name' => 'Scanchip', 'text' => 'Quadros de comando', 'highlight' => false],
                    ['name' => 'Alfa Elevadores', 'text' => 'Reposição de peças em geral', 'highlight' => false],
                    ['name' => 'Elevcom', 'text' => 'Botoeiras', 'highlight' => false],
                    ['name' => 'SCR', 'text' => 'Subtetos para elevadores', 'highlight' => false],
                    ['name' => 'Wittur', 'text' => 'Portas', 'highlight' => false],
                    ['name' => 'Máximo Elevadores', 'text' => 'Plataformas de acessibilidade — somos representantes no Ceará', 'highlight' => true],
                ],
            ],
            'gallery' => [
                'eyebrow' => 'Galeria',
                'title' => 'Serviços executados pela nossa equipe',
                'items' => [
                    ['image' => $img.'/1-2000x1335-800x534.jpg', 'alt' => 'Serviço de elevador executado pela Mundial Elevadores 1'],
                    ['image' => $img.'/2-2000x1336-800x534.jpg', 'alt' => 'Serviço de elevador executado pela Mundial Elevadores 2'],
                    ['image' => $img.'/3-2000x1335-800x534.jpg', 'alt' => 'Serviço de elevador executado pela Mundial Elevadores 3'],
                    ['image' => $img.'/4-2000x1335-800x534.jpg', 'alt' => 'Serviço de elevador executado pela Mundial Elevadores 4'],
                    ['image' => $img.'/5-2000x1335-800x534.jpg', 'alt' => 'Serviço de elevador executado pela Mundial Elevadores 5'],
                    ['image' => $img.'/6-2000x1335-800x534.jpg', 'alt' => 'Serviço de elevador executado pela Mundial Elevadores 6'],
                    ['image' => $img.'/7-2000x1335-800x534.jpg', 'alt' => 'Serviço de elevador executado pela Mundial Elevadores 7'],
                    ['image' => $img.'/8-2000x1335-800x534.jpg', 'alt' => 'Serviço de elevador executado pela Mundial Elevadores 8'],
                ],
            ],
            'faq' => [
                'eyebrow' => 'Dúvidas frequentes',
                'title' => 'Perguntas frequentes',
                'items' => [
                    ['question' => 'A vistoria técnica é realmente gratuita?', 'answer' => 'Sim. Avaliamos sistema de comando, portas, botoeiras e demais componentes sem compromisso e apresentamos uma proposta personalizada de otimização ou modernização.'],
                    ['question' => 'Vocês atendem elevadores de qualquer marca?', 'answer' => 'Sim, trabalhamos com elevadores multimarcas, com destaque para Atlas Schindler, Otis, Thyssenkrupp (TKE) e Kone.'],
                    ['question' => 'Os serviços têm ART?', 'answer' => 'Somos registrados no CREA-CE e emitimos ART em todos os serviços, garantindo conformidade com as normas vigentes.'],
                    ['question' => 'A plataforma de acessibilidade pode ser personalizada?', 'answer' => 'Sim. É possível trabalhar com diferentes acabamentos, como vidro, inox, chapa pintada e piso vinílico, em modelos internos e externos, sob medida.'],
                    ['question' => 'Qual é o prazo de entrega da plataforma?', 'answer' => 'Em torno de 35 a 45 dias corridos após a compra ou locação, podendo ser antecipado conforme a necessidade do cliente.'],
                    ['question' => 'E se faltar energia durante o uso?', 'answer' => 'Há a opção de nobreak, que permite a continuação do percurso em caso de queda de energia.'],
                    ['question' => 'Vocês atendem fora de Fortaleza?', 'answer' => 'Sim, realizamos manutenção e instalações em todo o estado do Ceará.'],
                ],
            ],
            'contact' => [
                'eyebrow' => 'Contato',
                'title' => 'Fale com a Mundial Elevadores',
                'address' => "Rua Coronel João Carneiro, 261 - Fátima\n60040-560 Fortaleza - Ceará",
                'email' => 'mundialelevadores.for@gmail.com',
                'map_title' => 'Mapa da Mundial Elevadores em Fortaleza',
                'map_embed' => 'https://www.google.com/maps?q=Rua%20Coronel%20Jo%C3%A3o%20Carneiro%2C%20261%20-%20F%C3%A1tima%2C%20Fortaleza%20-%20CE&output=embed',
                'form_title' => 'Solicite um orçamento ou vistoria',
                'form_button' => 'Enviar pelo WhatsApp',
                'form_note' => 'Ao enviar, abrimos o WhatsApp com a sua mensagem já preenchida.',
                'phones' => [
                    ['display' => '(85) 9.8802-8067', 'tel' => '+5585988028067'],
                    ['display' => '(85) 9.9991-0050', 'tel' => '+5585999910050'],
                    ['display' => '(85) 3231-6180', 'tel' => '+558532316180'],
                ],
                'subjects' => [
                    ['label' => 'Manutenção de elevador'],
                    ['label' => 'Modernização'],
                    ['label' => 'Plataforma de acessibilidade'],
                    ['label' => 'Elevador residencial / Elevac 200'],
                    ['label' => 'Monta-cargas'],
                    ['label' => 'Outro assunto'],
                ],
            ],
        ];
    }
}
