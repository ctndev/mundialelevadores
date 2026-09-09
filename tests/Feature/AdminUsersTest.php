<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
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
}
