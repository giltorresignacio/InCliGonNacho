var xhr;
var password;
var formulario;
var user;
var datos;
var eventoForm 
var rgex = /^\w+([.]?\w+)*@educa.madrid.org$/
function enviarValidarPeticionAJAX(event) {
    if (user.value != '' && password.value != '') {
        console.log("validacionesok")
        eventoForm = event;
        xhr = new XMLHttpRequest();
        xhr.addEventListener('readystatechange', gestionarRespuesta, false);
        console.log( "./PHP/buscarEnBase.php?emailInicioSesion=" + user.value + "&contrasenhaInicioSesion=" + password.value);
        xhr.open("GET", "./PHP/buscarEnBase.php?emailInicioSesion=" + user.value + "&contrasenhaInicioSesion=" + password.value, false);
        xhr.send();
    } else {
        document.getElementById('chiquito').style.display = "block";
        event.preventDefault();
    }
}
function gestionarRespuesta(evento) {
    if (evento.target.readyState == 4 && evento.target.status == 200) {
        if (xhr.response == false) {
            document.getElementById('chiquito').style.display = "block";
            eventoForm.preventDefault();
        } else {
            datos = JSON.parse(xhr.response);
            sessionStorage.setItem("email", datos.mail);
            sessionStorage.setItem("contrasena", datos.contrasena);
            sessionStorage.setItem("admin", datos.admin);
            sessionStorage.setItem("id", datos.id);
        }
    }
}

document.addEventListener('readystatechange', inicializar, false);
function inicializar() {
    if (document.readyState == 'complete') {
        user = document.getElementById('user');
        password = document.getElementById('password');
        formulario = document.getElementById('myForm');
        document.getElementById('chiquito').style.display = "none";
        formulario.addEventListener('submit', enviarValidarPeticionAJAX, false);
    }
}