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
var regContra = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d]{6,15}$/
var upperCase = new RegExp('[A-Z]');
var lowerCase = new RegExp('[a-z]');
var numbers = new RegExp('[0-9]');

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

function validarUsuario() {
    if (usuReg.val() != '' && regNombreApe.test(usuReg.val())) {
        $('#chiquitoUsuario').css('display', 'none');
    } else {
        $('#chiquitoUsuario').css('display', 'block');
    }
}

function validarEmail() {
    if (emailReg.val() != '' && rgex.test(emailReg.val())) {
        $('#chiquitoCorreo').css('display', 'none');
    } else {
        $('#chiquitoCorreo').css('display', 'block');
    }
}

function validarPassword() {

    if (passReg.val() != '' && regContra.test(passReg.val())) {
        $('#tamanho').css('color', 'green');
    } else {
        $('#tamanho').css('color', 'red');
        //MAYUS
        if (passReg.val().match(upperCase)) {
            $('#mayus').css('color', 'green');
        } else {
            $('#mayus').css('color', 'red');
        }
        //MINUS
        if (passReg.val().match(lowerCase)) {
            $('#minus').css('color', 'green');
        } else {
            $('#minus').css('color', 'red');
        }
        //NUM
        if (passReg.val().match(numbers)) {
            $('#number').css('color', 'green');
        } else {
            $('#number').css('color', 'red');
        }
    }
}

document.addEventListener('readystatechange', inicializar, false);
function inicializar() {
    if (document.readyState == 'complete') {
        nomReg = $('#nombreRegistro');
        apell = $('#apellidosRegistro');
        depart = $('#departamentoRegistro');
        usuReg = $('#usuarioRegistro');
        emailReg = $('#emailRegistro');
        passReg = $('#passwordRegistro');
        formulario = $('#form');
        var divsToHide = document.getElementsByClassName("ocultar"); //divsToHide is an array
        for (var i = 0; i < divsToHide.length; i++) {
            divsToHide[i].style.display = "none";
            divsToHide[i].style.color = "red"; // depending on what you're doing
        }
        formulario.submit(enviarValidarPeticionAJAX);
        nomReg.keyup(validarNombre);
        apell.keyup(validarApellido);
        depart.change(validarDepartamento);
        usuReg.keyup(validarUsuario)
        emailReg.focusout(validarEmail);
        passReg.keyup(validarPassword);
    }
}