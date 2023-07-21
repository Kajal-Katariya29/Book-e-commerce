<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookList;
use App\Models\BookMedia;
use App\Models\Variant;
use App\Models\VariantType;
use App\Models\VariantMapping;
use App\Models\CategoryList;
use App\Models\CategoryMapping;
use App\Policies\BookPolicy;
use DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BookListRequest;
use Illuminate\Support\Arr;

class BookListController extends Controller
{
    protected $bookList;
    protected $variant;
    protected $varianttype;
    protected $categorylist;
    protected $bookmedia;
    protected $categorymapping;
    protected $variantmapping;

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookList $bookList, Variant $variant, VariantType $varianttype, CategoryList $categorylist, BookMedia $bookmedia, CategoryMapping $categorymapping, VariantMapping $variantmapping)
    {
        $this->middleware('auth');
        $this->bookList = $bookList;
        $this->variant = $variant;
        $this->varianttype = $varianttype;
        $this->categorylist = $categorylist;
        $this->bookmedia = $bookmedia;
        $this->categorymapping = $categorymapping;
        $this->variantmapping = $variantmapping;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('book.view');
        $bookDetails = BookList::orderby('book_id','desc')->get();
        return view('admin.BookList.index',compact('bookDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('book.create');
        $variant_type =  $this->variant->pluck('variant_type','variant_id');
        $variant_type_name = $this->varianttype->pluck('variant_type_name', 'variant_type_id');
        $category_name =  $this->categorylist->where('category_parent_id',NULL)->pluck('category_name','cateogery_id');
        return view('admin.BookList.create',compact('variant_type','variant_type_name','category_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookListRequest $request)
    {
        $bookdata = $this->bookList->create([
            'name' => $request->name,
            'description' =>$request->description,
            'author' =>$request->author,
            'price' =>$request->price,
        ]);

        if ($images = $request->file('images')) {
            foreach ($images as $image) {
                $filename = $image->getClientOriginalName();
                $image->move(public_path('images/Book-Images/' . $bookdata->toArray()['book_id'] . "/"), $filename);
                $this->bookmedia->create([
                    'book_id' => $bookdata->toArray()['book_id'],
                    'media_name' => $filename
                ]);
            }
        }

        $data = $request->all();
        $variantIds = $data['variant_id'];
        $variantTypeNames = $data['variant_type_name'];
        foreach ($variantIds as $key => $variantId) {
            $variantTypeName = $variantTypeNames[$key];
            if ($variantId !== null) {
                $variantMapping = $this->variantmapping;
                $variantMapping->variant_id = $variantId;
                $variantMapping->book_id = $bookdata->toArray()['book_id'];
                $variantMapping->variant_type_id = $variantTypeName;
                $variantMapping->book_price = $data['book_price'][$key];
                $variantMapping->save();
            }
        }

        $categoryMapping = $this->categorymapping->create([
            'book_id' => $bookdata->toArray()['book_id'],
            'cateogery_id' => $request->subCategory_name ? $request->subCategory_name : $request->subCategory_name
        ]);

        return redirect()->route('books.index')->with('success','Book Record created successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function fetchCategory(Request $request)
    {
        $fetchCategoryData = CategoryList::where('category_parent_id',$request->categoryId)->get(['cateogery_id','category_name']);
        return response()->json($fetchCategoryData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $this->authorize('book.book_edit');
        $bookData = $this->bookList->where('book_id',$id)->with('variants','bookMedia','categories')->first();
        $categoryData = CategoryList::where('cateogery_id',$bookData->categories->pluck('cateogery_id'))->first();

        $category = CategoryList::where('cateogery_id',$categoryData->cateogery_id)->first();
        $subcategoryIds = $this->getAllCategories($category->cateogery_id);

        $subCategory = array_reverse($subcategoryIds);

        $variants = VariantMapping::where('book_id',$id)->get();
        $variant_type = Variant::select('variant_id','variant_type')->pluck('variant_type','variant_id');
        $variant_type_name = VariantType::select('variant_type_id','variant_type_name')->pluck('variant_type_name','variant_type_id');
        $category_name = CategoryList::where('category_parent_id',NULL)->select('cateogery_id','category_name')->pluck('category_name','cateogery_id');

        return view('admin.BookList.edit',compact('bookData','variant_type','variant_type_name','category_name','variants','category','subCategory'));
    }

    public function getAllCategories($categoryId)
    {
        $categories = [];
        $categories[] = $categoryId;

        $parentCategories = CategoryList::where('cateogery_id', $categoryId)->with('parentCategory')->get();
        foreach ($parentCategories as $category){
            foreach($category->parentCategory as $subCategory)
            {
                $categories[] = $this->getAllCategories($subCategory->cateogery_id ,$categories);
            }
        }
        return Arr::flatten($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookListRequest $request, $id)
    {
        $bookData = $this->bookList->where('book_id',$id)->update($request->only(['name','description','author','price']));

        if ($images = $request->file('images')) {
            foreach ($images as $image) {
                $filename = $image->getClientOriginalName();
                $image->move(public_path('images/Book-Images/' . $id . "/"), $filename);
                BookMedia::create([
                    'book_id' => $id,
                    'media_name' => $filename
                ]);
            }
        }

        $data = $request->all();
        $removed_variant_mapping_id = explode(",",$data['removed_variant_mapping_id']);

        if(count($removed_variant_mapping_id)>0)
        {
            $this->variantmapping->whereIn('variant_mapping_id',$removed_variant_mapping_id)->delete();
        }

        $variantIds = $data['variant_id'];
        $variantTypeNames = $data['variant_type_name'];

        foreach ($variantIds as $key => $variantId) {
            $variantTypeName = $variantTypeNames[$key];
            if ($variantId !== null) {

                $variant_mapping_id = $data['variant_mapping_id'][$key];

                $variantMapping = $this->variantmapping->where('variant_mapping_id', $variant_mapping_id)->first();

                if (!$variantMapping) {
                    $variantMapping = $this->variantmapping;
                }
                else{
                    $variantMapping = $this->variantmapping;
                    $variantMapping->variant_id = $variantId;
                    $variantMapping->book_id = $id;
                    $variantMapping->variant_type_id = $variantTypeName;
                    $variantMapping->book_price = $data['book_price'][$key];
                    $variantMapping->save();
                }
            }
        }

        $categoryMapping =  $this->categorymapping->where('book_id',$id)->update([
            'book_id' => $id,
            'cateogery_id' => $request->subCategory_name ? $request->subCategory_name : $request->category_name
        ]);

        if(empty($bookData)){
            return redirect()->route('books.index')->with('error','The Data is not available !!');
        }

        return redirect()->route('books.index')->with('success','Book Record Updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $this->authorize('book.book_delete');
        $bookData =  $this->bookList->where('book_id',$id)->delete();
        $categoryData = $this->categorymapping->where('book_id',$id)->delete();
        $variantData = $this->variantmapping->where('book_id',$id)->delete();

        if(empty($bookData)){
            return redirect()->route('books.index')->with('error','The Data is not available !!');
        }
        return redirect()->route('books.index')->with('success','Book Record deleted successfully !!');
    }

    public function deleteImage($id)
    {
        $bookMedia = BookMedia::where('book_media_id',$id)->first();

        $upload_path = "images/Book-Images/" . $bookMedia->book_id . "/";

        if (!empty($bookMedia->media_name) && file_exists($upload_path . $bookMedia->media_name)) {
            unlink($upload_path . $bookMedia->media_name);
        }

        BookMedia::where('book_media_id',$id)->delete();

        return response()->json(['status','success']);

    }

    public function deleteVariantType($id){

        $variant = VariantMapping::where('variant_type_id',$id)->delete();

        return response()->json(['status' => 'success']);

    }
}
