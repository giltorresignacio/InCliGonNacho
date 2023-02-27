<?php
// Inicializar la sesión.
// Si está usando session_name("algo"), ¡no lo olvide ahora!
session_start();

// Destruir todas las variables de sesión.
$_SESSION = array();


// Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
if (ini_get("session.use_cookies")) {

    $params = session_get_cookie_params();
    setcookie(
        session_name("PHPSESSID"),
        '', time() + 30 * 24 * 60 * 60,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );

}
unset($_SESSION['nombre_usuario']);

// Finalmente, destruir la sesión.
header("Location:index.php");
?>