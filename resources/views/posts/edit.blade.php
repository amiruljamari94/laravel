@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">		
			<div class="card">
				<div class="card-header">Update Posts</div>
				<div class="card-body">

					@include('posts.partials.post-form', ['action' => route('admin:post:update', $post), 'post' => $post])
	
				</div>
			</div>	
		</div>
	</div>
	
</div>


@endsection