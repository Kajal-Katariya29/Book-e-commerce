<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookList;

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
        return view('admin.BookList.bookListShow',compact('bookDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id=null)
    {
        $bookData = null;
        return view('admin.BookList.bookListCreateEdit',compact('bookData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'author' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);
        BookList::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'author'=>$request->author,
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!empty($id)){
            $bookData = BookList::where('book_id',$id)->first();
        }
        return view('admin.BookList.bookListCreateEdit',compact('bookData'));
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
        $request->validate([
            'name' => 'required',
            'author' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);
        BookList::where('book_id',$id)->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'author'=>$request->author,
        ]);
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
        BookList::where('book_id',$id)->delete();
        return redirect()->route('books.index')->with('success','Book Record deleted successfully !!');
    }
}
