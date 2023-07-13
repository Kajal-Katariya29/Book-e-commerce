<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class VariantTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testAddVarint(): void
    {
        $user = User::factory()
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))->visit('/home');
        });
    }
}
