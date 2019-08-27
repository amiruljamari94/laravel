<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
//  });


Route::get('/', 'BlogController@home')->name('blog:home'); 

Route::get('post/{post}', 'BlogController@show')->name('blog:show');

Route::get('/search', 'BlogController@search')->name('blog:search');

Route::get('/category/{category}', 'BlogController@category')->name('blog:category');

Route::get('/post', function () {
    return view('blog.post');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin:', 'middleware' => 'auth'], function (){

	//admin/posts
	Route::get('/posts', 'PostsController@index')->name('post:index');

	//admin/posts/create
	Route::get('/posts/create', 'PostsController@create')->name('post:create');

	Route::post('/posts/store', 'PostsController@store')->name('post:store');

	Route::get('/posts/edit/{post}', 'PostsController@edit')->name('post:edit');

	Route::post('/posts/update/{post}', 'PostsController@update')->name('post:update');

	Route::get('/posts/delete/{post}', 'PostsController@delete')->name('post:delete');

	//return view('blog.post');

});
