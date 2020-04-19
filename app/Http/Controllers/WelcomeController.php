<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Tag;
use App\Post;
use App\Product;

class WelcomeController extends Controller
{
    public function index()
    {
        

        return view('welcome')

        ->with('categories', Category::all())
        ->with('tags', Tag::all())
        ->with('posts', Post::searched()->simplePaginate(3))//laravel will call scopeSearch method on the query builder and on  controller we just need to state this in case needed to add search functionality
        ->with('products', Product::all());
    }
}
