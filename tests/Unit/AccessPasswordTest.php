<?php

namespace Tests\Unit;

use App\Support\AccessPassword;
use Tests\TestCase;

class AccessPasswordTest extends TestCase
{
    public function test_the_temporary_password_has_six_digits(): void
    {
        $password = AccessPassword::generateTemporary();

        $this->assertMatchesRegularExpression('/^\d{6}$/', $password);
    }
}
