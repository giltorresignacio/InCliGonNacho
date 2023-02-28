function comprobarSesion() {
  // Comprobamos si existen variables de sesión
  if (!sessionStorage.getItem("email")) {
    // Si no existen, redirigimos a la página "index.html"
    window.location.replace("index.html");
  } else {
    console.log(sessionStorage.getItem("email"));
    console.log(sessionStorage.getItem("contrasena"));
    console.log(sessionStorage.getItem("admin"));
  }
}
document.onreadystatechange = function () {
  // Comprobamos si la página HTML se ha cargado completamente
  if (document.readyState === "complete") {
    // Llamamos a la función comprobarSesion
    comprobarSesion();
    if (sessionStorage.getItem("admin") == 1) {
      document.getElementById("ocultar").style.display = "block";
    } else {
      document.getElementById("ocultar").style.display = "none";
    }
  }
};

function borrarSesiones() {
  sessionStorage.clear();
}

document.getElementById("cerrarSesion").addEventListener("click", borrarSesiones);