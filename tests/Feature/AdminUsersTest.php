<?php

namespace Tests\Feature;

use App\Filament\Auth\EditProfile;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Jobs\SendAccessCredentialsMailJob;
use App\Mail\AccessCredentialsMail;
use App\Models\User;
use Filament\Actions\Action;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;
use Tests\TestCase;

class AdminUsersTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_profile_page_lets_the_user_change_the_password(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/ctn-admin/profile')
            ->assertOk()
            ->assertSee('Nova senha', false)
            ->assertSee('Alterar senha', false);
    }

    public function test_the_users_list_shows_last_access(): void
    {
        $admin = User::factory()->create();
        User::factory()->create([
            'name' => 'Maria',
            'last_access_at' => '2026-09-09 10:15:00',
        ]);

        $this->actingAs($admin)
            ->get('/ctn-admin/usuarios')
            ->assertOk()
            ->assertSee('Usuários', false)
            ->assertSee('Último acesso', false)
            ->assertSee('Maria', false)
            ->assertSee(Carbon::parse('2026-09-09 10:15:00')->timezone(config('app.timezone'))->format('d/m/Y H:i'), false);
    }

    public function test_visiting_the_admin_records_last_access(): void
    {
        $user = User::factory()->create(['last_access_at' => null]);

        $this->actingAs($user)->get('/ctn-admin');

        $this->assertNotNull($user->refresh()->last_access_at);
    }

    public function test_creating_a_user_sends_a_six_digit_temporary_password(): void
    {
        Queue::fake();
        $admin = User::factory()->create();

        Livewire::actingAs($admin)
            ->test(CreateUser::class)
            ->fillForm([
                'name' => 'João',
                'email' => 'joao@example.com',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $user = User::query()->where('email', 'joao@example.com')->first();
        $this->assertNotNull($user);
        $this->assertTrue($user->must_change_password);

        Queue::assertPushed(SendAccessCredentialsMailJob::class, function (SendAccessCredentialsMailJob $job) use ($user): bool {
            return $job->user->is($user)
                && $job->isReset === false
                && preg_match('/^\d{6}$/', $job->temporaryPassword) === 1
                && Hash::check($job->temporaryPassword, $user->password);
        });
    }

    public function test_a_user_with_a_temporary_password_must_change_it_before_using_the_panel(): void
    {
        $user = User::factory()->create([
            'password' => '123456',
            'must_change_password' => true,
        ]);

        $this->actingAs($user)
            ->get('/ctn-admin')
            ->assertRedirect('/ctn-admin/profile');

        $this->actingAs($user)
            ->get('/ctn-admin/profile')
            ->assertOk()
            ->assertSee('Definir nova senha', false);
    }

    public function test_the_first_access_password_must_be_secure(): void
    {
        $user = User::factory()->create([
            'password' => '123456',
            'must_change_password' => true,
        ]);

        Livewire::actingAs($user)
            ->test(EditProfile::class)
            ->fillForm([
                'name' => $user->name,
                'email' => $user->email,
                'password' => 'fraca123',
                'passwordConfirmation' => 'fraca123',
                'currentPassword' => '123456',
            ])
            ->call('save')
            ->assertHasFormErrors(['password']);

        $this->assertTrue($user->refresh()->must_change_password);
    }

    public function test_changing_the_temporary_password_unlocks_the_panel(): void
    {
        $user = User::factory()->create([
            'password' => '123456',
            'must_change_password' => true,
        ]);

        Livewire::actingAs($user)
            ->test(EditProfile::class)
            ->fillForm([
                'name' => $user->name,
                'email' => $user->email,
                'password' => 'SenhaForte1!',
                'passwordConfirmation' => 'SenhaForte1!',
                'currentPassword' => '123456',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $user->refresh();
        $this->assertFalse($user->must_change_password);
        $this->assertTrue(Hash::check('SenhaForte1!', $user->password));

        $this->actingAs($user)
            ->get('/ctn-admin')
            ->assertOk();
    }

    public function test_resetting_another_user_password_asks_for_confirmation_and_sends_email(): void
    {
        Queue::fake();
        $admin = User::factory()->create();
        $other = User::factory()->create(['email' => 'outro@example.com']);

        Livewire::actingAs($admin)
            ->test(ListUsers::class)
            ->assertTableActionExists(
                'resetPassword',
                fn (Action $action): bool => $action->isConfirmationRequired(),
                $other,
            )
            ->assertTableActionHidden('resetPassword', $admin)
            ->callTableAction('resetPassword', $other);

        $this->assertTrue($other->refresh()->must_change_password);

        Queue::assertPushed(SendAccessCredentialsMailJob::class, function (SendAccessCredentialsMailJob $job) use ($other): bool {
            return $job->user->is($other)
                && $job->isReset
                && preg_match('/^\d{6}$/', $job->temporaryPassword) === 1
                && Hash::check($job->temporaryPassword, $other->password);
        });
    }

    public function test_the_edit_user_page_can_reset_the_password_after_confirmation(): void
    {
        Queue::fake();
        $admin = User::factory()->create();
        $other = User::factory()->create();

        Livewire::actingAs($admin)
            ->test(EditUser::class, ['record' => $other->getKey()])
            ->assertActionExists(
                'resetPassword',
                fn (Action $action): bool => $action->isConfirmationRequired(),
            )
            ->callAction('resetPassword');

        $this->assertTrue($other->refresh()->must_change_password);
        Queue::assertPushed(SendAccessCredentialsMailJob::class, fn (SendAccessCredentialsMailJob $job): bool => $job->isReset);
    }

    public function test_the_access_credentials_job_sends_the_email(): void
    {
        Mail::fake();
        $user = User::factory()->create();

        (new SendAccessCredentialsMailJob($user, '123456', isReset: false))->handle();

        Mail::assertSent(AccessCredentialsMail::class, function (AccessCredentialsMail $mail) use ($user): bool {
            return $mail->hasTo($user->email)
                && $mail->temporaryPassword === '123456'
                && $mail->isReset === false;
        });
    }
}
