<?php

namespace App\Http\Controllers;

use App\Category;
use App\FoodList;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->has('category')){
            $foodlists = FoodList::where([
                ['category_id', request('category')]
            ])->get();
        } else {
            $foodlists = FoodList::all();
        }

        $categories = Category::all();



        $highlights = Foodlist::where('highlighted', 1)->get();

        return view('home', ['foodlists' => $foodlists, 'highlights' => $highlights, 'categories' => $categories]);
    }
}
