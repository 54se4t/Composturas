const palabraMeses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
// Respuesta stackoverflow https://stackoverflow.com/a/11348383
$.fn.ignore = function(sel) {
    return this.clone().find(sel || ">*").remove().end();
};

function getMessagePedirCitas() {
    let descripcion = $('textarea[name="descripcion"]').val();
    let mes = palabraMeses.indexOf($('#listaMeses a.active').text()) + 1 + "";
    if (mes.length === 1)
        mes = "0" + mes;
    let dia = $('#listaDias a.active').ignore("span").text();
    dia = dia.replaceAll(" ", "")
    if (dia.length === 1)
        dia = "0" + dia;
    let hora = $('#listaHoras a.active').text() + ":00";
    let fecha = new Date().getFullYear() + "-" + mes + "-" + dia + " " + hora;
    console.log(fecha);
    if (fecha.length < 19) {
        $('#mensaje-error div').text('Por favor, selecciona una hora');
        $('#mensaje-error').css('opacity', '1')
        setTimeout(function() { $('#mensaje-error').css('opacity', '0') }, 3000);
    } else if (descripcion.length === 0) {
        $('#mensaje-error div').text('Por favor, escribe tus requisitos');
        $('#mensaje-error').css('opacity', '1')
        setTimeout(function() { $('#mensaje-error').css('opacity', '0') }, 3000);
    } else {
        $.ajax({
            type: 'POST',
            url: window.location.href,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                descripcion: descripcion,
                cita: fecha
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
}
$("#botonPedirCitas").click(getMessagePedirCitas);

let citas = document.querySelectorAll('.cita');
citas.forEach(cita => {
    cita.childNodes[1].textContent //Fecha
    cita.childNodes[5].addEventListener('click', function() {
        $.ajax({
            type: 'POST',
            url: window.location.pathname + '/cancelar',
            data: { //Datos que envia al servidor
                _token: $('meta[name="csrf-token"]').attr('content'),
                fecha: cita.childNodes[1].textContent
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
});