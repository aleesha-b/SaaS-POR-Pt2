<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function home()
    {
        return view('static.home');
    }
}
