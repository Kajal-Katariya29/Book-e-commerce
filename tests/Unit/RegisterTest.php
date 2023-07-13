<?php

namespace Tests\Unit;

use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;
use Mockery;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function testRegisterUser()
    {
        $mockUser = Mockery::mock(User::class);
        $user = User::factory()->create();
        $data = [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'role' => $user->role,
            'phone_number' => $user->phone_number,
            'address' => $user->address,
            'email' =>$user->email,
            'password' => $user->password,
        ];

        $mockUser->shouldReceive('create')->once()->andReturn(true);

        $RegisterControler = new RegisterController($mockUser);

        $request = $RegisterControler->create();
    }
}
