<?php

namespace Tests\Feature;

use App\Filament\Resources\PageResource\Pages\EditPage;
use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EditPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_sections_without_a_stored_setting_are_shown_as_visible(): void
    {
        $page = $this->editableHomePage();

        Livewire::test(EditPage::class, ['record' => $page->getKey()])
            ->assertFormSet([
                'content.hero.is_visible' => true,
                'content.services.is_visible' => true,
                'content.gallery.is_visible' => true,
            ]);
    }

    public function test_a_section_turned_off_is_shown_as_hidden(): void
    {
        $page = $this->editableHomePage();
        $content = $page->content;
        $content['gallery']['is_visible'] = false;
        $page->update(['content' => $content]);

        Livewire::test(EditPage::class, ['record' => $page->getKey()])
            ->assertFormSet([
                'content.gallery.is_visible' => false,
                'content.services.is_visible' => true,
            ]);
    }

    public function test_the_page_cannot_be_deleted_from_the_edit_screen(): void
    {
        $page = $this->editableHomePage();

        Livewire::test(EditPage::class, ['record' => $page->getKey()])
            ->assertActionDoesNotExist('delete');
    }

    public function test_deactivating_takes_the_page_off_the_site_without_losing_it(): void
    {
        $page = $this->editableHomePage();

        Livewire::test(EditPage::class, ['record' => $page->getKey()])
            ->callAction('togglePublished');

        $this->assertFalse($page->refresh()->is_published);
        $this->assertModelExists($page);
        $this->get('/')->assertNotFound();
    }

    public function test_reactivating_puts_the_page_back_on_the_site(): void
    {
        $page = $this->editableHomePage();
        $page->update(['is_published' => false]);

        Livewire::test(EditPage::class, ['record' => $page->getKey()])
            ->callAction('togglePublished');

        $this->assertTrue($page->refresh()->is_published);
        $this->get('/')->assertOk();
    }

    private function editableHomePage(): Page
    {
        $this->seed();
        $this->actingAs(User::query()->firstOrFail());

        return Page::query()->where('slug', 'home')->firstOrFail();
    }
}
