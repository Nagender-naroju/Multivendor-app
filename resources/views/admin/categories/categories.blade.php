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

		@if(session('success'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				{{ session('success') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header bg-warning text-white">
						<h5 class="card-title mb-0">Categories
							<a href="{{ route('admin.create.category') }}" class="float-end text-white">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle align-middle me-2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
							</a>
						</h5>
					</div>
					<div class="card-body">
						<table class="table">
							<thead>
								<tr>
								<th scope="col">#</th>
								<th scope="col">Category Name</th>
								<th scope="col">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($categories as $category)
									<tr>
										<th scope="row">{{ $category->id }}</th>
										<th scope="row">{{ $category->category_name }}</th>

										<td>
											<a href="{{ url('admin/categories/edit/'.$category->id) }}" class="btn btn-success">Edit</a>
											<a href="{{ url('admin/category/delete/'.$category->id) }}" class="btn btn-danger">Delete</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
