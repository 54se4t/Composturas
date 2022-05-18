@extends('components.panel.admin-panel')
@section('link-css')
    <link rel="stylesheet" href="{{ asset('css/admin-inicio-style.css') }}">
@endsection
@section('main')
    <article class="h-100" id="home"> {{-- h-100 para centrar-vertical --}}
        <div class="d-flex justify-content-center align-items-center h-100">
            <div>
                <h1>Bienvenido a panel de admin</h1>
                <p class="lead">Esta es la página de inicio de panel de admin, puedes administrar las citas aqui, para
                    ver más cosas, clic el botón debajo para ver la guía.</p>
                <button type="button" class="btn btn-primary" id="botonGuia">Guía de uso ➞</button>
                <hr>
                <div class="container">
                    <div class="row">
                        <div class="col card m-3 bg-warning" style="max-width: 18rem;">
                            <div class="card-header">Citas pendientes</div>
                            <div class="card-body text-center">
                                <p class="fs-1">
                                    @php
                                        $contarCitas = 0;
                                        foreach ($citas as $cita) {
                                            if(!$cita['TID']) {
                                                $contarCitas++;
                                            }
                                        }
                                        echo $contarCitas;
                                    @endphp
                                </p>
                            </div>
                        </div>
                        <div class="col card m-3 bg-success text-white" style="max-width: 18rem;">
                            <div class="card-header">Citas confirmadas</div>
                            <div class="card-body text-center">
                                <p class="fs-1">
                                    @php
                                        $contarCitas = 0;
                                        foreach ($citas as $cita) {
                                            if($cita['estado'] == 'confirmado') {
                                                $contarCitas++;
                                            }
                                        }
                                        echo $contarCitas;
                                    @endphp
                                </p>
                            </div>
                        </div>
                        <div class="col card m-3 bg-primary text-white" style="max-width: 18rem;">
                            <div class="card-header">Total</div>
                            <div class="card-body text-center">
                                <p class="fs-1">{{ count($citas) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <article id="citas">
        <section>
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col input-group mb-3">
                    <button type="button" class="buscar-cliente btn btn-outline-secondary">Cliente</button>
                    <input type="text" class="form-control">
                </div>
                <div class="col input-group mb-3">
                    <button type="button" class="buscar-estado btn btn-outline-secondary">Estado</button>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>
        <table class="table align-middle" id="tablaCitas">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Trabajador</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Tiempo de visita</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citas as $cita)
                <tr>
                    <td>{{$cita['CID']}}</td>
                    <td>
                        @foreach ($clientes as $cliente)
                            @if ($cliente['UID'] == $cita['UID'])
                                {{$cliente['apellidos']}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($trabajadores as $trabajador)
                            @if ($trabajador['TID'] == $cita['TID'])
                                {{$trabajador['apellidos']}}
                            @endif
                        @endforeach
                        @if (!$cita['TID'])
                            <a class="btn btn-primary boton-coger" role="button">Coger</a>
                        @endif
                    </td>
                    <td>{{$cita['descripcion']}}</td>
                    <td>
                        <select class="form-select mt-1" aria-label="Default select example">
                            <option selected>{{$cita['estado']}}</option>
                            <option>solicitado</option>
                            <option>confirmado</option>
                            <option>en proceso</option>
                            <option>terminado</option>
                            <option>recogido</option>
                        </select></td>
                    <td>
                        @php
                            $fecha = str_replace($cita['tiempo_visita'], " ", "T");
                        @endphp
                        <input type="datetime-local" value="{{$cita['tiempo_visita']}}">
                    </td>
                    <td>
                        <button type="button" class="boton-editar btn btn-outline-success">Editar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </section>
    </article>
    <article id="trabajadores">
        <section>
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col input-group mb-3">
                        <button type="button" class="buscar-trabajador btn btn-outline-secondary">Apellidos</button>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col input-group mb-3">
                        <button type="button" class="buscar-email btn btn-outline-secondary">Email</button>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
            <table id="tablaTrabajadores" class="table align-middle">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Email</th>
                        <th scope="col">Permiso</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trabajadores as $trabajador)
                    <tr>
                        <td>{{$trabajador['TID']}}</td>
                        <td>{{$trabajador['nombre']}}</td>
                        <td>{{$trabajador['apellidos']}}</td>
                        <td>{{$trabajador['email']}}</td>
                        <td>
                            <select class="form-select mt-1" aria-label="Default select example">
                                <option selected>{{$trabajador['permiso']}}</option>
                                <option>desactivado</option>
                                <option>trabajador</option>
                                <option>administrador</option>
                            </select>
                        </td>
                        <td>
                            <button type="button" class="boton-editar btn btn-outline-success">Editar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </section>
    </article>
    <article id="clientes">

        <section>
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col input-group mb-3">
                        <button type="button" class="buscar-cliente btn btn-outline-secondary">Apellidos</button>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col input-group mb-3">
                        <button type="button" class="buscar-email btn btn-outline-secondary">Email</button>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
            <table id="tablaClientes" class="table align-middle">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Email</th>
                        <th scope="col">Nº Citas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{$cliente['UID']}}</td>
                        <td>{{$cliente['nombre']}}</td>
                        <td>{{$cliente['apellidos']}}</td>
                        <td>{{$cliente['email']}}</td>
                        <td>
                            @php
                                $contadorCitas = 0;
                                foreach ($citas as $cita)
                                    if ($cita['UID'] == $cliente['UID'])
                                        $contadorCitas++;
                                echo $contadorCitas;
                            @endphp
                        </td>
                        <td>
                            <button type="button" class="boton-ver-citas btn btn-primary">Ver citas</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </article>
    <article id="guia">
        <div>guia</div>
    </article>
@endsection


@section('link-js')
<script src="{{ asset('js/admin-inicio-navegacion.js') }}"></script>
<script src="{{ asset('js/admin-inicio.js') }}"></script>
@endsection
