@if(config('supernova.layout.self.layout') === 'blank')
    <div class="d-flex flex-column flex-root">
        @yield('content')
    </div>
@else

    @include('admin-panel.structure.layout.base._header-mobile')

    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">

            @if(config('supernova.layout.aside.self.display'))
                @include('admin-panel.structure.layout.base._aside')
            @endif

            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                @include('admin-panel.structure.layout.base._header')

                <div class="content {{ Supernova::printClasses('content', false) }} d-flex flex-column flex-column-fluid" id="kt_content">

                    @if(config('supernova.layout.subheader.display'))
                        @if(array_key_exists(config('supernova.layout.subheader.layout'), config('supernova.layout.subheader.layouts')))
                            @include('admin-panel.structure.layout.partials.subheader._'.config('supernova.layout.subheader.layout'))
                        @else
                            @include('admin-panel.structure.layout.partials.subheader._'.array_key_first(config('supernova.layout.subheader.layouts')))
                        @endif
                    @endif

                    @include('admin-panel.structure.layout.base._content')
                </div>

                @include('admin-panel.structure.layout.base._footer')
            </div>
        </div>
    </div>

@endif

@if (config('supernova.layout.self.layout') != 'blank')

    @if (config('supernova.layout.extras.search.layout') == 'offcanvas')
        @include('admin-panel.structure.layout.partials.extras.offcanvas._quick-search')
    @endif

    @if (config('supernova.layout.extras.notifications.layout') == 'offcanvas')
        @include('admin-panel.structure.layout.partials.extras.offcanvas._quick-notifications')
    @endif

    @if (config('supernova.layout.extras.quick-actions.layout') == 'offcanvas')
        @include('admin-panel.structure.layout.partials.extras.offcanvas._quick-actions')
    @endif

    @if (config('supernova.layout.extras.user.layout') == 'offcanvas')
        @include('admin-panel.structure.layout.partials.extras.offcanvas._quick-user')
    @endif

    @if (config('supernova.layout.extras.quick-panel.display'))
        @include('admin-panel.structure.layout.partials.extras.offcanvas._quick-panel')
    @endif

    @if (config('supernova.layout.extras.toolbar.display'))
        @include('admin-panel.structure.layout.partials.extras._toolbar')
    @endif

    @if (config('supernova.layout.extras.chat.display'))
        @include('admin-panel.structure.layout.partials.extras._chat')
    @endif

    @include('admin-panel.structure.layout.partials.extras._scrolltop')

@endif
