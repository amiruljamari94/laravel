<?php

namespace App;
use App\Post;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = ['name'];

  	public function posts()
  	{
  		//categories belongToMany posts
  		return $this->belongsToMany('App\Post');
  	}
}
