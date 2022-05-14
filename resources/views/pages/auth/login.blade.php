<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ Supernova::printAttrs('html') }} {{ Supernova::printClasses('html') }}>
<head>
    <meta charset="utf-8" />
    <title>ورود به مدیریت</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="{{ asset('panel/css/pages/login/login-4.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('panel/css/app.css') }}">
    <link href="{{ asset('panel/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('panel/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('panel/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />

    <link rel="shortcut icon" href="{{ asset('panel/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('panel/plugins/global/fonts/fontiran/fontiran.css') }}">

    @if(config('supernova.recaptcha_login'))
        {!! htmlScriptTagJsApi() !!}
    @endif
</head>
<body {{ Supernova::printAttrs('body') }} {{ Supernova::printClasses('body') }}>
@if (config('supernova.layout.page-loader.type') != '')
    @include('admin-panel.structure.layout.partials._page-loader')
@endif

<div class="d-flex flex-column flex-root">
    <div class="login login-4 wizard d-flex flex-column flex-lg-row flex-column-fluid">
        <div
            class="login-container order-2 order-lg-1 d-flex flex-center flex-row-fluid px-7 pt-lg-0 pb-lg-0 pt-4 pb-6 bg-white">
            <div class="login-content d-flex flex-column pt-lg-0 pt-12">
                @include('admin-panel.structure.layout.partials.extras.errors')

                <a href="javascript:;" class="login-logo pb-xl-20 pb-15">
                    <img src="{{ asset('panel/media/logos/logo-4.png') }}" class="max-h-70px" alt="" />
                </a>

                <div class="login-form">
                    <form class="form" id="{{ config('supernova.recaptcha_login') ? getFormId() : 'kt_login_singin_form' }}" action="{{ route('panel.login') }}" method="POST">
                        <div class="pb-5 pb-lg-15">
                            <h4 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">ورود به مدیریت</h4>
                        </div>
                        @csrf
                        <div class="form-group">
                            <label class="font-size-h6 font-weight-bolder text-dark">نام کاربری</label>
                            <input dir="ltr" style="direction: ltr" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
                                   type="text" name="username" autocomplete="off" />
                        </div>

                        <div class="form-group">
                            <div class="d-flex justify-content-between mt-n5">
                                <label class="font-size-h6 font-weight-bolder text-dark pt-5">کلمه عبور</label>
                                <a href="javascript:;" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">
                                    رمز عبور خود را فراموش کرده اید؟
                                </a>
                            </div>
                            <input dir="ltr" style="direction: ltr" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
                                   type="password" name="password" autocomplete="off" />
                        </div>

                        <div class="pb-lg-0 pb-5">
                            @if(config('supernova.recaptcha_login'))
                                {!! htmlFormButton('ورود', ['class' => 'btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3']) !!}
                            @else
                                <button type="submit" id="kt_login_singin_form_submit_button" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">
                                ورود
                            </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="login-aside order-1 order-lg-2 bgi-no-repeat bgi-position-x-right">
            <div class="login-conteiner bgi-no-repeat bgi-position-x-right bgi-position-y-bottom" style="background-image: url({{ asset('panel/media/svg/illustrations/login-visual-4.svg') }});"></div>
        </div>
    </div>
</div>
<script>
    var KTAppSettings = {!! json_encode(config('supernova.layout.js'), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};
</script>
@foreach(config('supernova.layout.resources.js') as $script)
    <script src="{{ asset($script) }}" type="text/javascript"></script>
@endforeach

{{-- Includ Notification plugins JS --}}
@include('supernova::sweetalert')
@include('supernova::toast')
</body>
</html>
