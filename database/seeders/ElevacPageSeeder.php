<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Support\LandingContent;
use Illuminate\Database\Seeder;

class ElevacPageSeeder extends Seeder
{
    public function run(): void
    {
        Page::query()->updateOrCreate(
            ['slug' => 'elevac'],
            [
                'title' => 'Elevac 200 | Elevador Residencial Panorâmico',
                'template' => 'landing',
                'is_published' => true,
                'content' => LandingContent::elevac(),
                'meta_title' => 'Elevac 200 | Elevador Residencial Panorâmico — Mundial Elevadores Fortaleza',
                'meta_description' => 'Elevac 200: elevador residencial panorâmico para 2 a 4 andares, sem poço e sem casa de máquinas, instalado em 3 a 5 dias em Fortaleza e em todo o Ceará.',
                'og_title' => 'Elevac 200 | Elevador Residencial Panorâmico',
                'og_description' => 'Elevador inteligente, panorâmico e charmoso para casas, duplex, tríplex e escritórios. Instalação simplificada, sem obras de poço ou casa de máquinas.',
                'og_image' => 'images/elevac1-2000x1335.jpg',
                'canonical' => null,
                'robots' => 'index,follow',
            ]
        );
    }
}
