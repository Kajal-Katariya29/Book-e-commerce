<?php

namespace App\Http\Controllers\admin\Category;

use App\Http\Controllers\Controller;
use App\Models\BookList;
use App\Models\CategoryList;
use Illuminate\Http\Request;

use App\Http\Requests\CategoryListRequset;

class CategoryController extends Controller
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
        $categoryDetails = CategoryList::orderby('cateogery_id','desc')->get();
        return view('admin.Category.index',compact('categoryDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_parent_id = CategoryList::select('cateogery_id','category_name')->pluck('category_name','cateogery_id');
        return view('admin.Category.create',compact('category_parent_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryListRequset $request)
    {
        $categoryData = CategoryList::create([
            'category_parent_id' => $request->category_parent_id !== null ? $request->category_parent_id : null,
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('categories.index')->with('success','Category data is added successfully !');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryData = CategoryList::where('cateogery_id',$id)->first();
        return view('admin.Category.edit',compact('categoryData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryListRequset $request, $id)
    {
        $categoryData = CategoryList::where('cateogery_id',$id)->update([
            'category_parent_id' => NULL,
            'category_name' => $request->category_name,
        ]);

        if(empty($categoryData)){

            return redirect()->route('categories.index')->with('error','The Data is not available !!');
        }

        return redirect()->route('categories.index')->with('success','Category Data Updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoryData = CategoryList::where('cateogery_id',$id)->delete();

        if(empty($categoryData)){

            return redirect()->route('categories.index')->with('error','The Data is not available !!');
        }

        return redirect()->route('categories.index')->with('success','Book Record deleted successfully !!');
    }
}
