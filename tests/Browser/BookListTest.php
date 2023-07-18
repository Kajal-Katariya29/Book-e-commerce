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

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->book = BookList::factory()->definition();
        $this->bookMedia = BookMedia::factory()->definition();
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


    public function getAllData(){
        $variant = Variant::factory()->create();
        $varaintType = VariantType::factory()->create(['variant_id'=> $variant->variant_id ]);
        $category = CategoryList::factory()->create();
        $subCategory = CategoryList::factory()->create(['category_parent_id' => $category->cateogery_id ]);
        $subSubCategory = CategoryList::factory()->create(['category_parent_id'  => $subCategory->cateogery_id]);

        return ['variant' => $variant, 'variant_type' => $varaintType, 'category' =>  $category, 'subCategory' => $subCategory, 'subSubCategory' => $subSubCategory];
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
            $data = $this->getAllData();
            $browser->clickLink('ADD Books');
            $browser->type('name',$this->book['name']);
            $browser->type('author',$this->book['author']);
            $browser->type('price',$this->book['price']);
            $browser->type('description',$this->book['description']);
            $browser->select('variant_id[]',$data['variant']->variant_id);
            $browser->select('variant_type_name[]',$data['variant_type']->variant_type_id);
            $browser->type('book_price[]','1000');
            $browser->press('+');
            $browser->attach('images[]',$this->bookMedia['media_name']);
            $browser->pause(4000);
            $browser->select('category_name',$data['category']->cateogery_id);
            $browser->waitUntil('!$.active');
            $browser->select('sub_category_name',$data['subCategory']->cateogery_id);
            $browser->waitUntil('!$.active');
            $browser->select('sub_sub_category_name',$data['subSubCategory']->cateogery_id);
            $browser->waitUntil('!$.active');
            $browser->press('Save');
            $browser->screenshot('bookList/testCreateBook');
        });
    }

    public function testEditBook()
    {
        $this->browse(function (Browser $browser) {
            $this->testLogin();
            $data = $this->getAllData();
            $book = BookList::factory()->create();
            $bookMedia = BookMedia::factory()->create(['book_id' => $book->book_id]);
            $variantMapping = VariantMapping::factory()->create(['book_id' => $book->book_id,'variant_id' => $data['variant']->variant_id , 'variant_type_id' => $data['variant_type']->variant_type_id ]);
            $categoryMapping = CategoryMapping::factory()->create(['book_id' => $book->book_id, 'cateogery_id' => $data['subSubCategory']->cateogery_id]);
            $browser->visit('http://127.0.0.1:8000/admin/books')->assertSee('Book-e-Sale');
            $browser->assertVisible("#edit{$book->book_id}")->visit($browser->attribute("#edit{$book->book_id}", 'href'));
            $browser->type('name',$book->name);
            $browser->type('author',$book->author);
            $browser->type('price',$book->price);
            $browser->type('description',$book->description);
            $browser->select('variant_id[]',$data['variant']->variant_id);
            $browser->select('variant_type_name[]',$data['variant_type']->variant_type_id);
            $browser->type('book_price[]','1000');
            $browser->attach('images[]',$this->bookMedia['media_name']);
            $browser->pause(4000);
            $browser->select('category_name',$data['category']->cateogery_id);
            $browser->waitUntil('!$.active');
            $browser->select('sub_category_name',$data['subCategory']->cateogery_id);
            $browser->waitUntil('!$.active');
            $browser->select('sub_sub_category_name',$data['subSubCategory']->cateogery_id);
            $browser->waitUntil('!$.active');
            $browser->scrollTo('#editData');
            $browser->waitFor('#editData');
            $browser->pause(3000);
            $browser->press('Save');
            $browser->screenshot('bookList/testEditBook');
        });
    }

    public function testDeleteBook()
    {
        $this->browse(function (Browser $browser) {
            $this->testLogin();
            $data = $this->getAllData();
            $bookData = BookList::factory()->create();
            $bookMedia = BookMedia::factory()->create(['book_id' => $bookData->book_id]);
            $variantMapping = VariantMapping::factory()->create(['book_id' => $bookData->book_id,'variant_id' => $data['variant']->variant_id , 'variant_type_id' => $data['variant_type']->variant_type_id ]);
            $categoryMapping = CategoryMapping::factory()->create(['book_id' => $bookData->book_id, 'cateogery_id' => $data['subSubCategory']->cateogery_id]);
            $browser->visit('http://127.0.0.1:8000/admin/books');
            $browser->screenshot('bookList/testDeleteBook');
            $browser->click("@delete_{$bookData->book_id}");
        });
    }
}



