<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function store(Request $request)
    {
        Author::create([

            'name' => $request->name

        ]);
    }

    public function getAllAuthor()
    {
        $authors = Author::all();

        return response()->json($authors);
    }
}
