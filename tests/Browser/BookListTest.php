<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\BookList;
use App\Models\CategoryList;
use App\Models\Variant;
use App\Models\VariantType;
use App\Models\BookMedia;
use App\Models\CategoryMapping;
use App\Models\User;
use App\Models\VariantMapping;

class BookListTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    protected $user;
    protected $book;
    protected $bookMedia;
    protected $variant;
    protected $variantType;
    protected $category;
    protected $categoryMapping;
    protected $variantMapping;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->book = BookList::factory()->definition();
        $this->bookMedia = BookMedia::factory()->definition();
        $this->variant = Variant::factory()->definition();
        $this->variantType = VariantType::factory()->definition();
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
            $browser->screenshot('bookList/login');
        });
    }

    public function testLogout()
    {
        $this->browse(function (Browser $browser) {
            $browser->clickLink('Hello');
            $browser->clickLink('Logout');
            $browser->screenshot('bookList/logout');
        });
    }

    public function testCreateBook()
    {
        $this->browse(function (Browser $browser){
            $this->testLogin();
            $browser->visit('http://127.0.0.1:8000/admin/books')->assertSee('Book-e-Sale');
            $browser->clickLink('ADD Books');
            $browser->type('name',$this->book['name']);
            $browser->type('author',$this->book['author']);
            $browser->type('price',$this->book['price']);
            $browser->type('description',$this->book['description']);
            $browser->select('variant_id[]');
            $browser->select('variant_type_name[]');
            $browser->type('book_price[]','1000');
            $browser->press('+');
            $browser->attach('images[]',$this->bookMedia['media_name']);
            $browser->pause(4000);
            $browser->select('category_name');
            $browser->waitUntil('!$.active');
            $browser->select('sub_category_name');
            $browser->waitUntil('!$.active');
            $browser->select('sub_sub_category_name');
            $browser->waitUntil('!$.active');
            $browser->press('Save');
            $browser->screenshot('bookList/testCreateBook');
        });
    }

    public function testEditBook()
    {
        $this->browse(function (Browser $browser) {
            $this->testLogin();
            $browser->visit('http://127.0.0.1:8000/admin/books');
            $browser->assertVisible("#edit{$this->book['book_id']}")->visit($browser->attribute("#edit{$this->book['book_id']}", 'href'));
            $browser->type('name',$this->book['name']);
            $browser->type('author',$this->book['author']);
            $browser->type('price',$this->book['price']);
            $browser->type('description',$this->book['description']);
            $browser->select('variant_id[]');
            $browser->select('variant_type_name[]');
            $browser->type('book_price[]','1000');
            $browser->press('+');
            $browser->type('removed_variant_mapping_id',$this->variant['variant_id']);
            $browser->attach('images[]',$this->bookMedia['media_name']);
            $browser->pause(4000);
            $browser->select('category_name');
            $browser->waitUntil('!$.active');
            $browser->select('sub_category_name');
            $browser->waitUntil('!$.active');
            $browser->select('sub_sub_category_name');
            $browser->press('Save');
            $browser->screenshot('bookList/testEditBook');
        });
    }
}



