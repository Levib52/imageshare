<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Profile;

class PagesController extends Controller
{
    // Index function displays the main index view
    public function index()
    {
        //grab all users from the database and store it in the users variable
        $users = User::all();
        //grab all posts from all users. list by most recent in descending order store in recentPosts variable
        $recentPosts = Post::whereIn('user_id', $users->pluck('id'))->orderBy('created_at', 'DESC')->paginate(32);
        //return the view with the varibles
        return view('index', compact('recentPosts'));
    }
}
