<?php

namespace App\Http\Controllers\admin\Category;

use App\Http\Controllers\Controller;
use App\Models\CategoryList;
use Illuminate\Http\Request;

class categorySubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryDetails = CategoryList::where('category_parent_id','!=',0)->get();
        return view('admin.SubCategory.index',compact('categoryDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $category_parent_id = CategoryList::where('category_parent_id','0')->select('cateogery_id','category_name')->pluck('category_name','cateogery_id');
         return view('admin.SubCategory.create',compact('category_parent_id'));
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
        return redirect()->route('sub-categories.index')->with('success','Category data is added successfully !');
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
