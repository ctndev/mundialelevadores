<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_home_page_returns_a_successful_response(): void
    {
        $this->seed();

        $this->get('/')->assertOk();
        $this->get('/elevac')
            ->assertOk()
            ->assertSee('Elevac 200', false)
            ->assertSee('Por que escolher o Elevac 200', false);
        $this->get('/robots.txt')->assertOk();
        $this->get('/sitemap.xml')->assertOk()->assertSee('/elevac', false);
        $this->get('/ctn-admin/login')->assertOk();
        $this->get('/ctn-admin/register')->assertNotFound();
    }
}
