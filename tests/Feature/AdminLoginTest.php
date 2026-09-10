<?php

namespace Tests\Feature;

use App\Models\User;
use Filament\Auth\Pages\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_is_rate_limited_after_too_many_attempts(): void
    {
        User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        $login = Livewire::test(Login::class);

        for ($attempt = 0; $attempt < 5; $attempt++) {
            $login
                ->fillForm([
                    'email' => 'admin@example.com',
                    'password' => 'senha-errada',
                ])
                ->call('authenticate')
                ->assertHasFormErrors(['email']);
        }

        $login
            ->fillForm([
                'email' => 'admin@example.com',
                'password' => 'senha-errada',
            ])
            ->call('authenticate')
            ->assertNotified();
    }

    public function test_a_valid_login_still_works(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        Livewire::test(Login::class)
            ->fillForm([
                'email' => 'admin@example.com',
                'password' => 'password',
            ])
            ->call('authenticate')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertAuthenticatedAs($user);
    }
}
