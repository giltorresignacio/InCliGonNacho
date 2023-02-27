<?php
session_start(); // Iniciamos la sesión

// Comprobamos si la variable de sesión 'logueado' existe y tiene el valor 'true'
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
  // Si no existe o no tiene el valor 'true', redirigimos al usuario a la página de inicio de sesión
  header('Location: index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>frutas tienda gon</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="estilos.css" rel="stylesheet" type="text/css">
</head>

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
          <a class="nav-link" href="cerrarSesion.php">Cerrar sesión</a>
        </li>
        <li>
          <form action="carrito.php">
            <button type="submit">
              <img src="https://cdn-icons-png.flaticon.com/512/3394/3394009.png" alt="Ir al carrito"
                style="height: 30px;">
            </button>
          </form>
        </li>
      </ul>
    </div>
  </nav>

  <?php
  // Carga el archivo XML
  $xml = simplexml_load_file("products.xml");

  // Si se ha enviado el formulario
  if (isset($_POST["categoria"])) {
    // Recorre cada elemento "categoria" del archivo XML
    foreach ($xml->categoria as $categoria) {
      // Si se ha seleccionado la categoría actual, redirige a la página correspondiente
      if ($_POST["categoria"] == $categoria->nombre) {
        header("Location: {$categoria->enlace}");
      }
    }
  }
  ?>

  <!-- Crea el formulario para elegir la categoría -->
  <form action="" method="post">
    <label for="categoria">Elige una categoría:</label>
    <select name="categoria" id="categoria">
      <!-- Recorre cada elemento "categoria" del archivo XML y crea una opción para cada una -->
      <?php foreach ($xml->categoria as $categoria) { ?>
        <option value="<?php echo $categoria->nombre; ?>">
          <?php echo $categoria->nombre; ?>
        </option>
      <?php } ?>
    </select>
    <input type="submit" value="Enviar">
  </form>

  <div class="contenedor">
    <?php

    // Conecta a la base de datos
    $conn = mysqli_connect("localhost", "root", "", "productos");

    // Selecciona todos los registros de la tabla "fruta"
    $result = mysqli_query($conn, "SELECT * FROM fruta");

    // Imprime el código HTML de la tabla
    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nombre</th>";
    echo "<th>Descripción</th>";
    echo "<th>Número de unidades</th>";
    echo "<th>Origen</th>";
    echo "<th>Variedad</th>";
    echo "<th>Stock</th>";
    echo "<th>Precio</th>";
    echo "<th>Acciones</th>";
    echo "</tr>";

    // Recorre los registros de la tabla "frutas"
    while ($row = mysqli_fetch_assoc($result)) {

      // Imprime el código HTML de una fila por cada registro
      echo "<tr>";
      echo "<td>" . $row["id"] . "</td>";
      echo "<td>" . $row["nombre"] . "</td>";
      echo "<td>" . $row["descripcion"] . "</td>";
      echo "<td>" . $row["numero_unidades"] . "</td>";
      echo "<td>" . $row["origen"] . "</td>";
      echo "<td>" . $row["variedad"] . "</td>";
      echo "<td>" . $row["stock"] . "</td>";
      echo "<td>" . $row["precio"] . "€</td>";
      echo "<td>";

      // Imprime un botón de "Comprar" por cada producto
    

      echo "<form action='carrito.php' method='post'>";
      $tabla = 'fruta';
      echo "<input type='hidden' name='tabla' value='" . $tabla . "'>";
      echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
      echo "<input type='hidden' name='cantidad' value='1'>";
      echo "<input type='submit' value='Comprar' name='comprar'>";
      echo "</form>";


    }

    // Cierra la tabla
    echo "</table>";

    // Cierra la conexión a la base de datos
    mysqli_close($conn);
    ?>
  </div>
</body>

</html>