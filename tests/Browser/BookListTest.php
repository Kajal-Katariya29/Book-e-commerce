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
use App\Models\User;

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

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->book = BookList::factory()->create();
        $this->bookMedia = BookMedia::factory()->create();
        $this->variant = Variant::factory()->create();
        $this->variantType = VariantType::factory()->create();
        $this->category = CategoryList::factory()->create();
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
            $browser->type('name',$this->book->name);
            $browser->type('author',$this->book->author);
            $browser->type('price',$this->book->price);
            $browser->type('description',$this->book->description);
            $browser->select('variant_id[]',$this->variant->variant_id);
            $browser->select('variant_type_name[]',$this->variantType->variant_type_id);
            $browser->type('book_price[]','1000');
            $browser->press('+');
            // dd($this->category->cateogery_id);
            $browser->select('category_name',$this->category->category_name);
            $browser->pause(5000);
            $browser->attach('images[]',$this->bookMedia->media_name);
            // $browser->select('variant_id',$this->varianttype->variant_id);
            // $browser->press('Save');
            $browser->screenshot('bookList/testCreateBook');

        });
    }
}


