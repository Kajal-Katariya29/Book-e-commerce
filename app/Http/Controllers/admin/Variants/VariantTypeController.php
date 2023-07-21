<?php

namespace App\Http\Controllers\admin\variants;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VariantType;
use App\Models\Variant;
use App\Http\Requests\VariantTypeRequest;

class VariantTypeController extends Controller
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
        $variantTypeNames = VariantType::orderby('variant_type_id','desc')->get();
        return view('admin.VariantTypes.index',compact('variantTypeNames'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $variant_type = Variant::select('variant_id','variant_type')->pluck('variant_type','variant_id');
        return view('admin.VariantTypes.create',compact('variant_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VariantTypeRequest $request)
    {
        VariantType::create($request->only(['variant_id','variant_type_name']));
        return redirect()->route('variant-type.index');
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
        $variantTypeData = VariantType::where('variant_type_id',$id)->first();
        $variant_type = Variant::select('variant_id','variant_type')->pluck('variant_type','variant_id');
        return view('admin.VariantTypes.edit',compact('variantTypeData','variant_type'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VariantTypeRequest $request, $id)
    {
        $variantTypeData = VariantType::where('variant_type_id',$id)->update($request->only(['variant_id','variant_type_name']));

        if(empty($variantTypeData)){

            return redirect()->route('variant-type.index')->with('error','The Data is not available !!');
        }

        return redirect()->route('variant-type.index')->with('success','Variant Type Data is Updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $variantTypeData = VariantType::where('variant_type_id',$id)->delete();

        if(empty($variantTypeData)){

            return redirect()->route('variant-type.index')->with('error','The Data is not available !!');
        }

        return redirect()->route('variant-type.index')->with('success','Variant Type Data is deleted successfully !!');
    }
}
