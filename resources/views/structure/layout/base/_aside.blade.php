{{-- Aside --}}

@php
    $kt_logo_image = 'logo-light.png';
@endphp

@if (config('supernova.layout.brand.self.theme') === 'light')
    @php $kt_logo_image = 'logo-dark.png' @endphp
@endif

<div class="aside aside-left {{ Supernova::printClasses('aside', false) }} d-flex flex-column flex-row-auto" id="kt_aside">

    {{-- Brand --}}
    <div class="brand flex-column-auto {{ Supernova::printClasses('brand', false) }}" id="kt_brand">
        <div class="brand-logo">
            <a href="{{ url('/') }}">
                <img alt="{{ config('app.name') }}" src="{{ asset('panel/media/logos/' . $kt_logo_image) }}" />
            </a>
        </div>

        @if (config('supernova.layout.aside.self.minimize.toggle'))
            <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                {{ Supernova::getSVG("panel/media/svg/icons/Navigation/Angle-double-left.svg", "svg-icon-xl") }}
            </button>
        @endif

    </div>

    {{-- Aside menu --}}
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">

        @if (config('supernova.layout.aside.self.display') === false)
            <div class="header-logo">
                <a href="{{ url('/') }}">
                    <img alt="{{ config('app.name') }}" src="{{ asset('panel/media/logos/' . $kt_logo_image) }}" />
                </a>
            </div>
        @endif

        <div id="kt_aside_menu" class="aside-menu my-4 {{ Supernova::printClasses('aside_menu', false) }}" data-menu-vertical="1"
            {{ Supernova::printAttrs('aside_menu') }}>

            <ul class="menu-nav {{ Supernova::printClasses('aside_menu_nav', false) }}">
                {!! Menu::loadVerticalMenu() !!}
            </ul>
        </div>
    </div>

</div>
