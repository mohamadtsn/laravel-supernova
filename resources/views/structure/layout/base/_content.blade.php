{{-- Content --}}
@if (config('layout.content.extended'))
    @yield('content')
@else
    <div class="d-flex flex-column-fluid">
        <div class="{{ Supernova::printClasses('content-container', false) }}">
            @include('admin-panel.structure.layout.partials.extras.errors')
    
            @yield('content')
        </div>
    </div>
@endif
