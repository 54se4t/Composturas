//Iniciar sesión con correo electronico y contraseña
function getMessage() {
    $.ajax({
        type: 'POST',
        url: window.location.href,
        data: { //Datos que envia al servidor
            _token: $('meta[name="csrf-token"]').attr('content'),
            email: $('input[name="email"]')[0].value,
            password: $('input[name="password"]')[0].value
        },
        success: function(data) {
            if (data.html["estado"] === "succeso") {
                $('#mensaje-succeso div').text(data.html["mensaje"]);
                $('#mensaje-succeso').css('opacity', '1')
                setTimeout(function() {
                    $('#mensaje-succeso').css('opacity', '0');
                    window.location.href = '/admin';
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
}
$("#boton-login").click(getMessage);

$("#boton-registrar").click(function() {
    window.location.href = '/admin-registrar'
});
