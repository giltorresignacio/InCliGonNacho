<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crea tu usuario</title>
  <link href="estilos.css" rel="stylesheet" type="text/css">
</head>

<body>
  <div class="formulario">
    <!-- Formulario para ingresar el nombre de usuario y la contraseña -->
    <form action="crearususario.php" method="post">
      <label for="username">Nombre de usuario:</label>
      <input type="text" name="username" required>
      <br>
      <label for="password">Contraseña:</label>
      <input type="password" name="password" required>
      <br>
      <label for="email">Email:</label>
      <input type="email" name="email" required>
      <br>
      <input type="submit" name="create" value="Crear cuenta">
    </form>

    <h3>¿Ya tienes cuenta?<a href="index.php"> Inicia sesión!</a></h3>
  </div>


  <?php

  // Conectamos a la base de datos
  $conn = mysqli_connect('localhost', 'root', '', 'tienda');

  // Comprobamos si se ha enviado el formulario
  if (isset($_POST['create'])) {
    // Si se ha enviado, obtenemos los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Hash de la contraseña
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Creamos la consulta para insertar el nuevo usuario en la base de datos
    $query = "INSERT INTO users (username, password_hash, email) VALUES ('$username', '$password_hash', '$email')";
    // Abrimos el archivo en modo escritura
    $file = fopen('users.txt', 'a');

    // Escribimos los datos del nuevo usuario en el archivo
    fwrite($file, $username . ',' . $password_hash . ',' . $email . "\n");

    // Cerramos el archivo
    fclose($file);
    // Ejecutamos la consulta
    mysqli_query($conn, $query);
  }

  ?>

  </form>
</body>

</html>