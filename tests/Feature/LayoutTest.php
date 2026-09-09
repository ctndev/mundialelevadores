<?php

namespace Tests\Feature;

use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LayoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_header_and_footer_are_the_same_on_every_page(): void
    {
        $this->seed();

        Page::query()->create([
            'slug' => 'politica-de-privacidade',
            'title' => 'Política de privacidade',
            'template' => 'simple',
            'is_published' => true,
            'body' => '<p>Conteúdo</p>',
        ]);

        foreach (['/', '/elevac', '/politica-de-privacidade'] as $url) {
            $this->get($url)
                ->assertOk()
                ->assertSee('id="main-nav"', false)
                ->assertSee('class="site-footer"', false)
                ->assertSee('Fortaleza · Ceará', false);
        }
    }

    public function test_only_the_current_page_link_is_highlighted(): void
    {
        $this->seed();

        $this->assertSame(1, substr_count($this->get('/')->getContent(), 'is-current'));
        $this->assertSame(1, substr_count($this->get('/elevac')->getContent(), 'is-current'));
    }

    public function test_page_content_cannot_override_header_or_footer(): void
    {
        $this->seed();

        $page = Page::query()->where('slug', 'elevac')->firstOrFail();
        $page->update([
            'content' => array_merge($page->content, [
                'header' => ['brand_name' => 'Marca invasora', 'menu' => [['label' => 'Link invasor', 'url' => '/x']]],
                'footer' => ['copyright' => 'Rodapé invasor'],
            ]),
        ]);

        $this->get('/elevac')
            ->assertOk()
            ->assertDontSee('Marca invasora')
            ->assertDontSee('Link invasor')
            ->assertDontSee('Rodapé invasor')
            ->assertSee('Mundial Elevadores', false);
    }
}
