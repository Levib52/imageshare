<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class PagesController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('index');
    }
}
