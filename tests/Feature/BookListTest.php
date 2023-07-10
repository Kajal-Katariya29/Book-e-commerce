<?php

namespace Tests\Feature;

use App\Models\BookList;
use App\Models\BookMedia;
use App\Models\CategoryList;
use App\Models\CategoryMapping;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Variant;
use App\Models\VariantMapping;
use App\Models\VariantType;

class BookListTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_the_application_returns_a_successful_response()
    // {
    //     $response = $this->get('/admin/books');
    //     $response->assertStatus(200);
    // }

    public function test_only_admin_can_store_new_book()
    {
        $user = User::factory()->create();
        $book = BookList::factory()->create();
        $category = CategoryList::factory()->create();
        $variant = Variant::factory()->create();
        $variantType = VariantType::factory()->create();
        $bookMedia = BookMedia::factory()->create(['book_id' => $book->book_id]);
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

    public function test_only_admin_can_update_book()
    {
        $user = User::factory()->create();
        $book = BookList::factory()->create();
        $category = CategoryList::factory()->create();
        $variant = Variant::factory()->create();
        $variantType = VariantType::factory()->create();
        $bookMedia = BookMedia::factory()->create(['book_id' => $book->book_id]);
        $variantMapping = VariantMapping::factory()->create(['book_id' => $book->book_id,'variant_id' => $variant->variant_id , 'variant_type_id' => $variantType->variant_type_id ]);

        $input = [
            'name' => $book->name,
            'description' => $book->description,
            'author' => $book->author,
            'price'=> $book->price,
            'removed_variant_mapping_id' => $variantMapping->variant_mapping_id,
            'variant_mapping_id' => [$variantMapping->variant_mapping_id],
            'variant_id' => [$variant->variant_id],
            'variant_type_name' => [$variantType->variant_type_id],
            'images' => $bookMedia->media_name,
            'category_name' => $category->cateogery_id,
            'subCategory_name' => $category->category_parent_id,
            'book_price' => [$variantMapping->book_price]
        ];
        $response = $this->actingAs($user)->patch('/admin/books/' . $book->book_id , $input);
        $response->assertRedirect('/admin/books');
    }

    public function test_only_admin_can_delete_book()
    {
        $user = User::factory()->create();
        $book = BookList::factory()->create();
        $category = CategoryList::factory()->create();
        $variant = Variant::factory()->create();
        $variantType = VariantType::factory()->create();
        $bookMedia = BookMedia::factory()->create(['book_id' => $book->book_id]);
        $variantMapping = VariantMapping::factory()->create(['book_id' => $book->book_id,'variant_id' => $variant->variant_id , 'variant_type_id' => $variantType->variant_type_id ]);
        $categoryMapping = CategoryMapping::factory()->create(['cateogery_id' => $category->cateogery_id, 'book_id' => $book->book_id]);

        $response = $this->actingAs($user)->delete('/admin/books/' . $book->book_id);
        $response->assertRedirect('/admin/books');
    }

    public function test_only_admin_can_delete_book_image(){
        $user = User::factory()->create();
        $book = BookList::factory()->create();
        $bookMedia = BookMedia::factory()->create(['book_id' => $book->book_id]);
        $response = $this->actingAs($user)->post('admin/delete-image/' . $bookMedia->book_media_id);
        $response->assertStatus(200);
    }
}
