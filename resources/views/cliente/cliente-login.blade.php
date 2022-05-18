@extends('components.panel.cliente-panel')

@section('link-css')
@endsection

@section('main')
<article>
    @component('components.panel.login-panel')@endcomponent
</article>
@endsection

@section('footer')
@endsection

@section('link-js')
    {{-- arhcivo Javascript de Firebase --}}
    <script src="{{ asset('js/firebase-app.js') }}"></script>
    <script src="{{ asset('js/firebase-auth.js') }}"></script>
    {{-- Inicializar Firebase --}}
    <script src="{{ asset('js/firebase-conf.js') }}"></script>
    <script src="{{ asset('js/googleLogin.js') }}"></script>

    <script src="{{ asset('js/cliente-login.js') }}"></script>
@endsection
