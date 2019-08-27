<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Category;
use App\Http\Requests\PostRequest as Request;
use App\Listeners\CreatePostSlug;
// use App\Events\PostCreated;

class PostsController extends Controller
{
    public function index(Post $post)
    {
    	$posts = Post::orderBy('created_at', 'DESC')->paginate(5);
    	return view('posts.index')->with(compact ('posts'));//with nak past data dari controller ke view
    }

    public function create()
    {
        $categories = $this->getCategories(); //1:13 slot 3 dan 1:32



    	return view('posts.create')->with(compact('categories'));
    }

    

    public function store(Request $request)
    {
    	// $post =  new Post();
    	// $post->title = $request->get('title');
    	// $post->body = $request->get('body');
    	// $post->save();

    	//current logged user
    	$user = auth()->user();

        //utk display kan nama user_id
        $post = $user->posts()->create($request->only('title', 'body')); //24:00 slot 3

        //1:21
        $post->categories()->sync($request->get('categories'));

    	//$post = Post::create($request->only('title', 'body'));

        //Trigger Events
        event(new CreatePostSlug($post));

         if($request->has('image'))
        {
            $path = $request->file('image')->store('public');

            $paths = explode('/', $path);
            $filename = $paths[1];
            $post->update(['image' => $filename]);
        }



    	return redirect()->route('admin:post:index');
    }

    public function edit(Post $post)
    {
        $categories = $this->getCategories();

        $selectedCategories = $post->categories->pluck('id');
        
    	return view('posts.edit')->with(compact ('post', 'categories', 'selectedCategories'));
    }

    public function getCategories()// 131:00 slot 3
    {
        return Category::orderBy('name')->get()->pluck('name', 'id');
    }

    public function uploadImage($post, $imageFile)
    {
        $path = $imageFile->store('public');
        $paths = explode('/', $path);
        $filename = $paths[1];
        $post->update(['image' => $filename]);
    }

    public function update(Request $request, Post $post)
    {
    	// return view('posts.update')->with(compact ('post'));
    	// $post->title = $request->get('title');
    	// $post->body = $request->get('body');
    	// $post->save();



    	$post->update($request->only('title', 'body'));

        $post->categories()->sync($request->get('categories')); //1:43 slot 3

        if($request->has('image'))
        {
            $this->uploadImage($post, $request->file('image'));
        }

    	return redirect()->route('admin:post:index');
    }

    public function delete(Post $post)
    {
    	$post->delete();

    	return redirect()->route('admin:post:index');

    }
}
