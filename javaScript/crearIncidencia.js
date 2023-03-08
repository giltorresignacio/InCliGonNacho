var xhr;
var datos;
var color;
xhr = new XMLHttpRequest();
xhrDos = new XMLHttpRequest();
xhrTres = new XMLHttpRequest();
enviarTipo();
enviarGrupo();
enviarAula();
function enviarAula() {
    xhr.addEventListener('readystatechange', gestionarRespuestaAula, false);
    xhr.open("POST", "./PHP/aula.php", false);
    xhr.send();

}
function enviarGrupo() {
    xhrDos.addEventListener('readystatechange', gestionarRespuestaGrupo, false);
    xhrDos.open("POST", "./PHP/grupos.php", false);
    xhrDos.send();
}
function enviarTipo() {
    xhrTres.addEventListener('readystatechange', gestionarRespuestaTipo, false);
    xhrTres.open("POST", "./PHP/tipos.php", false);
    xhrTres.send();
}

function gestionarRespuestaAula() {
    if (xhr.readyState == 4 && xhr.status == 200) {
        datos = JSON.parse(xhr.response);
        for (index = 0; index < (datos.id).length; index++) {
            document.getElementById('aula').innerHTML += "<option value='" + datos.id[index] + "'>" + datos.nombre[index] + "</option>"
        }
        datos = '';
    }
}
function gestionarRespuestaGrupo() {
    if (xhrDos.readyState == 4 && xhrDos.status == 200) {
        datosDos = JSON.parse(xhrDos.response);
        for (index = 0; index < (datosDos.id).length; index++) {
            document.getElementById('curso').innerHTML += "<option value='" + datosDos.id[index] + "'>" + datosDos.nombre[index] + "</option>"
        }
    }
}
function gestionarRespuestaTipo() {
    if (xhrTres.readyState == 4 && xhrTres.status == 200) {
        datosTres = JSON.parse(xhrTres.response);
        for (index = 0; index < (datosTres.id).length; index++) {
            document.getElementById('tipo').innerHTML += "<option value='" + datosTres.id[index] + "'>" + datosTres.nombre[index] + "</option>"
        }
    }
}

function gestionarRespuesta() {
    if (xhrCuatro.readyState == 4 && xhrCuatro.status == 200) {
        if (xhrCuatro.response != false) {
            window.alert("Incidencia creada correctamente")
        }

    }
}
function enviarInsertado() {
    grupo = document.getElementById('curso').value;
    profe = sessionStorage.getItem('id');
    tipo = document.getElementById('tipo').value;
    aula = document.getElementById('aula').value;
    descripcion = document.getElementById('descripcion').value;
    xhrCuatro = new XMLHttpRequest();
    xhrCuatro.addEventListener('readystatechange', gestionarRespuesta, false);
    console.log("./PHP/buscarEnBase.php?idProfIns=" + profe + "&grupIns="
        + grupo + "&tipoIns=" + tipo + "&aulaIns=" + aula
        + "&desIns=" + descripcion);
    xhrCuatro.open("GET", "./PHP/buscarEnBase.php?idProfIns=" + profe + "&grupIns="
        + grupo + "&tipoIns=" + tipo + "&aulaIns=" + aula
        + "&desIns=" + descripcion, false);
    xhrCuatro.send();
}

document.getElementById("formulario").addEventListener('submit', enviarInsertado, false);