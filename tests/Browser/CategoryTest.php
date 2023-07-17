<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\CategoryList;

class CategoryTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */

    protected $user;
    protected $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->category = CategoryList::factory()->definition();
    }

    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/')->assertSee('Laravel');
            $browser->clickLink('Log in');
            $browser->value('#email',$this->user->email);
            $browser->value('#password','12345678');
            $browser->press('Login');
            $browser->screenshot('category/login');
        });
    }

    public function testLogout()
    {
        $this->browse(function (Browser $browser) {
            $browser->clickLink('Hello');
            $browser->clickLink('Logout');
            $browser->screenshot('category/logout');
        });
    }

    public function testCreateCategory()
    {
        $this->browse(function (Browser $browser){
            $this->testLogin();
            $browser->visit('http://127.0.0.1:8000/admin/categories')->assertSee('Book-e-Sale');
            $browser->clickLink('ADD Category');
            $browser->type('category_name',$this->category['category_name']);
            $browser->press('Save');
            $browser->screenshot('category/testCreateCategory');
        });
    }

    public function testShowCategory()
    {
        $this->browse(function (Browser $browser) {
            $this->testLogin();
            $browser->visit('http://127.0.0.1:8000/admin/categories')->assertSee('Book-e-Sale');
            $browser->screenshot('category/testShowCategory');
        });
    }

    public function testEditCategory()
    {
        $this->browse(function (Browser $browser) {
            $this->testLogin();
            $browser->visit('http://127.0.0.1:8000/admin/categories');
            $browser->assertVisible("#edit{$this->category['cateogery_id']}")->visit($browser->attribute("#edit{$this->category['cateogery_id']}", 'href'));
            $browser->type('category_name',$this->category['category_name']);
            $browser->press('Save');
            $browser->screenshot('category/testEditCategory');

        });
    }
}
