<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Http\Requests\StoreBookValidation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = DB::table('books')
            ->join('authors', 'authors.id', '=', 'books.author_id')
            ->join('categories', 'categories.id', '=', 'books.category_id')
            ->select('books.*','authors.name as authorName', 'categories.name as categoryName')
            ->orderBy('id')
            ->get();
        return response()->json($books, 200);
    }
    public function showImage($image_file)
    {
        return response()->download(public_path("images/$image_file"), 'image');
    }

    public function store(StoreBookValidation $request)
    {
        $book = $request->all();
        if (!$request->hasFile('image')) {
            $request['image'] = '';
        } else {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $newFileName = rand(11111, 99999) . "_" . $fileName;
            $request->file('image')->move('images',$newFileName);
            $book['image'] = $newFileName;
        }
        Book::create($book);
        $data = [
            'message' => trans('messages.store_success')
          ];
        return response()->json($data,200);

    }

    public function upload(Request $request)
    {
        if (!$request->hasFile('image')) {
            $request['image'] = '';
            $data = [
                'message' => trans('Fail!!!')
              ];
        } else {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $newFileName =  $fileName;
            $request->file('image')->move('images',$newFileName);
            $data = [
                'message' => trans('Succes!!!')
              ];
        }

        return response()->json($data,200);

    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        $statusCode = 200;
        if (!$book)
            $statusCode = 404;

        return response()->json($book, $statusCode);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->all());
        $old_img=$book->image;
        if(!$request->image){
           $book->image = $old_img;
        }
           $book->save();
            $statusCode = 200;
            $data = [
                'message' => trans('messages.update_success')
              ];        
        return response()->json($data, $statusCode);
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        if (!$book) {
            $statusCode= 404;
            $data = [
                'error_message' => trans('messages.find_error')
              ];
        }
        if ($book) {
            $book->delete();
            $statusCode = 200;
            $data = [
                'message' => trans('messages.delete_success')
              ];
        }
        return response()->json($data, $statusCode);
    }
}
