<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use App\Models\User;
use App\Support\LayoutContent;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'yuri@ctn.dev.br'],
            [
                'name' => 'Yuri',
                'password' => '123456',
            ]
        );

        SiteSetting::setMany([
            'ga_enabled' => false,
            'ga_measurement_id' => '',
            'robots_extra' => '',
            'site_name' => 'Mundial Elevadores Fortaleza',
            'whatsapp' => '5585988028067',
            'email' => 'mundialelevadores.for@gmail.com',
            'address' => 'Rua Coronel João Carneiro, 261 - Fátima',
            'postal_code' => '60040-560',
            'city' => 'Fortaleza',
            'region' => 'CE',
            'area_served' => 'Ceará',
            'jsonld_description' => 'Manutenção, modernização, montagem, assistência técnica e vendas de elevadores, plataformas de acessibilidade e monta-cargas.',
            'og_image' => 'images/1-2000x1335-800x534.jpg',
            'logo' => 'images/mef-logo-sm.png',
            'header' => LayoutContent::header(),
            'footer' => LayoutContent::footer(),
        ]);

        $this->call([
            HomePageSeeder::class,
            ElevacPageSeeder::class,
        ]);
    }
}
