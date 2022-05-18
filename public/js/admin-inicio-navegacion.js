//Obtener los articulos: home, cita, trabajadore, clientes, guía
let contenidos = [];
$('#contenidos').children().each(function(index, item) {
    contenidos.push($(item)[0]);
})

//Obtener los botones: home, cita, trabajadore, clientes, guía
let botones = [];
$('#menu').children().each(function(index, item) {
    botones.push($(item)[0]);
})

//Evento para mostrar/esconder articulos
for (let i = 0; i < botones.length; i++) {
    botones[i].addEventListener('click', function() {
        botones.forEach(boton => {
            boton.childNodes[1].classList.remove('active');
            boton.childNodes[1].classList.add('text-white');
        });
        botones[i].childNodes[1].classList.add('active')
        botones[i].childNodes[1].classList.remove('text-white')
        contenidos[i].style.display = 'block';
        for (let j = 0; j < botones.length; j++) {
            if (j !== i) {
                contenidos[j].style.display = 'none';
            }
        }
    });
}

//Evento para botón de home -> guias
$('#botonGuia').click(function() {
    console.log("guia");
    for (let j = 0; j < botones.length; j++) {
        botones.forEach(boton => {
            boton.childNodes[1].classList.remove('active');
            boton.childNodes[1].classList.add('text-white');
        });
        botones[botones.length - 1].childNodes[1].classList.add('active')
        botones[botones.length - 1].childNodes[1].classList.remove('text-white')
        if (j !== botones.length - 1) {
            contenidos[j].style.display = 'none';
        } else {
            contenidos[j].style.display = 'block';
        }
    }
})

//Ver citas de un cliente
const botonVerCitas = document.querySelectorAll('#clientes .boton-ver-citas');
for (let i = 0; i < botonVerCitas.length; i++) {
    botonVerCitas[i].addEventListener('click', function() {
        for (let j = 0; j < botones.length; j++) {
            contenidos[j].style.display = 'none';
        }
        contenidos[1].style.display = 'block';
        let apellidos = botonVerCitas[i].parentElement.parentElement.children[2].textContent;
        document.querySelector('#citas .buscar-cliente+input').value = apellidos;
        for (let i = 0; i < datosCitas.length; i++) {
            if (datosCitas[i].children[1].textContent.indexOf(apellidos) !== -1)
                datosCitas[i].style.display = 'table-row';
            else
                datosCitas[i].style.display = 'none';
        }
    })
}
