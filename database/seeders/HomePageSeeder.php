<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Support\HomeContent;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    public function run(): void
    {
        Page::query()->updateOrCreate(
            ['slug' => 'home'],
            [
                'title' => 'Mundial Elevadores Fortaleza | Manutenção e Modernização de Elevadores',
                'template' => 'home',
                'is_published' => true,
                'content' => HomeContent::default(),
                'meta_title' => 'Mundial Elevadores Fortaleza | Manutenção e Modernização de Elevadores',
                'meta_description' => 'Há mais de 30 anos em Fortaleza: manutenção, modernização, montagem e assistência técnica de elevadores multimarcas, plataformas de acessibilidade e elevadores residenciais em todo o Ceará.',
                'og_title' => 'Mundial Elevadores Fortaleza | Manutenção e Modernização de Elevadores',
                'og_description' => 'Manutenção, modernização e instalação de elevadores multimarcas e plataformas de acessibilidade em Fortaleza e em todo o Ceará. Vistoria técnica gratuita.',
                'og_image' => 'images/1-2000x1335-800x534.jpg',
                'robots' => 'index,follow',
            ]
        );
    }
}
