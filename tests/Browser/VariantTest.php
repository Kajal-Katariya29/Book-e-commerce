<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Variant;

class VariantTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */

    protected $user;
    protected $variant;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->variant = Variant::factory()->create();
    }

    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/')->assertSee('Laravel');
            $browser->clickLink('Log in');
            $browser->value('#email',$this->user->email);
            $browser->value('#password','12345678');
            $browser->press('Login');
            $browser->screenshot('variant/login');
        });
    }

    public function testLogout()
    {
        $this->browse(function (Browser $browser) {
            $browser->clickLink('Hello');
            $browser->clickLink('Logout');
            $browser->screenshot('variant/logout');
        });
    }

    public function testCreateVariant()
    {
        $this->browse(function (Browser $browser){
            $this->testLogin();
            $browser->visit('http://127.0.0.1:8000/admin/variants')->assertSee('Book-e-Sale');
            $browser->clickLink('ADD Varints');
            $browser->type('variant_type',$this->variant->variant_type);
            $browser->press('save');
            $browser->screenshot('variant/testCreateVariant');
        });
    }

    public function testShowVariant()
    {
        $this->browse(function (Browser $browser) {
            $this->testLogin();
            $browser->visit('http://127.0.0.1:8000/admin/variants')->assertSee('Book-e-Sale');
            $browser->screenshot('variant/testShowVariant');
        });
    }

    public function testEditVariant()
    {
        $this->browse(function (Browser $browser) {
            $this->testLogin();
            $browser->visit('http://127.0.0.1:8000/admin/variants');
            $browser->assertVisible("#edit{$this->variant->variant_id}")->visit($browser->attribute("#edit{$this->variant->variant_id}", 'href'));
            $browser->type('variant_type',$this->variant->variant_type);
            $browser->press('save');
            $browser->screenshot('variant/testEditVariant');
        });
    }
}

