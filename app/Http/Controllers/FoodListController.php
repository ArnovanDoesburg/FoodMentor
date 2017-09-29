<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FoodList;

class FoodListController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$foodlist = FoodList::all()->toArray();
		return view('food_lists.index', compact('foodlist'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('food_lists.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$foodlist = $this->validate(request(), [
				'title' => 'required',
				'text' => 'required'
		]);

		FoodList::create($foodlist);

		return back()->with('success', 'Product has been added');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$foodlist = FoodList::find($id);
		return view('food_lists.edit', compact('foodlist', 'id'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$foodlist = FoodList::find($id);
		$this->validate(request(), [
				'title' => 'required',
				'text' => 'required'
		]);
		$foodlist->title = $request->get('title');
		$foodlist->text = $request->get('text');
		$foodlist->save();
		return redirect('food_lists')->with('success', 'Foodlist has been updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$foodlist = FoodList::find($id);
		$foodlist->delete();
		return redirect('food_lists')->with('success', 'Item has been deleted');
	}
}
