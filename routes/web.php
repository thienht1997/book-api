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
Route::get('/images', 'BookController@showImage');

Route::get('storage/{filename}', function ($filename)
{
    $path = storage_path('public/' . $filename);
 
    if (!File::exists($path)) {
        abort(404);
    }
 
    $file = File::get($path);
    $type = File::mimeType($path);
 
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
 
    return $response;
});


Route::post('process', function (Request $request) {
    // cache the file
    $file = $request->file('photo');
 
    // generate a new filename. getClientOriginalExtension() for the file extension
    $filename = 'profile-photo-' . time() . '.' . $file->getClientOriginalExtension();
 
    // save to storage/app/photos as the new $filename
    $path = $file->storeAs('images', $filename);
 
    dd($path);
});
