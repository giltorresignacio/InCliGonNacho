var xhr;
var nomReg;
var apell;
var usuReg;
var emailReg;
var passReg;
var depart;
var datos;
var rgex = /^\w+([.]?\w+)*@educa.madrid.org$/
var regNombreApe = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{2,255}$/
function enviarValidarPeticionAJAX(event) {
    if (user.value != '' && rgex.test(user.value) && password.value != '') {
        console.log("validacionesok")
        xhr = new XMLHttpRequest();
        xhr.addEventListener('readystatechange', gestionarRespuesta, false);
        console.log("buscarEnBase.php?emailInicioSesion=" + user.value + "&contrasenhaInicioSesion=" + password.value);
        xhr.open("GET", "buscarEnBase.php?emailInicioSesion=" + user.value + "&contrasenhaInicioSesion=" + password.value, false);
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
            formulario.preventDefault();
        } else {
            datos = JSON.parse(xhr.response);
            sessionStorage.setItem("email", datos.mail);
            sessionStorage.setItem("contrasena", datos.contrasena);
            sessionStorage.setItem("admin", datos.admin);
            salidas = datos.getElementsByTagName("salida");
        }
    }
}

function validarNombre() {
    if (nomReg.val() != '' && regNombreApe.test(nomReg.val())) {
        $('#chiquitoNombre').css('display', 'none');
    } else {
        $('#chiquitoNombre').css('display', 'block');
    }
}

function validarApellido() {
    if (apell.val() != '' && regNombreApe.test(apell.val())) {
        $('#chiquitoApellido').css('display', 'none');
    } else {
        $('#chiquitoApellido').css('display', 'block');
       
    }
}

function validarDepartamento() {
    if (depart.val() != '') {
        $('#chiquitoDepartamento').css('display', 'none');
    } else {
        $('#chiquitoDepartamento').css('display', 'block');
       
    }
}
document.addEventListener('readystatechange', inicializar, false);
function inicializar() {
    if (document.readyState == 'complete') {
        nomReg = $('#nombreRegistro');
        apell = $('#apellidosRegistro');
        depart =$('#departamentoRegistro');
        usuReg = document.getElementById('usuarioRegistro');
        emailReg = document.getElementById('emailRegistro');
        passReg = document.getElementById('passwordRegistro');
        formulario = document.getElementById('form');
        var divsToHide = document.getElementsByClassName("ocultar"); //divsToHide is an array
        for (var i = 0; i < divsToHide.length; i++) {
            divsToHide[i].style.display = "none"; // depending on what you're doing
        }
        formulario.addEventListener('submit', enviarValidarPeticionAJAX, false);
        nomReg.keyup(validarNombre);
        apell.keyup('submit', validarApellido, false);
        depart.change(validarDepartamento);
        // usuReg.addEventListener('submit', validarUsuario, false)
        // emailReg.addEventListener('submit', validarEmail, false);
        // passReg.addEventListener('submit', validarPassword, false);

    }
}