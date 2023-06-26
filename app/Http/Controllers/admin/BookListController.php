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

use App\Http\Requests\BookListRequest;

class BookListController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('book.view');

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
        $this->authorize('book.create');

        $variant_type = Variant::select('variant_id','variant_type')->get()->pluck('variant_type','variant_id');

        $variant_type_name = VariantType::select('variant_type_id', 'variant_type_name')->get()->pluck('variant_type_name', 'variant_type_id');

        $category_name = CategoryList::select('cateogery_id','category_name')->where('category_parent_id','0')->get()->pluck('category_name','cateogery_id');

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
        $bookList = BookList::create($request->only(['name','description','author']));

        if ($images = $request->file('images')) {
            foreach ($images as $image) {
                $filename = $image->getClientOriginalName();
                $image->move(public_path('images/Book-Images/' . $bookList->book_id . "/"), $filename);
                BookMedia::create([
                    'book_id' => $bookList->book_id,
                    'media_name' => $filename
                ]);
            }
        }

        VariantMapping::create([
            'variant_id' => $request->variant_id,
            'book_id' => $bookList->book_id,
            'variant_type_id' => $request->variant_type_id,
            'book_price' => $request->price
        ]);

        if($request->subCategory_name){
            CategoryMapping::create([
                'book_id' => $bookList->book_id,
                'cateogery_id' => $request->subCategory_name
            ]);
        }
        else{
            CategoryMapping::create([
                'book_id' => $bookList->book_id,
                'cateogery_id' => $request->category_name
            ]);
        }

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

    public function fetchCategory(Request $requset)
    {
        $fetchCategoryData = CategoryList::where('category_parent_id',$requset->categoryId)->get(['cateogery_id','category_name']);

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

        $bookData = BookList::where('book_id',$id)->with('variants','bookMedia','categories')->first();
        $categoryData = CategoryList::where('cateogery_id',$bookData->categories->pluck('cateogery_id'))->with('subCategory')->get();

        $catData = [];
        $subData = [];
        foreach ($categoryData as $category) {
            $subcategories = $category->subCategory;
            foreach ($subcategories as $subcategory) {
                $catData[] = $subcategory->category_parent_id;
            }
        }


        foreach ($categoryData as $category) {
            $subcategories = $category->subCategory;
            foreach ($subcategories as $subcategory) {
                $subData[] = $subcategory->cateogery_id;
            }
        }

        $subCatData = CategoryList::where('category_parent_id',$catData)->select('cateogery_id','category_name')->get()->pluck('category_name','cateogery_id');
        $subCategory = CategoryList::where('category_parent_id',$subData)->select('cateogery_id','category_name')->get()->pluck('category_name','cateogery_id');
        $variant_type = Variant::select('variant_id','variant_type')->get()->pluck('variant_type','variant_id');
        $variant_type_name = VariantType::select('variant_type_id','variant_type_name')->get()->pluck('variant_type_name','variant_type_id');
        $category_name = CategoryList::where('category_parent_id','0')->select('cateogery_id','category_name')->get()->pluck('category_name','cateogery_id');

        return view('admin.BookList.edit',compact('bookData','variant_type','variant_type_name','category_name','subCatData','catData','subCategory','subData'));
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
        $bookData = BookList::where('book_id',$id)->update($request->only(['name','description','author']));

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

        VariantMapping::where('book_id',$id)->delete();
        foreach($request->variant_type_name as $variants){
            $variant_mapping = new VariantMapping();
            $variant_mapping->variant_id = $request->variant_id;
            $variant_mapping->book_id = $id;
            $variant_mapping->variant_type_id = $variants;
            $variant_mapping->book_price = $request->price;
            $variant_mapping->save();
        }

        if($request->subCategory_name){
            CategoryMapping::where('book_id',$id)->update([
                'book_id' => $id,
                'cateogery_id' => $request->subCategory_name
            ]);
        }
        else{
            CategoryMapping::where('book_id',$id)->update([
                'book_id' => $id,
                'cateogery_id' => $request->category_name
            ]);
        }

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
        $this->authorize('book.book_delete');

        $bookData = BookList::where('book_id',$id)->delete();
        $variantData = VariantMapping::where('book_id',$id)->delete();
        $categoryData = CategoryMapping::where('book_id',$id)->delete();

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
}
