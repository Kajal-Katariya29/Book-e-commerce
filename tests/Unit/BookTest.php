<?php

namespace Tests\Unit;

use App\Http\Controllers\admin\BookListController;
use App\Models\BookList;
use App\Models\CategoryList;
use App\Models\VariantType;
use App\Models\Variant;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;
use App\Http\Requests\BookListRequest;
use App\Models\BookMedia;
use App\Models\CategoryMapping;
use App\Models\VariantMapping;
use Illuminate\Http\Request;
use App\Models\User;

class BookTest extends TestCase
{
    use WithFaker;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testcreatebook(){

        $mockBook =  Mockery::mock(BookList::class);
        $mockVariant =  Mockery::mock(Variant::class);
        $mockVarintType = Mockery::mock(VariantType::class);
        $mockCategoryList = Mockery::mock(CategoryList::class);
        $mockBookMedia = Mockery::mock(BookMedia::class);
        $mockCategoryMapping = Mockery::mock(CategoryMapping::class);

        $variantdata = collect([
            'variant_id' => 45,
            'variant_type' => $this->faker->name()
        ]);


        $varianttypedata = collect([
            'variant_id' => Variant::factory()->create()->variant_id,
            'variant_type_name' => $this->faker->name(),
        ]);

        $categorydata = collect([
            'category_parent_id' => $this->faker->randomElement(CategoryList::all()->pluck('cateogery_id')),
            'category_name' => $this->faker->name(),
        ]);

        $mockBook->shouldReceive('first')->once()->andReturn(true);
        $mockVariant->shouldReceive('all')->once()->andReturn($variantdata)->shouldReceive('pluck')->once()->andReturn(true);
        $mockVarintType->shouldReceive('all')->once()->andReturn($varianttypedata)->shouldReceive('pluck')->once()->andReturn(true);
        $mockCategoryList->shouldReceive('all')->once()->andReturn($categorydata)->shouldReceive('where')->once()->shouldReceive('pluck')->once()->andReturn(true);
        $bookController = new BookListController($mockBook,$mockVariant,$mockVarintType,$mockCategoryList,$mockBookMedia,$mockCategoryMapping );

        $data =  $bookController->create();
    }


    public function testStoreBook(){

        $mockBook =  Mockery::mock(BookList::class);
        $mockBookMedia = Mockery::mock(BookMedia::class);
        $mockVarintMapping = Mockery::mock(VariantMapping::class);
        $mockCategoryMapping = Mockery::mock(CategoryMapping::class);
        $mockVariant =  Mockery::mock(Variant::class);
        $mockVarintType = Mockery::mock(VariantType::class);
        $mockCategoryList = Mockery::mock(CategoryList::class);

        $user = User::factory()->create();
        $book = BookList::factory()->create();
        $category = CategoryList::factory()->create();
        $variant = Variant::factory()->create();
        $variantType = VariantType::factory()->create();
        $bookMedia = BookMedia::factory()->create(['book_id' => $book->book_id]);
        $variantMapping = VariantMapping::factory()->create(['book_id' => $book->book_id,'variant_id' => $variant->variant_id , 'variant_type_id' => $variantType->variant_type_id ]);

        $request = new BookListRequest([
            'name' => $book->name,
            'book_id' => $book->book_id,
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
        ]);

        $mockBook->shouldReceive('create')->once()->andReturn(true);
        $mockBookMedia->shouldReceive('create')->once()->andReturn(true);
        $mockCategoryMapping->shouldReceive('create')->once()->andReturn(true);
        $mockVariant->shouldReceive('all')->once()->shouldReceive('pluck')->once()->andReturn(true);
        $mockVarintType->shouldReceive('all')->once()->shouldReceive('pluck')->once()->andReturn(true);
        $mockCategoryList->shouldReceive('all')->once()->shouldReceive('where')->once()->shouldReceive('pluck')->once()->andReturn(true);

        $bookController = new BookListController($mockBook,$mockVariant,$mockVarintType,$mockCategoryList,$mockBookMedia,$mockCategoryMapping);
        $data =  $bookController->store($request);
    }
}
