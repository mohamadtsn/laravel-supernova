{{-- Header --}}
<div id="kt_header" class="header {{ Supernova::printClasses('header', false) }}" {{ Supernova::printAttrs('header') }}>

    {{-- Container --}}
    <div class="container-fluid d-flex align-items-center justify-content-between">
        @if (config('supernova.layout.header.self.display'))

            @php
                $kt_logo_image = 'logo-light.png';
            @endphp

            @if (config('supernova.layout.header.self.theme') === 'light')
                @php $kt_logo_image = 'logo-dark.png' @endphp
            @endif

            {{-- Header Menu --}}
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                @if((bool)config('supernova.layout.aside.self.display') === false)
                    <div class="header-logo">
                        <a href="{{ url('/') }}">
                            <img alt="Logo" src="{{ asset('panel/media/logos/' . $kt_logo_image) }}" />
                        </a>
                    </div>
                @endif

                <div id="kt_header_menu" class="header-menu header-menu-mobile {{ Supernova::printClasses('header_menu', false) }}" {{ Supernova::printAttrs('header_menu') }}>
                    <ul class="menu-nav {{ Supernova::printClasses('header_menu_nav', false) }}">
                        {{ Menu::renderHorMenu(config('supernova.menu_header.items')) }}
                    </ul>
                </div>
            </div>

        @else
            <div></div>
        @endif

        @include('admin-panel.structure.layout.partials.extras._topbar')
    </div>
</div>
