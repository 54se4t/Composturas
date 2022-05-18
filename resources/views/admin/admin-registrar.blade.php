<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/admin-login-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Composturas Panel-admin</title>
</head>

<body>
    <header>
    </header>
    <main>
        <article>
            @component('components.panel.registrar-panel')
            @endcomponent
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <a href="/" class="link-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                            <path fill-rule="evenodd"
                                d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                        </svg> Vovler
                    </a>
                </div>
                <div class="row justify-content-center">
                    <div class="col col-xl-6">Los usuarios desactivdos(por defecto al registrar) no pueden acceder panel de amin.</div>
                </div>
            </div>
        </article>
    </main>
    <footer>
        @component('components.panel.mensaje-panel')
        @endcomponent
    </footer>
    {{-- JQuery --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script src="{{ asset('js/admin-registrar.js') }}"></script>
</body>

</html>
