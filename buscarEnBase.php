<?php
if (isset($_GET['emailInicioSesion'])) {


    $mailInicioSesion = $_GET['emailInicioSesion'];
    $contraInicioSesion = $_GET['contrasenhaInicioSesion'];

    /* Conectar a la BD y luego ya actuo siempre sobre la variable conexion*/
    $conexion = mysqli_connect("localhost", "root", "", "escuela");

    /* Para seleccionar la bd*/
    mysqli_select_db($conexion, "escuela") or die("No se puede seleccionar la BD");

    /* Lazo la consulta sobre la BD*/
    $usuario = mysqli_query($conexion, "select mail, contrasena, admin from profesores where mail='$mailInicioSesion' AND contrasena='$contraInicioSesion'");

    /* para detectar errores*/
    if (mysqli_connect_errno()) {
        printf("<p>Conexión fallida: %s</p>", mysqli_connect_error());
        exit();
    }

    /* Devuelve el número de filas del resultado */
    $numr = mysqli_num_rows($usuario);
    if ($numr > 0) {
        for ($i = 0; $i < $numr; $i++) {
            /* El resultado es realmente una matriz y voy cogiendo por filas con esa función*/
            $fila = mysqli_fetch_array($usuario, MYSQLI_ASSOC);
            /* Uso un foreach para recorrer fila ya que es una array .*/
            foreach ($fila as $key => $value) {
                $arrayParaJson[$key][] = $value;
            }
        }
        echo json_encode($arrayParaJson);
    } else {
        return false;
    }
} else {
    $nombre = $_GET["nombre"];
    $direccion = $_GET["direc"];
    $tel = (int) $_GET["telefono"];
    $arrayFinal = $_GET["checks"];
    $ids = explode(",", $arrayFinal);
    $conexion = mysqli_connect("localhost", "root", "", "ropa");
    mysqli_select_db($conexion, "tienda") or die("No se puede seleccionar la BD");

    /* Lazo la consulta sobre la BD*/
    $ultimoId = mysqli_query($conexion, "SELECT id FROM pedidos ORDER BY id DESC LIMIT 1");
    $fila = mysqli_fetch_array($ultimoId, MYSQLI_ASSOC);
    $idSig = $fila['id'] + 1;
    foreach ($ids as $key => $value) {
        $insert = "INSERT into pedidos (id, idProd, nombre, direccion, telefono) VALUES ($idSig," . $value . ",'" . $nombre  . "','" . $direccion . "'," . $tel . ")";
        mysqli_query($conexion, $insert);
    }
    //INSERT INTO `pedidos`(`id`, `idProd`, `nombre`, `direccion`, `telefono`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]')

    echo "Todo guay";
}
