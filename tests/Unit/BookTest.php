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
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Upload;

class BookTest extends TestCase
{
    use WithFaker;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testcreatebook()
    {
        $mockBook =  Mockery::mock(BookList::class);
        $mockVariant =  Mockery::mock(Variant::class);
        $mockVarintType = Mockery::mock(VariantType::class);
        $mockCategoryList = Mockery::mock(CategoryList::class);
        $mockBookMedia = Mockery::mock(BookMedia::class);
        $mockCategoryMapping = Mockery::mock(CategoryMapping::class);
        $mockVarintMapping = Mockery::mock(VariantMapping::class);

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
        $mockVariant->shouldReceive('all')->once()->andReturn($variantdata);
        $mockVarintType->shouldReceive('all')->once()->andReturn($varianttypedata);
        $mockCategoryList->shouldReceive('all')->once()->andReturn($categorydata);
        $bookController = new BookListController($mockBook,$mockVariant,$mockVarintType,$mockCategoryList,$mockBookMedia,$mockCategoryMapping,$mockVarintMapping);

        $response =  $bookController->create();
    }

    public function testStoreBook()
    {
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

        Storage::fake('public');
        $file = Array (UploadedFile::fake()->image('image.jpg', 1, 1));
        $request = new BookListRequest([
            'name' => $book->name,
            'description' => $book->description,
            'book_id' => $book->book_id,
            'author' => $book->author,
            'price'=> $book->price,
            'removed_variant_mapping_id' => $variantMapping->variant_mapping_id,
            'variant_mapping_id' => [$variantMapping->variant_mapping_id],
            'variant_id' => [$variant->variant_id],
            'variant_type_name' => [$variantType->variant_type_id],
            'images' => $file,
            'category_name' => $category->cateogery_id,
            'subCategory_name' => $category->category_parent_id,
            'book_price' => [$variantMapping->book_price],
        ]);

        $request->files->set('images',$file);

        $bookData = collect([
            'name' => $book->name,
            'description' => $book->description,
            'author' => $book->author,
            'price'=> $book->price,
            'book_id' => $book->book_id
        ]);

        $mockBook->shouldReceive('create')->once()->andReturn($bookData);
        $mockBookMedia->shouldReceive('create')->once()->andReturnTrue();
        $mockVarintMapping->shouldReceive('setAttribute')->times(4);
        $mockVarintMapping->shouldReceive('save')->once();

        $mockCategoryMapping->shouldReceive('create')->once()->andReturn(true);

        $bookController = new BookListController($mockBook,$mockVariant,$mockVarintType,$mockCategoryList,$mockBookMedia,$mockCategoryMapping,$mockVarintMapping);

        $response = $bookController->store($request);
    }

    public function testUpdateBook()
    {
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

        $bookId = $book->book_id;
        $removed_variant_mapping_id = [$variantMapping->variant_mapping_id];
        $variant_mapping_id = $variantMapping->variant_mapping_id;

        Storage::fake('public');
        $file = Array (UploadedFile::fake()->image('image.jpg', 1, 1));

        $request = new BookListRequest([
            'name' => $book->name,
            'description' => $book->description,
            'book_id' => $book->book_id,
            'author' => $book->author,
            'price'=> $book->price,
            'removed_variant_mapping_id' => $variantMapping->variant_mapping_id,
            'variant_mapping_id' => [$variantMapping->variant_mapping_id],
            'variant_id' => [$variant->variant_id],
            'variant_type_name' => [$variantType->variant_type_id],
            'images' => $file,
            'category_name' => $category->cateogery_id,
            'subCategory_name' => $category->category_parent_id,
            'book_price' => [$variantMapping->book_price],
        ]);

        $request->files->set('images',$file);

        $mockBook->shouldReceive('where')->with('book_id', $bookId)->once()->andReturnSelf();
        $mockBook->shouldReceive('update')->once()->andReturnSelf();
        $mockVarintMapping->shouldReceive('whereIn')->with('variant_mapping_id',$removed_variant_mapping_id)->once()->andReturnSelf();
        $mockVarintMapping->shouldReceive('delete')->once()->andReturnTrue();
        $mockVarintMapping->shouldReceive('where')->with('variant_mapping_id',$variant_mapping_id)->once()->andReturnSelf();
        $mockVarintMapping->shouldReceive('first')->once()->andReturnSelf();
        $mockVarintMapping->shouldReceive('setAttribute')->times(4);
        $mockVarintMapping->shouldReceive('save')->once();
        $mockCategoryMapping->shouldReceive('create')->with('book_id',$bookId)->once()->andReturnSelf();
        $mockCategoryMapping->shouldReceive('update')->with([
            'book_id' => $bookId,
            'cateogery_id' =>$category->category_parent_id,
        ])->once();

        $bookController = new BookListController($mockBook,$mockVariant,$mockVarintType,$mockCategoryList,$mockBookMedia,$mockCategoryMapping,$mockVarintMapping);

        $response = $bookController->update($request,$bookId);
    }

    public function testDeleteBoook()
    {
        $mockBook =  Mockery::mock(BookList::class);
        $mockBookMedia = Mockery::mock(BookMedia::class);
        $mockVarintMapping = Mockery::mock(VariantMapping::class);
        $mockCategoryMapping = Mockery::mock(CategoryMapping::class);
        $mockVariant =  Mockery::mock(Variant::class);
        $mockVarintType = Mockery::mock(VariantType::class);
        $mockCategoryList = Mockery::mock(CategoryList::class);

        $book = BookList::factory()->create();
        $bookId = $book->book_id;

        $mockBook->shouldReceive('where')->with('book_id',$bookId)->once()->andReturnSelf();
        $mockBook->shouldReceive('delete')->once()->andReturnTrue();
        $mockVarintMapping->shouldReceive('where')->with('book_id',$bookId)->once()->andReturnSelf();
        $mockVarintMapping->shouldReceive('delete')->once()->andReturnTrue();
        $mockCategoryMapping->shouldReceive('where')->with('book_id',$bookId)->once()->andReturnSelf();
        $mockCategoryMapping->shouldReceive('delete')->once()->andReturnTrue();

        $bookController = new BookListController($mockBook,$mockVariant,$mockVarintType,$mockCategoryList,$mockBookMedia,$mockCategoryMapping,$mockVarintMapping);

        $response = $bookController->destroy($bookId);
    }
}
