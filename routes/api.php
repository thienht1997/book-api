<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});

Route::group(['prefix'=>'book'], function (){
    Route::get('/', 'BookController@index')->name('books.all');
    Route::post('/store', 'BookController@store')->name('books.store');
    Route::get('/{id}', 'BookController@show')->name('books.show');
    Route::put('update/{id}', 'BookController@update')->name('books.update');
    Route::delete('delete/{id}', 'BookController@destroy')->name('books.destroy');
});
Route::group(['prefix'=>'category'], function (){
    Route::get('/', 'CategoryController@index')->name('categories.all');
});
Route::group(['prefix'=>'author'], function (){
    Route::get('/', 'AuthorController@index')->name('authors.all');
});

Route::get('images/{image_file}', 'BookController@showImage');

Route::post('upload', 'BookController@upload');

