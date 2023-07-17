<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\CategoryList;

class SubCategoryTest extends DuskTestCase
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

    public function testCreateSubCategory()
    {
        $this->browse(function (Browser $browser){
            $this->testLogin();
            $browser->visit('http://127.0.0.1:8000/admin/sub-categories')->assertSee('Book-e-Sale');
            $browser->clickLink('ADD Sub Category');
            $browser->select('category_parent_id',$this->category['category_parent_id']);
            $browser->type('category_name',$this->category['category_name']);
            $browser->press('Save');
            $browser->screenshot('subcategory/testCreateSubCategory');
        });
    }

}
