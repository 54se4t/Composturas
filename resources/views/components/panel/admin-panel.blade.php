<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    {{-- Para media min-width--}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Composturas-Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin-panel-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    @yield('link-css')

</head>
<body>
    <header>
    </header>

    <main class="container-fluid">
        <div class="row" style="height: 100%;">
            <nav class="col-lg-2 nav-fijo">
                <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="height: 100%;">
                    <a href="/ " class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none ">
                        <img class="icon" src="{{ asset('imgs/sewing-machine02.png') }}" alt="Icono máquina de coser">
                        <span class="titulo">Composturas</span>
                    </a>
                    <hr>
                    {{-- Menu --}}
                    <ul class="nav nav-pills flex-column mb-auto" id="menu">
                        <li class="nav-item">
                            <a class="nav-link active " id="btn-guia">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                                    <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white" id="btn-guia">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" fill="currentColor" class="bi bi-sticky-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1A1.5 1.5 0 0 0 1 2.5v11A1.5 1.5 0 0 0 2.5 15h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 15 8.586V2.5A1.5 1.5 0 0 0 13.5 1h-11zm6 8.5a1 1 0 0 1 1-1h4.396a.25.25 0 0 1 .177.427l-5.146 5.146a.25.25 0 0 1-.427-.177V9.5z"/>
                                </svg>
                                Citas
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-white" id="btn-guia">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16">
                                    <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                    <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z"/>
                                </svg>
                                Trabajadores
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-white" id="btn-guia">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                                    <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                                </svg>
                                Clientes
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-white" id="btn-guia">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" fill="currentColor" class="bi bi-compass-fill" viewBox="0 0 16 16">
                                    <path d="M15.5 8.516a7.5 7.5 0 1 1-9.462-7.24A1 1 0 0 1 7 0h2a1 1 0 0 1 .962 1.276 7.503 7.503 0 0 1 5.538 7.24zm-3.61-3.905L6.94 7.439 4.11 12.39l4.95-2.828 2.828-4.95z"/>
                                </svg>
                                Guia de uso
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div>
                        <a class="d-flex align-items-center text-white text-decoration-none">
                            <strong>{{Session::get('trabajador')['apellidos']}}</strong>
                            <svg class="clickable" onclick="location.href='trabajador/logout'" xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </nav>
            <div class="col m-2 overflow-auto h-100" id="contenidos"> {{-- h-100 para que permite hacer scroll--}}
                @yield('main')
            </div>
        </div>
    </main>

    <footer>
        @component('components.panel.mensaje-panel')@endcomponent
        @yield('footer')
    </footer>
    <script src="{{ asset('js/jquery.min.js'); }}"></script>
    @yield('link-js')
</body>

</html>
