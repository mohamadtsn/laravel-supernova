{{-- Extends layout --}}
@extends('admin-panel.structure.layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}



@include('admin-panel.structure.widgets._widget-1', ['class' => 'card-stretch gutter-b'])



@include('admin-panel.structure.widgets._widget-2', ['class' => 'card-stretch gutter-b'])



@include('admin-panel.structure.widgets._widget-3', ['class' => 'card-stretch card-stretch-half gutter-b'])
@include('admin-panel.structure.widgets._widget-4', ['class' => 'card-stretch card-stretch-half gutter-b'])



@include('admin-panel.structure.widgets._widget-5', ['class' => 'card-stretch gutter-b'])



@include('admin-panel.structure.widgets._widget-6', ['class' => 'card-stretch gutter-b'])



@include('admin-panel.structure.widgets._widget-7', ['class' => 'card-stretch gutter-b'])



@include('admin-panel.structure.widgets._widget-8', ['class' => 'card-stretch gutter-b'])



@include('admin-panel.structure.widgets._widget-9', ['class' => 'card-stretch gutter-b'])


@endsection

@section('scripts')
    <script src="{{ asset('panel/js/widgets.js') }}" type="text/javascript"></script>
@endsection
