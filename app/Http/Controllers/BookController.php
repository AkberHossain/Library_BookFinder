<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function store(Request $request)
    {
        Book::create([

            'name' => $request->name , 
            'author_id' => $request->author_id

        ]);
    }

    public function getAllBook(Request $request)
    {

        $books = Book::where('author_id' , $request->author_id )->get();

        return response()->json($books);
    }
}
