<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\FoodList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodListsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $foodlists = FoodList::where('body', 'LIKE', "%$keyword%")
                    ->paginate($perPage);
            } else {
                $foodlists = FoodList::paginate($perPage);
            }

            return view('directory.foodlists.index', compact('foodlists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $lastWeek = new Carbon();
        $lastWeek->addDays(-7);

        // Je moet minstens 7 dagen geregistreerd zijn om een nieuw schema te mogen maken
        // Dit doe ik door de registratiedatum te vergelijken met de datum van een week geleden
        $userCreatedDate = new Carbon(Auth::user()->created_at);
        if($userCreatedDate->lt($lastWeek) || Auth::user()->roles()->first()->name == 'Admin') {
            $categories = Category::all();
            $foodlist = new FoodList();
            return view('directory.foodlists.create', ['categories' => $categories, 'foodlist' => $foodlist]);
        } else {
            $diff = $lastWeek->diff($userCreatedDate);
            $flashmessage = 'Helaas moet je nog ' . $diff->days . ' dagen actief zijn om een schema te kunnen maken.';
            return redirect('/home')->with('flash_message', $flashmessage);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();

        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        FoodList::create($requestData);

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $comments = Comment::where('commentable_id', $id)->orderBy('created_at', 'asc')->get();
        $foodlist = FoodList::findOrFail($id);

        return view('directory.foodlists.show', ['foodlist' => $foodlist, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $foodlist = FoodList::findOrFail($id);
        $categories = Category::all();

        if (Auth::user()->id == $foodlist->user_id || Auth::user()->roles()->first()->name == 'Admin') {
            return view('directory.foodlists.edit', ['foodlist' => $foodlist, 'categories' => $categories]);
        } else {
            return redirect('home');
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $foodlist = FoodList::findOrFail($id);
        $foodlist->update($requestData);

        return redirect('/home');
    }

    public function highlight($id)
    {
        $foodlist = FoodList::findOrFail($id);

        if ($foodlist->highlighted == 0) {
            $foodlist->highlighted = 1;
            $foodlist->save();

            return redirect('foodlists/' . $id)->with('flash_message', 'Schema uitgelicht!');
        } else {
            $foodlist->highlighted = 0;
            $foodlist->save();

            return redirect('foodlists/' . $id)->with('flash_message', 'Schema niet meer uitgelicht!');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        FoodList::destroy($id);

        return redirect('foodlists')->with('flash_message', 'Schema verwijderd!');
    }
}
