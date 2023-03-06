var xhr;
var password;
var formulario;
var user;
var datos;
var color;
var rgex = /^\w+([.]?\w+)*@educa.madrid.org$/
xhr = new XMLHttpRequest();
function enviarValidarPeticionAJAX() {
    tabla = document.getElementById('tabla');
    xhr.addEventListener('readystatechange', gestionarRespuesta, false);
    xhr.open("GET", "buscarEnBase.php?idBuscarIncidencias=" + sessionStorage.getItem("id"), false);
    xhr.send();
}
function gestionarRespuesta() {
    if (xhr.readyState == 4 && xhr.status == 200) {
        datos = JSON.parse(xhr.response);

        for (index = 0; index < (datos.Tipo).length; index++) {
            console.log(datos.estado[index]);
            if (datos.estado[index] == 'creada') {
                console.log("Por que");
                color = 'red'
            } else if (datos.estado[index] == 'en curso') {
                color = 'yellow'
            } else {
                color = 'green'
            }
            console.log(color);
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
// if(datos.estado[index]='creada'){
//     +"<td style='color: green'>" + datos.estado[index] + "</td>"
// }
document.addEventListener('DOMContentLoaded', enviarValidarPeticionAJAX, false);