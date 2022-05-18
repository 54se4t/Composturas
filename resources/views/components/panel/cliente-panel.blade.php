<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Composturas</title>
    <link rel="stylesheet" href="{{ asset('css/cliente-panel-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    @yield('link-css')
</head>

<body>
    <div class="text-primary" id="btn-back-to-top">
        <svg xmlns="http://www.w3.org/2000/svg" width="3rem" height="3rem" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
        </svg>
    </div>
    <header>
        <!-- barra de navegación -->
        <div class="container">
            <nav class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
                <a href="{{ asset('/') }}" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                    <img class="icon" src="{{ asset('imgs/sewing-machine02.png') }}" alt="Icono máquina de coser">
                </a>

                <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0" id="test">
                    <li><a href="{{ asset('/')}}" class="nav-link px-2 link-secondary">Inicio</a></li>
                    <li><a href="{{ asset('/#servicios')}}" class="nav-link px-2 link-dark">Servicios</a></li>
                    <li><a href="{{ asset('/#ubicacion')}}" class="nav-link px-2 link-dark">Ubicación</a></li>
                    <li><a href="{{ asset('/cliente-pedidos')}}" class="nav-link px-2 link-dark">Pedidos</a></li>
                    <li><a href="{{ asset('/cliente-perfil')}}" class="nav-link px-2 link-dark">Perfil</a></li>
                    <li><a href="{{ asset('admin')}}" class="nav-link px-2 link-dark">Administrar</a></li>
                </ul>

                <div class="col-md-3 text-end">
                    @if (Session::get('usuario'))
                        <div class="fs-5" >{{Session::get('usuario')['apellidos']}}
                            <svg class="clickable" onclick="location.href='cliente/logout'" xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                            </svg>
                        </div>
                    @else
                        <button type="button" class="btn btn-outline-primary me-2" onclick="location.href='cliente-login'">Login</button>
                        <button type="button" class="btn btn-primary" onclick="location.href='cliente-registrar'">Registrar</button>
                    @endif
                </div>
            </nav>
        </div>
    </header>

    <main>
        @yield('main')
    </main>

    <footer>
        @component('components.panel.mensaje-panel')@endcomponent
        @yield('footer')
    </footer>
    <script src="{{ asset('js/jquery.min.js'); }}"></script>
    <script src="{{ asset('js/button-back-to-top.js'); }}"></script>
    @yield('link-js')
</body>

</html>
