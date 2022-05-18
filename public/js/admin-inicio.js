//boton coger de tabla Citas
const botonCoger = document.querySelectorAll('.boton-coger');
for (let i = 0; i < botonCoger.length; i++) {
    botonCoger[i].addEventListener('click', function() {
        if (botonCoger[i].textContent === "Coger") {
            botonCoger[i].classList.add('btn-warning');
            botonCoger[i].classList.remove('btn-primary');
            botonCoger[i].textContent = "Cogido";
        } else {
            botonCoger[i].classList.remove('btn-warning');
            botonCoger[i].classList.add('btn-primary');
            botonCoger[i].textContent = "Coger";
        }
    })
}
//Confirma la modificación de citas
const editarCitas = document.querySelectorAll('#citas .boton-editar');
for (let i = 0; i < editarCitas.length; i++) {
    editarCitas[i].addEventListener('click', function() {
        let cid = editarCitas[i].parentElement.parentElement.children[0].textContent;
        coger = editarCitas[i].parentElement.parentElement.children[2].textContent;
        coger = coger.indexOf('Cogido') >= 0;
        let estado = editarCitas[i].parentElement.parentElement.children[4].children[0].value;
        let fecha = editarCitas[i].parentElement.parentElement.children[5].children[0].value;
        fecha = fecha.replace('T', ' ') + ":00";
        let url = window.location.href + "/editarCita";
        $.ajax({
            type: 'POST',
            url: url,
            data: { //Datos que envia al servidor
                _token: $('meta[name="csrf-token"]').attr('content'),
                cid: cid,
                coger: coger,
                estado: estado,
                fecha: fecha
            },
            success: function(data) {
                if (data.html["estado"] === "succeso") {
                    $('#mensaje-succeso div').text(data.html["mensaje"]);
                    $('#mensaje-succeso').css('opacity', '1')
                    setTimeout(function() {
                        $('#mensaje-succeso').css('opacity', '0');
                        if (coger) {
                            editarCitas[i].parentElement.parentElement.children[2].children[0].classList.remove("btn-primary");
                            editarCitas[i].parentElement.parentElement.children[2].children[0].classList.remove("btn-warning");
                            editarCitas[i].parentElement.parentElement.children[2].children[0].classList.add("btn-success");
                            editarCitas[i].parentElement.parentElement.children[4].children[0].value = 'confirmado';
                        }
                    }, 1500);
                } else {
                    $('#mensaje-error div').text(data.html["mensaje"]);
                    $('#mensaje-error').css('opacity', '1')
                    setTimeout(function() { $('#mensaje-error').css('opacity', '0') }, 1500);
                }
            },
            error: function(request) { //Error de formato de campos
                //Obtener error como un array
                let errors = JSON.parse(request.responseText)["errors"];
                let mensajeError = "";
                for (let error in errors) {
                    mensajeError += errors[error] + "<br>";
                }
                $('#mensaje-error div').html(mensajeError);
                $('#mensaje-error').css('opacity', '1')
                setTimeout(function() { $('#mensaje-error').css('opacity', '0') }, 3000);
            }
        });
    })
}

//Modificación de trabajadores
const celdas = document.querySelectorAll('#tablaTrabajadores td');
for (let i = 0; i < celdas.length; i++) {
    celdas[i].addEventListener('click', function() {
        if (i % 6 !== 0 && i % 6 !== 4 && i % 6 !== 5) {
            let texto = prompt("Modificar", celdas[i].textContent);
            if (texto) {
                celdas[i].textContent = texto;
                celdas[i].style.backgroundColor = "yellow";
            }
        }
    })
}
//Confirma la modificación de trabajador
const editarTrabajador = document.querySelectorAll('#trabajadores .boton-editar');
for (let i = 0; i < editarTrabajador.length; i++) {
    editarTrabajador[i].addEventListener('click', function() {
        let tid = editarTrabajador[i].parentElement.parentElement.children[0].textContent;
        let nombre = editarTrabajador[i].parentElement.parentElement.children[1].textContent;
        let apellidos = editarTrabajador[i].parentElement.parentElement.children[2].textContent;
        let email = editarTrabajador[i].parentElement.parentElement.children[3].textContent;
        let permiso = editarTrabajador[i].parentElement.parentElement.children[4].children[0].value;
        let url = window.location.href + "/editarTrabajador";
        $.ajax({
            type: 'POST',
            url: url,
            data: { //Datos que envia al servidor
                _token: $('meta[name="csrf-token"]').attr('content'),
                tid: tid,
                nombre: nombre,
                apellidos: apellidos,
                email: email,
                permiso: permiso
            },
            success: function(data) {
                if (data.html["estado"] === "succeso") {
                    $('#mensaje-succeso div').text(data.html["mensaje"]);
                    $('#mensaje-succeso').css('opacity', '1')
                    setTimeout(function() {
                        $('#mensaje-succeso').css('opacity', '0');
                    }, 1500);
                } else {
                    $('#mensaje-error div').text(data.html["mensaje"]);
                    $('#mensaje-error').css('opacity', '1')
                    setTimeout(function() { $('#mensaje-error').css('opacity', '0') }, 1500);
                }
            },
            error: function(request) { //Error de formato de campos
                //Obtener error como un array
                let error = request['responseJSON']['message'];
                $('#mensaje-error div').html(error);
                $('#mensaje-error').css('opacity', '1')
                setTimeout(function() { $('#mensaje-error').css('opacity', '0') }, 3000);
            }
        });
    })
}

//Filtrar datos
const tablaCitas = document.querySelector('#tablaCitas').childNodes[3];
const datosCitas = tablaCitas.children;
const citasBuscarCliente = document.querySelector('#citas .buscar-cliente');
citasBuscarCliente.addEventListener('click', function() {
    let cliente = document.querySelector('#citas .buscar-cliente+input');
    cliente = cliente.value.toLowerCase();
    for (let i = 0; i < datosCitas.length; i++) {
        if (datosCitas[i].children[1].textContent.toLowerCase().indexOf(cliente) !== -1)
            datosCitas[i].style.display = 'table-row';
        else
            datosCitas[i].style.display = 'none';
    }
});
const citasBuscarEstado = document.querySelector('#citas .buscar-estado');
citasBuscarEstado.addEventListener('click', function() {
    let estado = document.querySelector('#citas .buscar-estado+input');
    estado = estado.value.toLowerCase();
    for (let i = 0; i < datosCitas.length; i++) {
        if (datosCitas[i].children[4].textContent.toLowerCase().indexOf(estado) !== -1)
            datosCitas[i].style.display = 'table-row';
        else
            datosCitas[i].style.display = 'none';
    }
});


const tablaTrabajadores = document.querySelector('#tablaTrabajadores').childNodes[3];
const datosTrabajadores = tablaTrabajadores.children;
const buscarTrabajador = document.querySelector('#trabajadores .buscar-trabajador');
buscarTrabajador.addEventListener('click', function() {
    let trabajador = document.querySelector('#trabajadores .buscar-trabajador+input');
    trabajador = trabajador.value.toLowerCase();
    for (let i = 0; i < datosTrabajadores.length; i++) {
        if (datosTrabajadores[i].children[2].textContent.toLowerCase().indexOf(trabajador) !== -1)
            datosTrabajadores[i].style.display = 'table-row';
        else
            datosTrabajadores[i].style.display = 'none';
    }
});
const buscarTrabajadorEmail = document.querySelector('#trabajadores .buscar-email');
buscarTrabajadorEmail.addEventListener('click', function() {
    let email = document.querySelector('#trabajadores .buscar-email+input');
    email = email.value.toLowerCase();
    for (let i = 0; i < datosTrabajadores.length; i++) {
        if (datosTrabajadores[i].children[3].textContent.toLowerCase().indexOf(email) !== -1) {} else {
            datosTrabajadores[i].style.display = 'none';
        }
    }
});


const tablaClientes = document.querySelector('#tablaClientes').childNodes[3];
const datosClientes = tablaClientes.children;
const buscarClientes = document.querySelector('#clientes .buscar-cliente');
buscarClientes.addEventListener('click', function() {
    let cliente = document.querySelector('#clientes .buscar-cliente+input');
    cliente = cliente.value.toLowerCase();
    for (let i = 0; i < datosClientes.length; i++) {
        if (datosClientes[i].children[2].textContent.toLowerCase().indexOf(cliente) !== -1)
            datosClientes[i].style.display = 'table-row';
        else
            datosClientes[i].style.display = 'none';
    }
});
const buscarClienteEmail = document.querySelector('#clientes .buscar-email');
buscarClienteEmail.addEventListener('click', function() {
    let email = document.querySelector('#clientes .buscar-email+input');
    email = email.value.toLowerCase();
    for (let i = 0; i < datosClientes.length; i++) {
        if (datosClientes[i].children[3].textContent.toLowerCase().indexOf(email) !== -1)
            datosClientes[i].style.display = 'table-row';
        else
            datosClientes[i].style.display = 'none';
    }
});
