<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home tienda gon</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<?php
session_start(); // Iniciamos la sesión

// Comprobamos si la variable de sesión 'logueado' existe y tiene el valor 'true'
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
  // Si no existe o no tiene el valor 'true', redirigimos al usuario a la página de inicio de sesión
  header('Location: index.php');
  exit;

} else if (isset($_SESSION["username"])) {
  // Verificamos si existe una cookie con la categoría favorita
  if (isset($_COOKIE["favorite_category"])) {

    $category = $_COOKIE["favorite_category"];
    // Redirigimos al usuario a la página correspondiente
    header("Location: $category.php");
    exit;

  }
}
?>

<body class="cuerpo">

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">super Gonmarket</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Cerrar sesión</a>
        </li>
        <li class="nav-item">
          <form action="carrito.php">
            <button type="submit">
              <img
                src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.freepik.es%2Ficonos-gratis%2Fcarrito-compras_886348.htm&psig=AOvVaw3kdpGCbc8y7AQAWLXvFw08&ust=1673001537506000&source=images&cd=vfe&ved=0CA8QjRxqFwoTCPjlnMSesPwCFQAAAAAdAAAAABAEg"
                alt="Ir al carrito">
            </button>
          </form>
        </li>

      </ul>
    </div>
  </nav>


  <br><br><br><br>

  <!-- Mostrar una lista desplegable para elegir la categoría favorita -->
  <form action="procesar_categoria.php" method="post">
    <label for="categoria">Elige tu categoría favorita:</label><br>
    <select name="categoria" id="categoria">
      <option value="carnes">Carnes</option>
      <option value="pescados">Pescados</option>
      <option value="frutas">Frutas</option>
    </select><br>
    <input type="submit" value="Enviar">
  </form>





</body>

</html>