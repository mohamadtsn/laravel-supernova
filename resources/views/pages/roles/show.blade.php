{{-- Extends layout --}}
@extends('admin-panel.structure.layout.default')

{{-- Content --}}
@section('content')
	<div class="card card-custom">
		<div class="card-header flex-wrap border-0 pt-6 pb-0">
			<div class="card-title">
				<h3 class="card-label">
					دسترسی های نقش
					<span class="label label-lg font-weight-bold label-light-danger label-inline">
                        {{ $role->name }}
                    </span>
					<div class="text-muted pt-2 font-size-sm">
						در این بخش شما دسترسی های نقش را میتوانید ویرایش کنید.
					</div>
				</h3>
			</div>
			<div class="card-toolbar">
				<a href="{{ route('panel.roles.index') }}" class="btn btn-primary font-weight-bolder">
					<i class="fad fa-list"></i>
					لیست نقش ها
				</a>
			</div>
		</div>
		<br>
	</div>
	<hr>
	<form action="{{ route('panel.roles.update', ['role' => $role->id]) }}" method="POST">
		<div class="card card-custom">
			<div class="card-header flex-wrap border-0 pt-6 pb-0">
				<div class="card-title">
					<h3 class="card-label">
						عنوان نقش
					</h3>
				</div>
			</div>

			<div class="card-body">
				<div class="row">
					<div class="form-group col-4">
						<input type="text" name="title" class="form-control" placeholder="عنوان نقش ..." required value="{{ $role->name }}">
					</div>
				</div>
			</div>
		</div>
		<hr>
		@csrf
		@method('PATCH')
		<div class="card card-custom">
			<div class="card-header flex-wrap border-0 pt-6 pb-0">
				<div class="card-title">
					<h3 class="card-label">
						دسترسی های نقش
					</h3>
				</div>
			</div>

			<div class="card-body">
				<div class="row">
					@foreach($permissions as $permission)
						<div class="col-lg-3 col-6 mb-5">
							<label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
								<input type="checkbox" value="{{ $permission->id }}" name="permissions[]" @checked($role->checkPermissionTo($permission->id))>
								<span class="mr-2"></span>
								{{ $permission->display_name }}
							</label>
						</div>
					@endforeach
				</div>
				<hr>
				<button class="btn btn-info font-weight-bold mr-2">ذخیره دسترسی ها</button>
			</div>
		</div>
	</form>
@endsection
