{{-- Extends layout --}}
@extends('admin-panel.structure.layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">افزودن مدیر جدید
                    <div class="text-muted pt-2 font-size-sm">در این بخش شما میتوانید مدیریت جدید اضافه کنید</div>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('panel.managers.index') }}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <circle fill="#000000" cx="9" cy="15" r="6" />
                                <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                      fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                    </span>لیست مدیران
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('panel.managers.store') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-6 col-lg-4 col-sm-4 mt-2">
                        <label>نام مدیر:</label>
                        <input type="text" name="first_name" class="form-control form-control-solid" placeholder="نام مدیر" value="{{ old('first_name') }}">
                    </div>
                    <div class="col-6 col-lg-4 col-sm-4 mt-2">
                        <label>نام خانوادگی مدیر:</label>
                        <input type="text" name="last_name" class="form-control form-control-solid" placeholder="نام خانوادگی مدیر" value="{{ old('last_name') }}">
                    </div>
                    <div class="col-6 col-lg-4 col-sm-4 mt-2">
                        <label for="email-input">ایمیل:</label>
                        <input id="email-input" type="email" name="email" class="form-control form-control-solid ltr-field" placeholder="ایمیل" value="{{ old('email') }}">
                    </div>
                    <div class="col-6 col-lg-4 col-sm-4 mt-2">
                        <label>رمز عبور:</label>
                        <div class="input-group input-group-solid">
                            <input type="password" name="password" class="form-control ltr-field" placeholder="رمز عبور">
                            <span class="input-group-append">
								<span class="input-group-text cursor-pointer"><i class="fas fa-eye-slash toggle-password"></i></span>
							</span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4 col-sm-4 mt-2">
                        <label>تکرار رمز عبور:</label>
                        <div class="input-group input-group-solid">
                            <input type="password" name="password_confirmation" class="form-control ltr-field" placeholder="تکرار رمز عبور">
                            <span class="input-group-append">
								<span class="input-group-text cursor-pointer"><i class="fas fa-eye-slash toggle-password"></i></span>
							</span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success font-weight-bold mr-2">افزودن مدیر</button>
            </form>
        </div>
    </div>
@endsection
