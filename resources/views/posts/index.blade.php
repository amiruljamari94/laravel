@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-md12">
		<h1>Admin Posts</h1>
		<a href="{{ route('admin:post:create') }}"  class="btn btn-primary">New Post</a>

	<div class="card">
	<div class="card-header">Posts</div>
	<div class="card-body">
		<table class="table">
			
			<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Body</th>
					<th>Created</th>
					<th>Author</th>
					<th>Action</th>
					
					
				</tr>
			</thead>

			<tbody>
				
				@foreach($posts as $p)
				<tr>

				<td>{{ $p->id }}</td>
				<td>{{ $p->title }}</td>
				<td>{{ $p->body }}</td>
				<!-- <td>{{ $p->created_at->format('d/m/Y') }}</td> -->
				<td>{{ $p->created_at->diffForhumans() }}</td>

				<td>{{ isset($p->user) ? $p->user->name : '' }}</td>

				<td>
					<a href="{{ route('admin:post:edit', $p) }}" class="btn btn-primary">Edit</a>
					<a href="{{ route('admin:post:delete', $p) }}" class="btn btn-danger" onclick="return confirm('Are You sure')">Delete</a>
				</td>

				</tr>
				@endforeach
				
			</tbody>
		</table>
	</div>
	</div>

	{{ $posts->links() }}
	</div>
	
</div>

@endsection