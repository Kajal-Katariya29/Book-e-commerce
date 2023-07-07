<?php

namespace Tests\Feature;

use App\Models\BookList;
use App\Models\BookMedia;
use App\Models\CategoryList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Variant;
use App\Models\VariantType;

class BookListTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/books');

        $response->assertStatus(200);
    }

    public function test_only_admin_can_store_new_book()
    {
        $user = User::factory()->create();
        $book = BookList::factory()->create();
        $category = CategoryList::factory()->create();
        $variant = Variant::factory()->create();
        $variantType = VariantType::factory()->create();
        $bookMedia = BookMedia::factory()->create();
        $response = $this->actingAs($user)->post('/admin/books',[
            'name' => $book->name,
            'description' => $book->description,
            'author' => $book->author,
            'price'=> $book->price,
            'variant_id' => [$variant->variant_id],
            'variant_type_name' => [$variantType->variant_type_id],
            'images' => $bookMedia->media_name,
            'category_name' => $category->cateogery_id,
            'subCategory_name' => $category->category_parent_id,
            'book_price' => [$book->book_price]
        ]);
        $response->assertRedirect('/admin/books');
    }

    public function test_only_admin_can_edit_book()
    {
        $user = User::factory()->create();
        $book = BookList::factory()->create();
        $category = CategoryList::factory()->create();
        $variant = Variant::factory()->create();
        $variantType = VariantType::factory()->create();
        $bookMedia = BookMedia::factory()->create();
        $response = $this->actingAs($user)->patch('/admin/books' . $book->book_id ,[
            'name' => $book->name,
            'description' => $book->description,
            'author' => $book->author,
            'price'=> $book->price,
            'variant_id' => [$variant->variant_id],
            'variant_type_name' => [$variantType->variant_type_id],
            'images' => $bookMedia->media_name,
            'category_name' => $category->cateogery_id,
            'subCategory_name' => $category->category_parent_id,
            'book_price' => [$book->book_price]
        ]);
        $response->assertRedirect('/admin/books');
    }
}
