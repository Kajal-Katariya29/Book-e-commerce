<?php

namespace App\Http\Controllers\admin\variants;

use App\Http\Controllers\Controller;
use App\Models\Variant;
use Illuminate\Http\Request;

class VariantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variants = Variant::orderby('variant_id','desc')->get();
        return view('admin.Variants.index',compact('variants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Variants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Variant::create([
            'variant_type' => $request->variant_type,
        ]);

        return redirect()->route('variants.index')->with('success','Variant Record created successfully !!');
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
        $variantData = Variant::where('variant_id',$id)->first();
        return view('admin.Variants.edit',compact('variantData'));
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
        $variantDetail = Variant::where('variant_id',$id)->update($request->only(['variant_type']));

        if(empty($variantDetail)){

            return redirect()->route('admin.Variants.index')->with('error','The Data is not available !!');

        }

        return redirect()->route('variants.index')->with('success','Variant Detail upadted successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $variantDetail = Variant::where('variant_id',$id)->delete();

        if(empty($variantDetail)){

            return redirect()->route('variants.index')->with('error','The Data is not available !!');

        }

        return redirect()->route('variants.index')->with('success','Variant Data is Deleted successfully !!');
    }
}
