<?php

namespace App\Http\Controllers\admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryList;

class categorySubSubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryDetails = CategoryList::with('subCategory')->get();
        dd($categoryDetails);
        return view('admin.SubSubCategory.index',compact('categoryDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_parent_parent_id = CategoryList::where('category_parent_id','0')->select('cateogery_id','category_name')->pluck('category_name','cateogery_id');
        return view('admin.SubSubCategory.create',compact('category_parent_parent_id'));
    }

    public function fetchCategory(Request $request)
    {
        $fetchCategoryData = CategoryList::where('category_parent_id',$request->category_parent_parent_id)->get(['cateogery_id','category_name']);
        return response()->json($fetchCategoryData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoryData = CategoryList::create([
            'category_name' => $request->category_name,
            'category_parent_id' => $request->category_parent_id,
        ]);
        return redirect()->route('sub-sub-categories.index')->with('success','Category data is added successfully !');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
