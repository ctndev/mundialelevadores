<?php

namespace Tests\Feature;

use App\Filament\Dashboard;
use App\Models\Page;
use App\Models\SiteSetting;
use App\Models\User;
use App\Support\SiteCache;
use Filament\Actions\Action;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Livewire\Livewire;
use Tests\TestCase;

class SiteCacheTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Cache::flush();
        $this->seed();
    }

    public function test_public_pages_are_cached_for_twenty_four_hours(): void
    {
        $calls = 0;

        $first = SiteCache::remember('ttl-test', function () use (&$calls): int {
            return ++$calls;
        });

        $this->travel(23)->hours();

        $withinTtl = SiteCache::remember('ttl-test', function () use (&$calls): int {
            return ++$calls;
        });

        $this->travel(2)->hours();

        $afterTtl = SiteCache::remember('ttl-test', function () use (&$calls): int {
            return ++$calls;
        });

        $this->assertSame(1, $first);
        $this->assertSame(1, $withinTtl);
        $this->assertSame(2, $afterTtl);
    }

    public function test_page_changes_invalidate_the_public_site_cache(): void
    {
        $page = Page::query()->where('slug', 'home')->firstOrFail();
        $page->update(['meta_title' => 'Título em cache']);

        $this->get('/')->assertSee('<title>Título em cache</title>', false);

        $page->forceFill(['meta_title' => 'Alteração sem invalidar'])->saveQuietly();

        $this->get('/')
            ->assertSee('<title>Título em cache</title>', false)
            ->assertDontSee('Alteração sem invalidar');

        $page->update(['meta_title' => 'Título atualizado']);

        $this->get('/')
            ->assertSee('<title>Título atualizado</title>', false)
            ->assertDontSee('Título em cache');
    }

    public function test_setting_changes_invalidate_the_public_site_cache(): void
    {
        SiteSetting::setValue('whatsapp', '5585000000000');

        $this->get('/')->assertSee('data-whatsapp="5585000000000"', false);

        SiteSetting::setValue('whatsapp', '5585999999999');

        $this->get('/')
            ->assertSee('data-whatsapp="5585999999999"', false)
            ->assertDontSee('data-whatsapp="5585000000000"', false);
    }

    public function test_cached_pages_receive_the_current_session_csrf_token(): void
    {
        $this->withSession(['_token' => 'token-da-primeira-sessao'])
            ->get('/')
            ->assertSee('content="token-da-primeira-sessao"', false);

        $this->withSession(['_token' => 'token-da-segunda-sessao'])
            ->get('/')
            ->assertSee('content="token-da-segunda-sessao"', false)
            ->assertDontSee('content="token-da-primeira-sessao"', false);
    }

    public function test_admin_can_clear_the_site_cache_from_the_dashboard(): void
    {
        $admin = User::factory()->create();
        $calls = 0;

        SiteCache::remember('manual-clear-test', function () use (&$calls): int {
            return ++$calls;
        });

        Livewire::actingAs($admin)
            ->test(Dashboard::class)
            ->assertActionExists(
                'clearSiteCache',
                fn (Action $action): bool => $action->isConfirmationRequired(),
            )
            ->callAction('clearSiteCache')
            ->assertNotified('Cache do site limpo');

        $value = SiteCache::remember('manual-clear-test', function () use (&$calls): int {
            return ++$calls;
        });

        $this->assertSame(2, $value);
    }
}
