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
var comNom = 0;
var comApe = 0;
var comDepar = 0;
var comUsu = 0;
var comEmail = 0;
var comPass = 0;

function enviarValidarPeticionAJAX(event) {
    console.log(comApe);
    console.log(comNom);
    console.log(comDepar);
    console.log(comUsu);
    console.log(comEmail);
    console.log(comPass);
    if (comNom == 1 && comApe == 1 && comDepar == 1 & comUsu == 1 && comEmail == 1 && comPass == 1) {
        console.log("validacionesok")
        xhr = new XMLHttpRequest();
        xhr.addEventListener('readystatechange', gestionarRespuesta, false);
        console.log("./PHP/buscarEnBase.php?nomReg=" + nomReg.val() + "&apell=" + apell.val() + "&usuReg=" + usuReg.val() + "&emailReg=" + emailReg.val() + "&passReg=" + passReg.val() + "&depart=" + depart.val());
        xhr.open("GET", "./PHP/buscarEnBase.php?nomReg=" + nomReg.val() + "&apell="
            + apell.val() + "&usuReg=" + usuReg.val() + "&emailReg=" + emailReg.val()
            + "&passReg=" + passReg.val() + "&depart=" + depart.val(), false);
        xhr.send();
    } else {
        window.alert("Error");
        event.preventDefault();
    }
}
function gestionarRespuesta(evento) {
    if (evento.target.readyState == 4 && evento.target.status == 200) {
        console.log(xhr.response)
        if (xhr.response == false) {
            window.alert("Usuario ya existente")
            formulario.preventDefault();
        } else {
            window.alert("Usuario creado correctamente")
        }
    }
}

function validarNombre() {
    if (nomReg.val() != '' && regNombreApe.test(nomReg.val())) {
        comNom = 1;
        $('#chiquitoNombre').css('display', 'none');
    } else {
        comNom = 0;
        $('#chiquitoNombre').css('display', 'block');
    }
}

function validarApellido() {
    if (apell.val() != '' && regNombreApe.test(apell.val())) {
        comApe = 1;
        $('#chiquitoApellido').css('display', 'none');
    } else {
        comApe = 0;
        $('#chiquitoApellido').css('display', 'block');

    }
}

function validarDepartamento() {
    if (depart.val() != '') {
        comDepar = 1;
        $('#chiquitoDepartamento').css('display', 'none');
    } else {
        comDepar = 0;
        $('#chiquitoDepartamento').css('display', 'block');

    }
}

function validarUsuario() {
    if (usuReg.val() != '' && regNombreApe.test(usuReg.val())) {
        comUsu = 1;
        $('#chiquitoUsuario').css('display', 'none');
    } else {
        comUsu = 0;
        $('#chiquitoUsuario').css('display', 'block');
    }
}

function validarEmail() {
    if (emailReg.val() != '' && rgex.test(emailReg.val())) {
        comEmail = 1;
        $('#chiquitoCorreo').css('display', 'none');
    } else {
        comEmail = 0;
        $('#chiquitoCorreo').css('display', 'block');
    }
}

function validarPassword() {

    if (passReg.val() != '' && regContra.test(passReg.val())) {
        comPass = 1;
        $('#tamanho').css('color', 'green');
    } else {
        comPass = 0;
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