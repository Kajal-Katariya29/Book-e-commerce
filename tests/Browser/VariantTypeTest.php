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
        $this->varianttype = VariantType::factory()->definition();
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

    public function getVariantData(){
        $variant = Variant::factory()->create();
        $variantType = VariantType::factory()->create(['variant_id' => $variant->variant_id]);
        return $variantType;
    }

    public function testCreateVariantType()
    {
        $this->browse(function (Browser $browser){
            $this->testLogin();
            $variantType = $this->getVariantData();
            $browser->visit('http://127.0.0.1:8000/admin/variant-type')->assertSee('Book-e-Sale');
            $browser->clickLink('ADD Varint Type');
            $browser->select('variant_id',$variantType->variant_id);
            $browser->type('variant_type_name',$variantType->variant_type_name);
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
            $variantType = $this->getVariantData();
            $browser->visit('http://127.0.0.1:8000/admin/variant-type')->assertSee('Book-e-Sale');
            $browser->assertVisible("#edit{$variantType->variant_type_id }")->visit($browser->attribute("#edit{$variantType->variant_type_id }", 'href'));
            $browser->select('variant_id',$variantType->variant_id );
            $browser->type('variant_type_name',$variantType->variant_type_name);
            $browser->press('Save');
            $browser->screenshot('variantType/testEditVariantType');
        });
    }

    public function testDeleteVariantType()
    {
        $this->browse(function (Browser $browser) {
            $this->testLogin();
            $variantType = $this->getVariantData();
            $browser->visit('http://127.0.0.1:8000/admin/variant-type');
            $browser->click("@delete_{$variantType->variant_type_id}");
            $browser->screenshot('variant/testDeleteVariantType');
        });
    }
}
