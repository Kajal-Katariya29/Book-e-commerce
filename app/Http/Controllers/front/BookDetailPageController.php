<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookList;

class BookDetailPageController extends Controller
{
    public function bookDetail($id){
        $bookData = BookList::where('book_id',$id)->with('bookMedia','variants')->get();
        return view('front.HomePage.bookDetailPage',compact('bookData'));
    }
}
