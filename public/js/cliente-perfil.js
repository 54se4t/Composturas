$("#boton-editar").click(function() {
    $('table').append("<tr><th scope='row'>Contraseña antigua</th><td></td></tr>");
    $('table').append("<tr><th scope='row'>Contraseña</th><td></td></tr>");
    $('table').append("<tr><th scope='row'>Repetir contraseña</th><td></td></tr>");
    let campos = $("td");
    for (let i = 0; i < campos.length; i++) {
        dato = campos[i].textContent;
        campos[i].innerHTML = "";
        let input = document.createElement('input');
        if (i > 2)
            input.type = 'password';
        campos[i].appendChild(input);
        $("input")[i].value = dato;
    }
    $("#boton-aceptar").prop("disabled", false);
    $("#boton-editar").prop("disabled", true);
});

$("#boton-aceptar").click(function() {
    let nombre = $("input")[0].value;
    let apellidos = $("input")[1].value;
    let email = $("input")[2].value;
    let oldPassword = $("input")[3].value;
    let password = $("input")[4].value;
    let repeatPassword = $("input")[5].value;
    if (!(nombre && apellidos && email && password && repeatPassword)) {
        $('#mensaje-error div').text('Los campos no pueden ser vacío');
        $('#mensaje-error').css('opacity', '1')
        setTimeout(function() { $('#mensaje-error').css('opacity', '0') }, 3000);
    } else if (password !== repeatPassword) {
        $('#mensaje-error div').text('Las contraseñas no son iguales');
        $('#mensaje-error').css('opacity', '1')
        setTimeout(function() { $('#mensaje-error').css('opacity', '0') }, 3000);
    } else {
        $.ajax({
            type: 'POST',
            url: window.location.href, //URL actual
            data: { //Datos que envia al servidor
                _token: $('meta[name="csrf-token"]').attr('content'),
                nombre: nombre,
                apellidos: apellidos,
                email: email,
                password: password,
                oldPassword: oldPassword
            },
            success: function(data) {
                if (data.html["estado"] === "succeso") {
                    $('#mensaje-succeso div').text(data.html["mensaje"]);
                    $('#mensaje-succeso').css('opacity', '1')
                    setTimeout(function() {
                        $('#mensaje-succeso').css('opacity', '0');
                        window.location.href = '/cliente-perfil'
                    }, 1500);
                } else {
                    $('#mensaje-error div').text(data.html["mensaje"]);
                    $('#mensaje-error').css('opacity', '1')
                    setTimeout(function() { $('#mensaje-error').css('opacity', '0') }, 1500);
                }
            },
            error: function(request) {
                let errors = JSON.parse(request.responseText)["errors"];
                let mensajeError = "";
                for (let error in errors) {
                    mensajeError += errors[error][0] + "<br>";
                }
                $('#mensaje-error div').html(mensajeError);
                $('#mensaje-error').css('opacity', '1')
                setTimeout(function() { $('#mensaje-error').css('opacity', '0') }, 3000);
            }
        });
    }
})
