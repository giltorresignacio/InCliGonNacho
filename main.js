var xhr;
var password;
var formulario;
var user;
var datos;
var rgex =  /^\w+([.]?\w+)*@educa.madrid.org$/
function enviarValidarPeticionAJAX(event) {
    if (user.value != '' && rgex.test(user.value) && password.value != '') {
        window.alert("ORENJI TE QUIERO");
        llegada.innerHTML = "";
        xhr = new XMLHttpRequest();
        xhr.addEventListener('readystatechange', gestionarRespuesta, false);
        xhr.open('POST', 'viajes.xml', true);
        xhr.send();
    } else {
        document.getElementById('chiquito').style.display = "block";
        event.preventDefault();
       
    }
}
function gestionarRespuesta(evento) {
    if (evento.target.readyState == 4 && evento.target.status == 200) {
        llegada.disabled = false;
        datos = evento.target.responseXML;
        salidas = datos.getElementsByTagName("salida");

        for (i = 0; i < salidas.length; i++) {

            if (salidas[i].childNodes[0].nodeValue == ida.value) {
                posiblesDestinos = salidas[i].parentNode.getElementsByTagName("nombre");

                for (j = 0; j < posiblesDestinos.length; j++) {
                    llegada.innerHTML += "<option>" + posiblesDestinos[j].childNodes[0].nodeValue + "</option>";
                }
            }
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