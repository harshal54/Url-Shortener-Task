<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_user_is_admin(): void
    {
        $user = new User(['role' => 'admin']);

        $this->assertTrue($user->isAdmin());
        $this->assertFalse($user->isSuperAdmin());
    }

    public function test_user_is_superadmin(): void
    {
        $user = new User(['role' => 'superadmin']);

        $this->assertTrue($user->isSuperAdmin());
        $this->assertFalse($user->isAdmin());
    }


}
