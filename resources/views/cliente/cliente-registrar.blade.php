@extends('components.panel.cliente-panel')

@section('link-css')
@endsection

@section('main')
@component('components.panel.registrar-panel')@endcomponent
@endsection

@section('footer')
@endsection

@section('link-js')
    <script src="{{ asset('js/cliente-registrar.js') }}"></script>
@endsection
