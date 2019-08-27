<!--Form-->
					<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
						@csrf

						<div class="form-group">
							<label for="">Title</label>

							<input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" value="{{ isset($post) ? $post->title : '' }}">
							
							<div class="invalid-feedback">
								{{ $errors->first('title') }}
							</div>
						</div>

						<div class="form-group">
							<label for="body">Body</label>
							<textarea name="body" id="" cols="30" rows="10" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}">{{ isset($post) ? $post->body : '' }}</textarea>

							<div class="invalid-feedback">
								{{ $errors->first('body') }}
							</div>
						</div>

						<div class="form-group">
							<label for="body">Categories</label>
							<select name="categories" id="" class="form-control" multiple="">

									<!--display category-->
									@foreach($categories as $key => $name)

									@if(isset ($selectedCategories))

									<!--edit-->
									<option value="{{ $key }}" {{ $selectedCategories->contains($key) ? 'selected' : '' }}>{{ $name }}</option>

									@else

									<!--create-->
									<option value="{{ $key }}">{{ $name }}<option>

									@endif
									@endforeach	

							</select>
						</div>

						<div class="form-group">
							<label for="">Image</label> 
							<div class="custom file">
								<input type="file" name="image" class="form-control {{ $errors->has('image') ? 'is-valid' : '' }}" id="custom-file">

								<div class="invalid-feedback">
									{{ $errors->first('image') }}
								</div>
								
							</div>
							
						</div>

						
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>

					


