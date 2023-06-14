<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookList;
use App\Models\BookMedia;
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
        $bookList = BookList::create($request->only(['name','description','price','author']));
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
        $bookData = BookList::with('bookMedia')->where('book_id',$id)->first();
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
