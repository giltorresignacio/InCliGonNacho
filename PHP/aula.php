<?php
/* Conectar a la BD y luego ya actuo siempre sobre la variable conexion*/
$conexion = mysqli_connect("localhost", "root", "", "escuela");
/* Para seleccionar la bd*/
mysqli_select_db($conexion, "escuela") or die("No se puede seleccionar la BD");
$aulas = mysqli_query($conexion, "select * from aulas");

/* para detectar errores*/
if (mysqli_connect_errno()) {
    printf("<p>Conexión fallida: %s</p>", mysqli_connect_error());
    exit();
}

/* Devuelve el número de filas del resultado */
$numr = mysqli_num_rows($aulas);
if ($numr > 0) {
    for ($i = 0; $i < $numr; $i++) {
        /* El resultado es realmente una matriz y voy cogiendo por filas con esa función*/
        $fila = mysqli_fetch_array($aulas, MYSQLI_ASSOC);
        /* Uso un foreach para recorrer fila ya que es una array .*/
        foreach ($fila as $key => $value) {
            $arrayParaJson[$key][] = $value;
        }
    }
    echo json_encode($arrayParaJson);
} else {
    return false;
}