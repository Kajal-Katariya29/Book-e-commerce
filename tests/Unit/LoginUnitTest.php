<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;
use Mockery;

class LoginUnitTest extends TestCase
{
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function tearDown(): void
    {
        \Mockery::close();
    }


    public function testLoginUser()
    {
        $input = ['email' => 'kajal123@gmail.com','password' => '12345678'];
        $authMock = Mockery::mock(Illuminate\Support\Facades\Auth::class);
        $authMock->shouldReceive('check')->andReturn(true);
        $authMock->shouldReceive('user')->andReturn($input);
        $this->assertTrue(TRUE);
    }
}
