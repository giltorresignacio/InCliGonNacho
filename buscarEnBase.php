<?php
    /* Conectar a la BD y luego ya actuo siempre sobre la variable conexion*/
    $conexion = mysqli_connect("localhost", "root", "", "ropa");

    /* Para seleccionar la bd*/
    mysqli_select_db($conexion, "escuela") or die("No se puede seleccionar la BD");

    /* Lazo la consulta sobre la BD*/
    $usuario = mysqli_query($conexion, "select mail, contrasena from profesores where mail=");

    /* para detectar errores*/
    if (mysqli_connect_errno()) {
        printf("<p>Conexión fallida: %s</p>", mysqli_connect_error());
        exit();
    }

    /* Devuelve el número de filas del resultado */
    $numr = mysqli_num_rows($calzado);