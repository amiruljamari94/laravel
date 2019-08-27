@extends('layouts.main')

@section('css')

	<link rel="stylesheet" type="text/css" href="{{ url('/css/blog-home.css') }}">

@endsection

@section('content')

	<h1 class="my-4">{{ $post->title }}</h1>

	<p class="lead">
		by
		<!-- <a href="">{{ $post->user->name }}</a> -->
		<a href="">{{ isset($post->user) ? $post->user->name : '' }}</a>
	</p>

	<hr>

	<p>Posted on {{ $post->created_at->format('d, Y \a\t H:1A') }}</p>

	<hr>

	@if(isset($post->image))


	<img class="img-fluid rounded" src="{{ asset('storage/' . $post->image) }}">

	@endif

	<p>{!! $post->body !!}</p>

	<hr>

@endsection