<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ Supernova::printAttrs('html') }} {{ Supernova::printClasses('html') }}>
<head>
    <meta charset="utf-8"/>

    {{-- Title Section --}}
    <title>@yield('title', $page_title ?? '') | {{ config('supernova.static_title_page') }}</title>

    {{-- Meta Data --}}
    <meta name="description" content="@yield('page_description', $page_description ?? '')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('panel/media/logos/favicon.ico') }}"/>

    {{-- Global Theme Styles (used by all pages) --}}
    @foreach(config('supernova.layout.resources.css') as $style)
        <link href="{{ config('supernova.layout.self.rtl') ? asset(Supernova::rtlCssPath($style)) : asset($style) }}" rel="stylesheet" type="text/css"/>
    @endforeach

    {{-- Layout Themes (used by all pages) --}}
    @foreach (Supernova::initThemes() as $theme)
        <link href="{{ config('supernova.layout.self.rtl') ? asset(Supernova::rtlCssPath($theme)) : asset($theme) }}" rel="stylesheet" type="text/css"/>
    @endforeach

    {{-- Includable CSS --}}
    @yield('styles')

    <link rel="stylesheet" href="{{ asset('panel/plugins/global/fonts/fontiran/fontiran.css') }}">
</head>

<body {{ Supernova::printAttrs('body') }} {{ Supernova::printClasses('body') }}>

@if (config('supernova.layout.page-loader.type') != '')
    @include('admin-panel.structure.layout.partials._page-loader')
@endif

@include('admin-panel.structure.layout.base._layout')

{{-- Global Config (global config for global JS scripts) --}}
<script>
    var KTAppSettings = {!! json_encode(config('supernova.layout.js'), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};
</script>

{{-- Global Theme JS Bundle (used by all pages)  --}}
@foreach(config('supernova.layout.resources.js') as $script)
    <script src="{{ asset($script) }}" type="text/javascript"></script>
@endforeach

{{-- Includable JS --}}
@yield('scripts')

{{-- Includ Notification plugins JS --}}
@include('supernova::sweetalert')
@include('supernova::toast')
</body>
</html>

