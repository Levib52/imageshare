<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload()
    {
        $categories = [
            'arts & crafts',
            'antiques & collectables',
            'auto parts',
            'bicycles',
            'exercise & fitness',
            'musical instruments',
            'sports & outdoors',
            'appliances',
            'furniture',
            'garden',
            'tools',
            'computers & electronics',
            'mobile phones',
            'vehicles',
            'bags & luggage',
            'jewelry & accessories',
            "men's clothing & shoes",
            "women's clothing & shoes",
            'baby & kids',
            'health & beauty',
            'pet supplies',
            'toys & games',
            'books, movies & music',
            'video games',
            'miscellaneous'];

        return view('upload', compact('categories'));
    }
}
