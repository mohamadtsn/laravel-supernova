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
                <!--begin::Button-->
                <a href="{{ route('panel.managers.index') }}" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                         version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" cx="9" cy="15" r="6"/>
                            <path
                                d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                fill="#000000" opacity="0.3"/>
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>لیست مدیران</a>
                <!--end::Button-->
            </div>
        </div>

        <div class="card-body">


            <form action="{{ route('panel.managers.store') }}" method="POST">

                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="نام" required value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="ایمیل" required value="{{ old('email') }}">
                </div>


                @csrf

                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="رمز عبور" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="تکرار رمز عبور" required>
                </div>

                <button class="btn btn-success font-weight-bold mr-2">
                    افزودن مدیریت
                </button>
            </form>
        </div>
    </div>
@endsection
