<?php

namespace App;
use App\Category;
use App\Events\PostCreated;
use App\listener\CreatePostSlug;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	//mass assignment
    protected $fillable = ['title', 'body', 'image', 'slug'];

    protected $dispatchesEvents = [ 'created' => PostCreated::class ];

    //post belong to user
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function categories()
    {
    	//Post belongsToMany categories
    	return $this->belongsToMany('App\Category');
    }

    public function getRouteKeyName()
    {
        $params = request()->route()->post;
        return is_numeric($params) ? 'id' : 'slug';
    }

    public function getAuthorAttribute()
    {
        return isset($this->user) ? $this->user->name : '';
    }

    public function getImageUrl()
    {
        return isset($this->image) ? asset('/storage' . $this->image) : 'https://placeholder.it/500x200';
    }
}
