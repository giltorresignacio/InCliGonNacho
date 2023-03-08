var xhr;
var datos;
var color;
xhr = new XMLHttpRequest();
xhrDos = new XMLHttpRequest();
function enviarValidarPeticionAJAX() {
    xhr.addEventListener('readystatechange', gestionarRespuesta, false);
    xhr.open("GET", "./PHP/buscarEnBase.php?incidenTodas=a", false);
    xhr.send();
}
function cambiarEstado(event) {
    xhrDos.addEventListener('readystatechange', gestionarRespuestaEstado, false);
    console.log("./PHP/buscarEnBase.php?idIncidencia=" + event.target.id + "&valorEstado=" + event.target.value);
    xhrDos.open("GET", "./PHP/buscarEnBase.php?idIncidencia=" + event.target.id + "&valorEstado=" + event.target.value, false);
    xhrDos.send();
}
function gestionarRespuesta() {
    if (xhr.readyState == 4 && xhr.status == 200) {
        tabla.innerHTML = "";
        datos = JSON.parse(xhr.response);
        console.log(datos);
        for (index = 0; index < (datos.Tipo).length; index++) {
            console.log(datos.estado[index]);
            if (datos.estado[index] == 'creada') {
                color = 'red'
            } else if (datos.estado[index] == 'en curso') {
                color = 'yellow'
            } else {
                color = 'green';
            }

            tabla.innerHTML += "<tr>" +
                "<td>" + datos.Tipo[index] + "</td>" +
                "<td>" + datos.Aula[index] + "</td>" +
                "<td>" + datos.Grupo[index] + "</td>" +
                "<td>" + datos.fecha[index] + "</td>" +
                "<td>" + datos.descripcion[index] + "</td>" +
                "<td style='color: " + color + "'>" + datos.estado[index] + "</td>" +
                "<td><select id='" + datos.id[index] + "'>" +
                "<option value='-'>-</option>" +
                "<option value='en curso'>En curso</option>" +
                "<option value='terminada'>Terminada</option></select></td>" +
                "</tr>";
        }
        selects = document.getElementsByTagName("select");
        for (i = 0; i < selects.length; i++) {
            selects[i].addEventListener('change', cambiarEstado, false);
        }

    }
}

function gestionarRespuestaEstado() {
    if (xhrDos.readyState == 4 && xhrDos.status == 200) {
        enviarValidarPeticionAJAX();
    }
}

document.addEventListener('DOMContentLoaded', enviarValidarPeticionAJAX, false);