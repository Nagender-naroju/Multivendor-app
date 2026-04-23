@extends('admin.layouts.layout')
@section('content')
   <div class="container-fluid p-0">
		@if ($errors->any())
			<div class="alert alert-danger" role="alert">
				<ul>
					@foreach ($errors->all() as $error)
						<li >{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header bg-warning text-white">
                        <div class="">
                            <h5 class="card-title ">
                                Add Category
                                <a href="{{ route('admin.categories') }}" class="float-end text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left align-middle me-2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                                </a>
                                <!-- <a  class="btn btn-danger float-end">Back</a> -->
                            </h5>
                        </div>
						
					</div>
					<div class="card-body">
						<form action="{{ route('admin.save.category') }}" method="POST">
							@csrf
							<div class="mb-3">
								<label class="form-label" for="category_name">Category Name</label>
								<input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter category name..">
							</div>
							
							<div class="mb-3">
								<label class="form-label" for="parent_category">Choose Parent Category</label>
								<select class="form-select mb-3" name="parent_id" id="parent_id">
									@if ($categories->count() > 0)
										<option value="">Open this select menu</option>
										@foreach ($categories as $category)
											<option value="{{ $category->id }}">{{ $category->category_name }}</option>
										@endforeach
									@else
										<option value="">Open this select menu</option>
										<option value="">No Categories Found</option>
									@endif
								</select>
							</div>

							<div class="mb-3">
								<input type="submit" class="btn btn-success" value="Save">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
