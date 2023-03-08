<?php
/* Conectar a la BD y luego ya actuo siempre sobre la variable conexion*/
$conexion = mysqli_connect("localhost", "root", "", "escuela");
/* Para seleccionar la bd*/
mysqli_select_db($conexion, "escuela") or die("No se puede seleccionar la BD");
if (isset($_GET['emailInicioSesion'])) {

    $mailInicioSesion = $_GET['emailInicioSesion'];
    $contraInicioSesion = $_GET['contrasenhaInicioSesion'];
    $usuario = mysqli_query($conexion, "select id, mail, contrasena, admin from profesores where usuario='$mailInicioSesion' AND contrasena='$contraInicioSesion'");

    /* para detectar errores*/
    if (mysqli_connect_errno()) {
        printf("<p>Conexión fallida: %s</p>", mysqli_connect_error());
        exit();
    }

    /* Devuelve el número de filas del resultado */
    $numr = mysqli_num_rows($usuario);
    if ($numr > 0) {
        echo "hola";
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
} else if (isset($_GET['nomReg'])) {

    $nomReg = $_GET['nomReg'];
    $epellidoReg = $_GET['apell'];
    $usuReg = $_GET['usuReg'];
    $emailReg = $_GET['emailReg'];
    $passReg = $_GET['passReg'];
    $departReg = $_GET['depart'];
    try {
        $insert = mysqli_query($conexion, "INSERT INTO `profesores`(`nombre`, `apellidos`, `departamento`, 
    `usuario`, `contrasena`, `mail`, `admin`) VALUES ('$nomReg', '$epellidoReg' ,'$departReg','$usuReg','$passReg','$emailReg',0)");
        echo true;
    } catch (Exception $e) {
        echo false;
    }
} else if (isset($_GET['idBuscarIncidencias'])) {
    $idParaBuscarIncidencias = $_GET['idBuscarIncidencias'];
    $incidencias = mysqli_query($conexion, "select tipos.nombre as Tipo, aulas.nombre as Aula, grupos.nombre as Grupo, incidencias.fecha, incidencias.descripcion, incidencias.estado from incidencias 
    INNER JOIN tipos ON incidencias.iDtipo = tipos.id 
    INNER JOIN aulas ON incidencias.iDaula = aulas.id
    INNER JOIN grupos ON incidencias.iDgrupo = grupos.id
    where profesor_id=$idParaBuscarIncidencias");


    /* para detectar errores*/
    if (mysqli_connect_errno()) {
        printf("<p>Conexión fallida: %s</p>", mysqli_connect_error());
        exit();
    }

    /* Devuelve el número de filas del resultado */
    $numr = mysqli_num_rows($incidencias);
    if ($numr > 0) {
        for ($i = 0; $i < $numr; $i++) {
            /* El resultado es realmente una matriz y voy cogiendo por filas con esa función*/
            $fila = mysqli_fetch_array($incidencias, MYSQLI_ASSOC);
            /* Uso un foreach para recorrer fila ya que es una array .*/
            foreach ($fila as $key => $value) {
                $arrayParaJson[$key][] = $value;
            }
        }
        echo json_encode($arrayParaJson);
    } else {
        return false;
    }
} else if (isset($_GET['idProfIns'])) {
    $idProf = $_GET['idProfIns'];
    $idGrupillo = $_GET['grupIns'];
    $idTipillo = $_GET['tipoIns'];
    $idAula = $_GET['aulaIns'];
    $descripcion = $_GET['desIns'];
    try {
        mysqli_query($conexion, "INSERT INTO `incidencias`(`iDtipo`, `iDaula`, `iDgrupo`, 
    `descripcion`, `estado`, `profesor_id`) VALUES ($idTipillo, $idAula ,$idGrupillo,'$descripcion','creada',$idProf)");
    } catch (Exception $e) {
        echo $e;
        echo false;
    }
} else if (isset($_GET['incidenTodas'])) {
    if (mysqli_connect_errno()) {
        printf("<p>Conexión fallida: %s</p>", mysqli_connect_error());
        exit();
    }
    $incidencias = mysqli_query($conexion, "select tipos.nombre as Tipo, aulas.nombre as Aula, grupos.nombre as Grupo, incidencias.fecha, incidencias.descripcion, incidencias.estado , incidencias.id from incidencias 
    INNER JOIN tipos ON incidencias.iDtipo = tipos.id 
    INNER JOIN aulas ON incidencias.iDaula = aulas.id
    INNER JOIN grupos ON incidencias.iDgrupo = grupos.id");
    /* Devuelve el número de filas del resultado */
    $numr = mysqli_num_rows($incidencias);
    if ($numr > 0) {
        for ($i = 0; $i < $numr; $i++) {
            /* El resultado es realmente una matriz y voy cogiendo por filas con esa función*/
            $fila = mysqli_fetch_array($incidencias, MYSQLI_ASSOC);
            /* Uso un foreach para recorrer fila ya que es una array .*/
            foreach ($fila as $key => $value) {
                $arrayParaJson[$key][] = $value;
            }
        }
        echo json_encode($arrayParaJson);
    } else {
        return false;
    }
} else if (isset($_GET['idIncidencia'])) {
    $idIncidencia = $_GET['idIncidencia'];
    $valorIncidencia = $_GET['valorEstado'];
    try {
        if (mysqli_connect_errno()) {
            printf("<p>Conexión fallida: %s</p>", mysqli_connect_error());
            exit();
        }
        $incidencias = mysqli_query($conexion, "UPDATE `incidencias` SET `estado`='$valorIncidencia' WHERE `id`=$idIncidencia");
        /* Devuelve el número de filas del resultado */
    } catch (Exception $e) {
        echo $e;
        echo false;
    }
}
