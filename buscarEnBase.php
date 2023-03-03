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

    $nomReg = $_GET['nomReg'];
    $epellidoReg = $_GET['apell'];
    $usuReg = $_GET['usuReg'];
    $emailReg = $_GET['emailReg'];
    $passReg = $_GET['passReg'];
    $departReg = $_GET['depart'];
    /* Conectar a la BD y luego ya actuo siempre sobre la variable conexion*/
    $conexion = mysqli_connect("localhost", "root", "", "escuela");

    /* Para seleccionar la bd*/
    mysqli_select_db($conexion, "escuela") or die("No se puede seleccionar la BD");
    echo "INSERT INTO `profesores`(`nombre`, `apellidos`, `departamento`, 
    `usuario`, `contrasena`, `mail`, `admin`) VALUES ('$nomReg', '$epellidoReg' ,'$departReg','$usuReg','$passReg','$emailReg',0)";
    /* Lazo la consulta sobre la BD*/
    $insert = mysqli_query($conexion, "INSERT INTO `profesores`(`nombre`, `apellidos`, `departamento`, 
    `usuario`, `contrasena`, `mail`, `admin`) VALUES ('$nomReg', '$epellidoReg' ,'$departReg','$usuReg','$passReg','$emailReg',0)");
    echo $insert;
    /* para detectar errores*/
    
}
