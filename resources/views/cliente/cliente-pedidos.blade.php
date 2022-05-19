@extends('components.panel.cliente-panel')

@section('link-css')
@endsection
@section('main')
    <article>
        <div class="container mb-3">
            <div id="row">
                <div class="col col-12 btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-outline-primary" id="navPedirCitas">Pedir Citas</button>
                    <button type="button" class="btn btn-primary" id="navMisCitas">Mis Citas</button>
                </div>
            </div>
        </div>
    </article>
    <article class="container" id="pedirCitas">
            <div class="row">
                <div class="col"><strong>Més</strong></div>
                <div class="col"><strong>Día</strong></div>
                <div class="col"><strong>Hora</strong></div>
            </div>
            <div class="row" id="listaTiempos">
                <div class="list-group col" id="listaMeses"></div>
                <div class="list-group col" id="listaDias"></div>
                <div class="list-group col" id="listaHoras"></div>
            </div>
            <div class="row">
                <textarea class="form-control" placeholder="Descripción" name="descripcion" style="height: 100px"></textarea>
            </div>
            <div class="row">
                <div class="col col-4"></div>
                <button type="button" class="col col-4 btn btn-success" id="botonPedirCitas">Pedir</button>
                <div class="col col-4"></div>
            </div>
    </article>
    <article class="container" id="misCitas">
        <section>
            <div class="container">
                <div class="row">
                    @foreach ($mensaje['citas'] as $cita)
                        <div class="card col-xl-5 m-4">
                            <div class="card-body cita">
                                <h5 class="card-title fecha">{{ $cita['tiempo_visita'] }}</h5>
                                <p class="card-text">{{ $cita['descripcion'] }}</p>
                            @if ($cita['estado'] == 'terminado')
                                </div>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                    Recoger tu ropa!
                                </span>
                            @elseif ($cita['estado'] == 'recogido')
                                </div>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">
                                    Recogido
                                </span>
                            @else
                                    <a class="card-link cancelar">Cancelar</a>
                                </div>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                    {{ $cita['estado'] }}
                                </span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <section>
    </article>
@endsection

@section('link-js')
<script src="{{ asset('js/cliente-pedidos.js') }}"></script>
<script>
    const meses = {};
    @php
        //Localización
        setlocale(LC_ALL, 'es_ES', 'Spanish_Spain', 'Spanish');
        //Pasar datos a objeto JS
        foreach ($mensaje['tiempos'] as $tiempo) {
            $mes = strftime('%B', strftime($tiempo->getTimestamp()));
                @endphp
                if (!("{{$mes}}" in meses)) {
                    meses["{{$mes}}"] = {};
                }
                @php
            $dia = strftime('%e', strftime($tiempo->getTimestamp()));
                @endphp
                if (!("{{$dia}}" in meses["{{$mes}}"])) {
                    meses["{{$mes}}"]["{{$dia}}"] = [];
                }
                @php
            $hora = strftime('%R', strftime($tiempo->getTimestamp()));
                @endphp
                meses["{{$mes}}"]["{{$dia}}"].push("{{$hora}}");
                @php
        }
    @endphp
    //Listar las citas
    let listaMeses = document.getElementById('listaMeses');
    let listaDias = document.getElementById('listaDias');
    let listaHoras = document.getElementById('listaHoras');
    for (const mes in meses) {
        let mesCelda = document.createElement('a');
        mesCelda.classList.add('list-group-item');
        mesCelda.textContent = mes;
        mesCelda.addEventListener('click', function() {
            let diaCeldas = document.querySelector("#listaMeses").childNodes;
            diaCeldas.forEach(element => element.classList.remove('active'));
            mesCelda.classList.add('active');
            listaDias.innerHTML = "";
            for (const dias in meses[mes]) {
                let diaCelda = document.createElement('a');
                diaCelda.classList.add('list-group-item');
                diaCelda.textContent = dias;
                let badge = document.createElement('span');
                badge.classList.add('badge');
                badge.classList.add('ms-2');
                if (meses[mes][dias].length > 3)
                    badge.classList.add('bg-success');
                else if (meses[mes][dias].length > 1)
                    badge.classList.add('bg-warning');
                else
                    badge.classList.add('bg-danger');
                badge.classList.add('rounded-pill');
                badge.textContent = meses[mes][dias].length;
                diaCelda.appendChild(badge);
                diaCelda.addEventListener('click', function() {
                    let diaCeldas = document.querySelector("#listaDias").childNodes;
                    diaCeldas.forEach(element => element.classList.remove('active'));
                    listaHoras.innerHTML = "";
                    diaCelda.classList.add('active');
                    for (const horas in meses[mes][dias]) {
                        let horaCelda = document.createElement('a');
                        horaCelda.classList.add('list-group-item');
                        horaCelda.textContent = meses[mes][dias][horas];
                        horaCelda.addEventListener('click', function() {
                            let horaCeldas = document.querySelector("#listaHoras").childNodes;
                            horaCeldas.forEach(element => element.classList.remove('active'));
                            horaCelda.classList.add('active');
                        })
                        listaHoras.appendChild(horaCelda);
                    }
                })
                listaDias.appendChild(diaCelda);
            }
        })
        listaMeses.appendChild(mesCelda);
    }

    //Navegar articulo de pedirCitas/listarMisCitas
    document.getElementById('pedirCitas').style.display = 'none';
    let navPedirCitas = document.getElementById('navPedirCitas');
    let navMisCitas = document.getElementById('navMisCitas');
    navPedirCitas.addEventListener('click', function() {
        navPedirCitas.classList.add('btn-primary');
        navPedirCitas.classList.remove('btn-outline-primary');
        navMisCitas.classList.remove('btn-primary');
        navMisCitas.classList.add('btn-outline-primary');
        document.getElementById('pedirCitas').style.display = 'block';
        document.getElementById('misCitas').style.display = 'none';
    })
    navMisCitas.addEventListener('click', function() {
        navMisCitas.classList.add('btn-primary');
        navMisCitas.classList.remove('btn-outline-primary');
        navPedirCitas.classList.remove('btn-primary');
        navPedirCitas.classList.add('btn-outline-primary');
        document.getElementById('misCitas').style.display = 'block';
        document.getElementById('pedirCitas').style.display = 'none';
    })
</script>
@endsection
