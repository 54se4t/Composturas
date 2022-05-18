<article>
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="row g-3">
                    <h1 class="h3 mb-3 fw-normal">Registrar</h1>
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label" name="nombre">Nombre</label>
                        <input type="text" class="form-control" id="firstName" name="nombre" placeholder="Letras solo" value=""
                            required="">
                    </div>

                    <div class="col-sm-6">
                        <label for="lastName" class="form-label">Apellidos</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">@</span>
                            <input type="text" class="form-control" id="lastName" name="apellidos" placeholder="Letras solo"
                                value="" required="">
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="ejemplo@ejemplo.com"
                            name="email">
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" placeholder="Entre 9 y 16 caracteres, solo acepta letra, numeros, _ y -"
                            required="" name="password">
                    </div>

                    <div class="col-12">
                        <label for="address2" class="form-label">Repetir contraseña <span
                                class="text-muted">(Tiene
                                que ser mismo que anterior)</span></label>
                        <input type="password" class="form-control" id="password-repeat" placeholder="Entre 9 y 16 caracteres, solo acepta letra, numeros, _ y -"
                            name="repeatPassword">
                    </div>
                    <button id="boton-registrar" class="w-100 btn btn-primary btn-lg" type="submit">Registrar</button>
                </div>
            </div>
    </section>
</article>
