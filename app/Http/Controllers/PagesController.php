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
        $recentPosts = Post::whereIn('user_id', $users)->orderBy('created_at', 'DESC')->paginate(32);

        return view('index', compact('recentPosts'));
    }
}
