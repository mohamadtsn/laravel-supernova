{{-- Content --}}
@if (config('supernova.layout.content.extended'))
@yield('content')
@else

{{ Supernova::printClasses('content-container', false) }}
@include('admin-panel.structure.layout.partials.extras.errors')
@yield('content')


@endif
