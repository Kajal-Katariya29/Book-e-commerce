<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Variant;
use App\Models\VariantType;

class VariantTypeTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    protected $user;
    protected $varianttype;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->varianttype = VariantType::factory()->create();
    }

    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/')->assertSee('Laravel');
            $browser->clickLink('Log in');
            $browser->value('#email',$this->user->email);
            $browser->value('#password','12345678');
            $browser->press('Login');
            $browser->screenshot('variantType/login');
        });
    }

    public function testLogout()
    {
        $this->browse(function (Browser $browser) {
            $browser->clickLink('Hello');
            $browser->clickLink('Logout');
            $browser->screenshot('variantType/logout');
        });
    }

    public function testCreateVariantType()
    {
        $this->browse(function (Browser $browser){
            $this->testLogin();
            $browser->visit('http://127.0.0.1:8000/admin/variant-type')->assertSee('Book-e-Sale');
            $browser->clickLink('ADD Varint Type');
            $browser->select('variant_id',$this->varianttype->variant_id);
            $browser->type('variant_type_name',$this->varianttype->variant_type_name);
            $browser->press('Save');
            $browser->screenshot('variantType/testCreateVariantType');
        });
    }

    public function testShowVariantType()
    {
        $this->browse(function (Browser $browser) {
            $this->testLogin();
            $browser->visit('http://127.0.0.1:8000/admin/variant-type')->assertSee('Book-e-Sale');
            $browser->screenshot('variantType/testCreateVariantType');
        });
    }

    public function testEditVariantType()
    {
        $this->browse(function (Browser $browser) {
            $this->testLogin();
            $browser->visit('http://127.0.0.1:8000/admin/variant-type')->assertSee('Book-e-Sale');
            $browser->assertVisible("#edit{$this->varianttype->variant_type_id }")->visit($browser->attribute("#edit{$this->varianttype->variant_type_id }", 'href'));
            $browser->select('variant_id',$this->varianttype->variant_id);
            $browser->type('variant_type_name',$this->varianttype->variant_type_name);
            $browser->press('Save');
            $browser->screenshot('variantType/testEditVariantType');
        });
    }
}
