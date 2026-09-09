<?php

namespace Tests\Feature;

use App\Filament\Resources\ContactResource;
use App\Filament\Resources\ContactResource\Pages\ListContacts;
use App\Mail\ContactFormMail;
use App\Models\Contact;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_form_does_not_show_subject_field(): void
    {
        $this->seed();

        $this->get('/')
            ->assertOk()
            ->assertDontSee('name="assunto"', false)
            ->assertSee('name="mensagem"', false);
    }

    public function test_contact_is_saved_with_optional_message(): void
    {
        $this->postJson('/contato', [
            'nome' => 'Maria Silva',
            'telefone' => '(85) 98802-8067',
            'mensagem' => '',
            'pagina' => '/',
        ])
            ->assertOk()
            ->assertJson(['ok' => true]);

        $this->assertDatabaseHas('contacts', [
            'name' => 'Maria Silva',
            'phone' => '(85) 98802-8067',
            'message' => null,
            'page' => '/',
        ]);
        $this->assertSame(1, Contact::query()->count());
    }

    public function test_contact_requires_name_and_phone(): void
    {
        $this->postJson('/contato', [
            'mensagem' => 'Quero um orçamento',
        ])->assertUnprocessable();

        $this->assertSame(0, Contact::query()->count());
    }

    public function test_admin_menu_has_a_link_to_the_contacts_list(): void
    {
        $this->seed();
        $this->actingAs(User::query()->firstOrFail());

        $this->get(ContactResource::getUrl('index'))
            ->assertOk()
            ->assertSee('Contatos do site');

        $this->assertSame('contatos', ContactResource::getSlug());
        $this->assertTrue(ContactResource::shouldRegisterNavigation());
    }

    public function test_the_contacts_list_shows_the_saved_contacts(): void
    {
        $this->seed();
        $this->actingAs(User::query()->firstOrFail());

        $contact = Contact::query()->create([
            'name' => 'João Pereira',
            'phone' => '(85) 99991-0050',
            'message' => 'Preciso de manutenção no elevador',
        ]);

        Livewire::test(ListContacts::class)
            ->assertCanSeeTableRecords([$contact])
            ->assertTableActionExists('view');
    }

    public function test_contact_form_sends_one_email_per_recipient(): void
    {
        SiteSetting::setValue('contact_notification_emails', [
            'atendimento@example.com',
            'comercial@example.com',
        ]);

        Mail::fake();

        $this->postJson('/contato', [
            'nome' => 'Maria Silva',
            'telefone' => '(85) 98802-8067',
            'mensagem' => 'Quero um orçamento',
            'pagina' => '/',
        ])->assertOk();

        Mail::assertSent(ContactFormMail::class, 2);
        Mail::assertSent(ContactFormMail::class, fn (ContactFormMail $mail): bool => $mail->hasTo('atendimento@example.com'));
        Mail::assertSent(ContactFormMail::class, fn (ContactFormMail $mail): bool => $mail->hasTo('comercial@example.com'));
    }

    public function test_contact_form_does_not_send_email_without_recipients(): void
    {
        Mail::fake();

        $this->postJson('/contato', [
            'nome' => 'Maria Silva',
            'telefone' => '(85) 98802-8067',
        ])->assertOk();

        $this->assertSame(1, Contact::query()->count());
        Mail::assertNothingSent();
    }

    public function test_admin_can_save_contact_notification_emails(): void
    {
        $this->seed();
        $this->actingAs(User::query()->firstOrFail());

        Livewire::test(ListContacts::class)
            ->callAction('notificationEmails', [
                'emails' => ['atendimento@example.com', 'comercial@example.com'],
            ]);

        $this->assertSame(
            ['atendimento@example.com', 'comercial@example.com'],
            SiteSetting::contactNotificationEmails(),
        );
    }
}
