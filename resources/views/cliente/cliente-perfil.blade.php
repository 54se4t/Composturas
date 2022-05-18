@extends('components.panel.cliente-panel')

@section('link-css')
@endsection

@section('main')
    <article class="container">
        <div class="row justify-content-center">
            <h2 class="col col-xl-6 ">Mis datos</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col col-xl-6">
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Nombre</th>
                            <td>{{Session::get('usuario')['nombre']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Apellidos</th>
                            <td>{{Session::get('usuario')['apellidos']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td>{{Session::get('usuario')['email']}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col col-xl-6">
                <button type="button" class="btn btn-primary" id="boton-editar">Editar</button>
                <button type="button" class="btn btn-success" id="boton-aceptar" disabled>Aceptar edición</button>
            </div>
        </div>
    </article>
@endsection

@section('footer')
@endsection

@section('link-js')
    <script src="{{ asset('js/cliente-perfil.js') }}"></script>
@endsection
