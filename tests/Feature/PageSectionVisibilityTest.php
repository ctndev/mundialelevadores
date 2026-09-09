<?php

namespace Tests\Feature;

use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PageSectionVisibilityTest extends TestCase
{
    use RefreshDatabase;

    #[DataProvider('sections')]
    public function test_disabled_sections_are_not_rendered(string $slug, string $url, string $section): void
    {
        $this->seed();
        $page = Page::query()->where('slug', $slug)->firstOrFail();
        $content = $page->content;
        $marker = "SECAO-OCULTA-{$section}";
        $content[$section]['title'] = $marker;
        $content[$section]['is_visible'] = false;
        $page->update(['content' => $content]);

        $response = $this->get($url);

        $response->assertDontSeeText($marker);
    }

    public function test_sections_without_a_visibility_setting_remain_visible(): void
    {
        $this->seed();
        $page = Page::query()->where('slug', 'home')->firstOrFail();
        $content = $page->content;
        $content['gallery']['title'] = 'GALERIA-LEGADA-VISIVEL';
        unset($content['gallery']['is_visible']);
        $page->update(['content' => $content]);

        $response = $this->get('/');

        $response->assertSeeText('GALERIA-LEGADA-VISIVEL');
    }

    /**
     * @return array<string, array{string, string, string}>
     */
    public static function sections(): array
    {
        return [
            'home hero' => ['home', '/', 'hero'],
            'home sobre' => ['home', '/', 'about'],
            'home serviços' => ['home', '/', 'services'],
            'home plataformas' => ['home', '/', 'platforms'],
            'home crédito' => ['home', '/', 'credit'],
            'home elevac' => ['home', '/', 'elevac'],
            'home marcas' => ['home', '/', 'brands'],
            'home fornecedores' => ['home', '/', 'suppliers'],
            'home galeria' => ['home', '/', 'gallery'],
            'home FAQ' => ['home', '/', 'faq'],
            'home contato' => ['home', '/', 'contact'],
            'landing hero' => ['elevac', '/elevac', 'hero'],
            'landing sobre' => ['elevac', '/elevac', 'about'],
            'landing vantagens' => ['elevac', '/elevac', 'advantages'],
            'landing galeria' => ['elevac', '/elevac', 'gallery'],
            'landing contato' => ['elevac', '/elevac', 'contact'],
        ];
    }
}
