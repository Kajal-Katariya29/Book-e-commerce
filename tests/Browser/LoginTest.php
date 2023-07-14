<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testRegisterForm()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/')->assertSee('Laravel');
            $browser->clickLink('Register')->assertSee('Register');
            $browser->value('#firstname','Kajal');
            $browser->value('#lastname','Katariya');
            $browser->value('#email','Kajal123@gmail.com');
            $browser->value('#password','12345678');
            $browser->value('#password-confirm','12345678');
            $browser->value('#phone_number','1234567889');
            $browser->value('#address','Surat');
            $browser->press('Register');
            $browser->screenshot('example/testRegister');
        });
    }

    public function testLoginForm()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/')->assertSee('Laravel');
            $browser->clickLink('Log in');
            $browser->value('#email','Kajal123@gmail.com');
            $browser->value('#password','12345678');
            $browser->press('Login');
            $browser->screenshot('example/testLogin');
        });
    }

    public function testLogoutForm()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/')->assertSee('Laravel');
            $browser->clickLink('Log in');
            $browser->value('#email','Kajal123@gmail.com');
            $browser->value('#password','12345678');
            $browser->press('Login');
            $browser->clickLink('Hello');
            $browser->clickLink('Logout');
            $browser->screenshot('example/testLogout');
        });
    }
}
