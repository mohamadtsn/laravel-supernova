@if(session()->has('success'))
    @component('admin-panel.structure.layout.partials.extras.alert.ui_alert', ['type' => 'success'])
        {{ session()->get('success') }}
    @endcomponent
@endif


@if($errors->any())
    @foreach ($errors->all() as $error)
        @component('admin-panel.structure.layout.partials.extras.alert.ui_alert', ['type' => 'light-danger'])
            {{ $error }}
        @endcomponent
    @endforeach
@endif
