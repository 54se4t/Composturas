function getMessage() {
    if ($('input[name="password"]')[0].value === $('input[name="repeatPassword"]')[0].value)
        $.ajax({
            type: 'POST',
            url: window.location.href, //URL actual
            data: { //Datos que envia al servidor
                _token: $('meta[name="csrf-token"]').attr('content'),
                email: $('input[name="email"]')[0].value,
                nombre: $('input[name="nombre"]')[0].value,
                apellidos: $('input[name="apellidos"]')[0].value,
                password: $('input[name="password"]')[0].value
            },
            success: function(data) {
                if (data.html["estado"] === "succeso") {
                    console.log(data.html["mensaje"]);
                    $('#mensaje-succeso div').text(data.html["mensaje"]);
                    $('#mensaje-succeso').css('opacity', '1')
                    setTimeout(function() {
                        $('#mensaje-succeso').css('opacity', '0');
                        window.location.href = ''
                    }, 1500);
                } else {
                    console.log(data.html["mensaje"]); //Error personalizado
                    $('#mensaje-error div').text(data.html["mensaje"]);
                    $('#mensaje-error').css('opacity', '1')
                    setTimeout(function() { $('#mensaje-error').css('opacity', '0') }, 1500);
                }
            },
            error: function(request) { //Error de formato de campos
                //$("#mensajeError").html(""); //Vacia mensaje de anterior
                //Obtener error como un array
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
    else {
        $('#mensaje-error div').text('Las contraseñas no son iguales');
        $('#mensaje-error').css('opacity', '1')
        setTimeout(function() { $('#mensaje-error').css('opacity', '0') }, 3000);
    }
}
$("#boton-registrar").click(getMessage);