@extends('layouts.main')

@section('css')

	<link rel="stylesheet" type="text/css" href="{{ url('/css/blog-home.css') }}">

@endsection

@section('content')

	<h1>Blog Home</h1>

	@forelse($posts as $post)

	<div class="card mb-4">
		<!-- @if(isset($post->image)) -->
			<img class="card-img-top" src="{{ $post->image_url }}">
		<!-- @endif -->

		<div class="card-body">
			<h2 class="card-title">{{ $post->title }}</h2>
			<p class="card-text">{!! Str::limit($post->body, 100) !!}</p>
			<a href="{{ route('blog:show', isset($post->slug) ? $post->slug : $post->id) }}" class="btn btn-primary">Read More &rarr;</a>
		</div>

		<div class="card-footer text-muted">
			Posted on {{ $post->created_at->format('i,d,y') }} by
			<a href="#">{{ isset($post->user) ? $post->user->name : '' }}</a>
		</div>
	</div>

	@empty
	<h3>Nothing to Show</h3>
	@endforelse


	<!-- pagination -->
	<ul class="pagination justify-content-center rb-4">
		<li class="page-item {{ $posts->hasMorePages() ? '' : 'disabled' }}">
			<a  class="page-link" href="{{ $posts->nextPageUrl() }}"><-Older</a>
		</li>
		<li class="page-item {{ $posts->onFirstPage() ? 'disable' : ''}}">
			<a class="page-link" href="{{ $posts->previousPageUrl() }}">Newer-></a>
		</li>
	</ul>


@endsection