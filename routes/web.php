<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/foodlists/create', [
    'uses' => 'FoodlistsController@create',
    'as' => 'foodlist.create',
])->middleware('roles:Admin|Foodmentor|User');

Route::get('/foodlists', [
    'uses' => 'FoodlistsController@index',
    'as' => 'foodlist.index',
])->middleware('roles:Admin');

Route::post('/foodlists', [
    'uses' => 'FoodlistsController@store',
    'as' => 'foodlist.store',
])->middleware('roles:Admin|Foodmentor|User');

Route::get('/foodlists/{id}', [
    'uses' => 'FoodlistsController@show',
    'as' => 'foodlist.show',
])->middleware('roles:Admin|Foodmentor|User');

Route::get('/foodlists/{id}/edit', [
    'uses' => 'FoodlistsController@edit',
    'as' => 'foodlist.edit',
])->middleware('roles:Admin|Foodmentor|User');

Route::patch('/foodlists/{id}', [
    'uses' => 'FoodlistsController@update',
    'as' => 'foodlist.update',
])->middleware('roles:Admin|Foodmentor|User');

Route::get('/foodlist/highlight/{id}', [
    'uses' => 'FoodListsController@highlight',
    'as' => 'foodlist.highlight',
])->middleware('roles:Admin|Foodmentor');

Route::delete('/foodlists/{id}', [
    'uses' => 'FoodListsController@destroy',
    'as' => 'foodlist.destroy',
])->middleware('roles:Admin');


Route::get('/comments/create', [
    'uses' => 'CommentsController@create',
    'as' => 'comments.create',
])->middleware('roles:Admin');

Route::get('/comments', [
    'uses' => 'CommentsController@index',
    'as' => 'comments.index',
])->middleware('roles:Admin');

Route::post('/comments', [
    'uses' => 'CommentsController@store',
    'as' => 'comments.store',
])->middleware('roles:Admin|Foodmentor|User');

Route::get('/comments/{id}', [
    'uses' => 'CommentsController@show',
    'as' => 'comments.show',
])->middleware('roles:Admin');

Route::get('/comments/{id}/edit', [
    'uses' => 'CommentsController@edit',
    'as' => 'comments.edit',
])->middleware('roles:Admin');

Route::patch('/comments/{id}', [
    'uses' => 'CommentsController@update',
    'as' => 'comments.update',
])->middleware('roles:Admin');

Route::delete('/comments/{id}', [
    'uses' => 'CommentsController@destroy',
    'as' => 'comments.destroy',
])->middleware('roles:Admin');

//Route::resource('comments', 'CommentsController')->middleware('roles:Admin');

Route::resource('categories', 'CategoriesController')->middleware('roles:Admin');