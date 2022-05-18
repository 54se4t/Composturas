@extends('components.panel.cliente-panel')

@section('link-css')
    <link rel="stylesheet" href="{{ asset('css/cliente-inicio-style.css') }}">
@endsection
@section('main')
<article>
    <section>
        <div class="container col-xxl-8 px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="{{ asset('imgs/sewing_01.jpg') }}" class="d-block mx-lg-auto img-fluid"
                        alt="Bootstrap Themes" width="700" height="500">
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold lh-1 mb-3">Composturas</h1>
                    <p class="lead">¿Se sigue molestando el hecho de que tu ropa favorita no te quede bien?¿Alguna
                        vez ha querido tener un vestido personalizado?</p>
                    <p class="lead">Satisfacemos todos sus necesidades</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <button type="button" class="btn btn-primary btn-lg px-4" onclick="location.href='/cliente-pedidos'">¡Quiero pedir cita!</button>
                            <button type="button" class="btn btn-outline-secondary btn-lg px-4 me-md-2"
                                onclick="location.href='#servicios'">Saber más</button>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <section>
        <div class="container py-3">
            <div class="pb-3 mb-4 border-bottom">
                <h2 id="servicios">Servicios</h2>
            </div>

            <div class="p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">Servicios básicos</h1>
                    <p class="col-md-8 fs-4">Ofrecemos servicios como reparación de ropa, cambio de creamllera o cintura.
                        ¡Y no solo estos! podemos satisfacer todos sus requisitos, por ejemplo, añadir insignias a su ropa y
                        reparar peluches.</p>
                </div>
            </div>

            <div class="row align-items-md-stretch">
                <div class="col-md-6">
                    <div class="h-100 p-5 text-white bg-dark rounded-3">
                        <h2 class="fw-bold">Vestido a medida</h2>
                        <p class="fs-5">Vestido de fiesta, uniforme de trabajo o vestido business... Díganos lo
                            que quiere y lo diseñaremos para usted!</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('imgs/sewing_02.jpg') }}" class="d-block mx-lg-auto img-fluid"
                        alt="Bootstrap Themes" width="700" height="500">
                </div>
            </div>

            <footer class="pt-3 mt-4 text-muted border-top">
                © 2021
            </footer>
        </div>
    </section>
    <section class="container py-3">
        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Servicios de reparación</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">4<small class="text-muted fw-light">~8€</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Cambio de cremallera</li>
                            <li>Ensanchar cintura</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Modificar las dimensiones</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">4<small class="text-muted fw-light">~20€</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Recorte de bajo</li>
                            <li>Estrechar</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm border-primary">
                    <div class="card-header py-3 text-white bg-primary border-primary">
                        <h4 class="my-0 fw-normal">Vestido a medida</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title"><small class="text-muted fw-light">Apartir</small> 100€
                        </h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Vestido a fiesta</li>
                            <li>Vestido business</li>
                        </ul>
                    </div>
                </div>
            </div>

            <button type="button" class="w-100 btn btn-lg btn-primary" onclick="location.href='/cliente-pedidos'">Quiero pedir cita!</button>
        </div>
    </section>
    <section>
        <div class="container py-3">
            <div class="pb-3 mb-4 border-bottom">
                <h2 id="ubicacion">Ubicación</h2>
            </div>
            <p class="fs-5 col-md-8">Nuestra tienda esta situada en la calle Misltata, El horario habitual es de 9:00 a
                15:00 h. </p>

            <div class="p-5 mb-4 bg-light rounded-3" id="map">
            </div>
        </div>

    </section>
</article>
@endsection

@section('link-js')
    <script src="{{ asset('js/googleMap.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" defer></script>
@endsection
