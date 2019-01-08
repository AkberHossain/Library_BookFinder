<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class WelcomeController extends Controller
{
    public function index(){


        return view('welcome');

    }

    
}
