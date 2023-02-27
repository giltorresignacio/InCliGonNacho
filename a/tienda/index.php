<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Index tienda</title>
  <link href="estilos.css" rel="stylesheet" type="text/css">
</head>

<body class="cuerpo">
  <div class="formulario">
    <?php

    // Conectamos a la base de datos
    $conn = mysqli_connect('localhost', 'root', '', 'tienda');

    // Comprobamos si se ha enviado el formulario de acceso
    if (isset($_POST['login'])) {
      // Si se ha enviado, comprobamos si el nombre de usuario y la contraseña son correctos
      if (check_login_credentials($_POST['username'], $_POST['password'], $conn)) {
        $_SESSION['nombre_usuario'] = $username;

        // Si son correctos, guardamos el nombre de usuario en una cookie
        setcookie('last_login', $_POST['username'], time() + (7 * 24 * 60 * 60));


      }
    }
    $_SESSION['nombre_usuario'] = $_POST['username'];
    // Comprobamos si existe una cookie con el último usuario que accedió correctamente
    if (isset($_COOKIE['last_login'])) {

      // Si existe, cargamos el nombre de usuario en el formulario de acceso
      $default_username = $_COOKIE['last_login'];


    } else {

      // Si no existe, dejamos el campo del formulario de acceso en blanco
      $default_username = '';

    }

    echo "<div class='formulario'>";
    // Mostramos el formulario de acceso con el nombre de usuario cargado, si existe
    echo '<form action="index.php" method="post">';
    echo '  <label for="username">Nombre de usuario:</label>';
    echo '  <input type="text" name="username" value="' . $default_username . '">';
    echo '  <br>';
    echo '  <label for="password">Contraseña:</label>';
    echo '  <input type="password" name="password">';
    echo '  <br>';
    echo '  <input type="submit" name="login" value="Acceder">';
    echo '</form>';
    echo "</div>";

    // Función para comprobar si un nombre de usuario y contraseña son correctos
    function check_login_credentials($username, $password, $conn)
    {
      // Creamos la consulta para obtener el nombre de usuario y la contraseña hash de la base de datos
      $query = "SELECT username, password_hash FROM users WHERE username = '$username'";

      // Ejecutamos la consulta y guardamos el resultado
      $result = mysqli_query($conn, $query);

      // Si no se ha encontrado ningún usuario con ese nombre de usuario, devolvemos falso
      if (mysqli_num_rows($result) == 0) {
        echo "no hay coincidencias en la base de datos";
        return false;

      }

      // Si se ha encontrado el usuario, obtenemos la contraseña hash almacenada en la base de datos
      $row = mysqli_fetch_assoc($result);
      $password_hash = $row['password_hash'];

      // Comprobamos si la contraseña proporcionada coincide con la contraseña hash almacenada en la base de datos
      if (password_verify($password, $password_hash)) {

        // Si coincide, redirigimos al usuario a la página home.php
        if (isset($_COOKIE["favorite_category"])) {

          $category = $_COOKIE["favorite_category"];
          header("Location: $category.php");

        }

        header('Location: home.php');
        session_start(); // Iniciamos la sesión
    
        // Verificamos si se ha enviado el formulario de inicio de sesión
        if (isset($_POST["username"])) {

          // Guardamos el nombre de usuario en la sesión
          $_SESSION["username"] = $_POST;

        }

        $_SESSION['logueado'] = true; // Creamos una variable de sesión llamada 'logueado' y le asignamos el valor 'true'
        return true;

      } else {

        // Si no coincide, devolvemos falso
        echo "Contraseña incorrecta";
        return false;
      }
    }
    ?>
  </div>
  <h1 style="">¿No tienes cuenta?<a href="crearususario.php"> click aquí!</a></h1>




</body>

</html>