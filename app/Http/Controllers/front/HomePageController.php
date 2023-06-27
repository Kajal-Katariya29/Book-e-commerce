<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookList;
use App\Models\VariantMapping;
use App\Models\VariantType;

class HomePageController extends Controller
{
    public function viewHomePage(){
        $bookData = BookList::with('bookMedia','variants')->get();
        // dd($bookData);
        return view('front.HomePage.homePage',compact('bookData'));
    }
}
