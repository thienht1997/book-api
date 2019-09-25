<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = DB::table('books')
            ->join('authors', 'authors.id', '=', 'books.author_id')
            ->join('categories', 'categories.id', '=', 'books.category_id')
            ->select('books.id', 'books.name', 'books.price', 'books.quantity', 'books.image', 'books.introduce', 'authors.name as authorName', 'categories.name as categoryName')
            ->orderBy('id')
            ->get();
        return response()->json($books, 200);
    }
    public function showImage($image_file)
    {
        return response()->download(public_path("images/$image_file"), 'image');
    }

    public function store(Request $request)
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
        $message = "Đã thêm thành công";
        return response()->json($message,200);

    }
    public function destroy($id)
    {
        $book = Book::find($id);
        if (!$book) {
            $statusCode= 404;
            $message = "Không tìm thấy sách";
        }
        if ($book) {
            $book->delete();
            $statusCode = 200;
            $message = "Đã xóa!";
        }
        return response()->json($message, $statusCode);
    }
}
