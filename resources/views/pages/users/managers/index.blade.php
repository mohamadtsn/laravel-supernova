{{-- Extends layout --}}
@extends('admin-panel.structure.layout.default')

{{-- Content --}}
@section('content')

	<div class="card card-custom">
		<div class="card-header flex-wrap border-0 pt-6 pb-0">
			<div class="card-title">
				<h3 class="card-label">لیست مدیران
					<div class="text-muted pt-2 font-size-sm">در این بخش شما لیست مدیران را مشاهده میکنید</div>
				</h3>
			</div>
			<div class="card-toolbar">
				<a href="{{ route('panel.managers.create') }}" class="btn btn-primary font-weight-bolder">
					<i class="fad fa-plus-circle"></i>
					افزودن مدیر جدید
				</a>
			</div>
		</div>

		<div class="card-body">
			<table class="table table-bordered table-hover text-center" id="datatable_admin_list">
				<thead>
				<tr>
					<th>کد کاربری</th>
					<th>نام</th>
					<th>ایمیل</th>
					<th>وضعیت</th>
					<th>دسترسی</th>
					<th>عملیات</th>
				</tr>
				</thead>
				<tbody>
				@foreach($users as $user)
					@continue((int)$user->level === 0)
					<tr>
						<td>
                            <span class="label-cursor">
                                {{ $user->id }}
                            </span>
						</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>
                            <span @class([
										   'label label-dot mr-2',
										   $user->status === 'active' => 'label-success',
										   $user->status === 'inactive' => 'label-danger'
										])>
                            </span>
							@if($user->status === 'active')
								<span class="font-weight-bold text-success label-cursor">
                                    فعال
                                </span>
							@else
								<span class="font-weight-bold text-danger label-cursor">
                                    غیرفعال
                                </span>
							@endif
						</td>
						<td>
							<a href="{{ route('panel.users.permissions', ['user' => $user->id]) }}" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-theme="dark" title="مدیریت دسترسی ها">
                                <span class="svg-icon svg-icon-lg svg-icon-primary">
                                    {{ Supernova::getSVG('panel/media/svg/icons/General/Settings-1.svg') }}
                                </span>
							</a>
						</td>
						<td>
							<form action="{{ route('panel.managers.destroy', ['manager' => $user->id]) }}" method="POST" id="deleteAdmin{{ $user->id }}">
								@method('DELETE')
								@csrf
								<a href="javascript:;" class="btn btn-sm btn-clean btn-icon delete-admin" title="حذف" data-delete="{{ $user->id }}">
                                    <span class="svg-icon svg-icon-lg svg-icon-danger">
                                        {{ Supernova::getSVG('panel/media/svg/icons/General/Trash.svg') }}
                                    </span>
								</a>
							</form>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
