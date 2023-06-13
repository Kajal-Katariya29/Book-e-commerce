<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookList;
use App\Http\Requests\BookListRequest;

class BookListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        return view('admin.BookList.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookListRequest $request)
    {
        BookList::create($request->only(['name','description','price','author']));

        if($request->hasFile('images')){
            $filenameWithExt = $request->file('images')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('images')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request->file('images')->storeAs('public/BookImages', $fileNameToStore);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bookData = BookList::where('book_id',$id)->first();
        return view('admin.BookList.edit',compact('bookData'));
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
        $bookDetail = BookList::where('book_id',$id)->update($request->only(['name','description','price','author']));
        if(empty($bookDetail)){
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
        $bookDetail = BookList::where('book_id',$id)->delete();
        if(empty($bookDetail)){
            return redirect()->route('books.index')->with('error','The Data is not available !!');
        }
        return redirect()->route('books.index')->with('success','Book Record deleted successfully !!');
    }
}
