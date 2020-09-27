<?php

namespace App\Http\Controllers;
use App\User;
use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        $request->validate([
            'query' => 'required|min:3|max:255',
        ]);

        $query = $request->input('query');
        
        $results = Post::where('postTags', 'like', "%$query%")
                        ->orderBy('created_at', 'DESC')->paginate(20);
        return view('/search-results', compact('results', 'query'));
    }
}
