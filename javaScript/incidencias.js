var xhr;
var datos;
var color;
xhr = new XMLHttpRequest();
tabla = document.getElementById('tabla');
function enviarValidarPeticionAJAX() {
    
    xhr.addEventListener('readystatechange', gestionarRespuesta, false);
    console.log("./PHP/buscarEnBase.php?idBuscarIncidencias=" + sessionStorage.getItem("id"));
    xhr.open("GET", "./PHP/buscarEnBase.php?idBuscarIncidencias=" + sessionStorage.getItem("id"), false);
    xhr.send();
}

function filtrar() {
    filtracion = document.getElementById('filtrar').value;
    console.log(filtracion);
    xhr.addEventListener('readystatechange', gestionarRespuesta, false);
    console.log("./PHP/buscarEnBase.php?filtracion=" + filtracion + "&idBuscarIncidenciasFiltrar=" + sessionStorage.getItem("id"));
    xhr.open("GET", "./PHP/buscarEnBase.php?filtracion=" + filtracion + "&idBuscarIncidenciasFiltrar=" + sessionStorage.getItem("id"), false);
    xhr.send();
}
function gestionarRespuesta() {
    if (xhr.readyState == 4 && xhr.status == 200) {
        datos = JSON.parse(xhr.response);
        tabla.innerHTML = '';
        for (index = 0; index < (datos.Tipo).length; index++) {
            console.log(datos.estado[index]);
            if (datos.estado[index] == 'creada') {
                color = 'red'
            } else if (datos.estado[index] == 'en curso') {
                color = 'yellow'
            } else {
                color = 'green'
            }
            tabla.innerHTML += "<tr>" +
                "<td>" + datos.Tipo[index] + "</td>" +
                "<td>" + datos.Aula[index] + "</td>" +
                "<td>" + datos.Grupo[index] + "</td>" +
                "<td>" + datos.fecha[index] + "</td>" +
                "<td>" + datos.descripcion[index] + "</td>" +
                "<td style='color: " + color + "'>" + datos.estado[index] + "</td>" +
                "</tr>"
        }
    }
}

document.addEventListener('DOMContentLoaded', enviarValidarPeticionAJAX, false);
document.getElementById('filtrar').addEventListener('change', filtrar, false);