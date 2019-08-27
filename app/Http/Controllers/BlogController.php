<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class BlogController extends Controller
{
    public function home()
    {
    	$posts = Post::orderBy('created_at', 'DESC')->paginate(8);
    	return view('blog.home')->with(compact('posts'));
    }

    public function show(Post $post)
    {
    	return view('blog.post')->with(compact('post'));
    }

    public function search(Request $request)
    {
    	$keyword = $request->get('keyword');
    	$posts = Post::where('title', 'LIKE', '%' . $keyword . '%')->orwhere('body', 'LIKE', '%' . $keyword . '%')->paginate();

    	return view('blog.home')->with(compact('posts'));
    }

    public function category(Category $category)
    {
    	$posts = $category->posts()->paginate();
    	return view('blog:category')->with(compact('posts'));
    }
}



