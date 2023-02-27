<?php

session_start(); // Iniciamos la sesión



// Si se ha enviado una solicitud para modificar la cantidad de unidades de un producto
if (isset($_GET['id']) && isset($_GET['cantidad'])) {
  // Recorre todos los productos del carrito
  foreach ($_SESSION['carrito'] as $key => $producto) {
    // Si se ha encontrado el producto a modificar, ajusta la cantidad
    if ($producto['id'] == $_GET['id']) {
      $_SESSION['carrito'][$key]['stock'] +=
        intval($_GET['cantidad']);
      break;
    }
  }
}

// Si se ha enviado una solicitud para eliminar un producto
if (isset($_GET['id']) && isset($_GET['eliminar'])) {
  // Recorre todos los productos del carrito
  foreach ($_SESSION['carrito'] as $key => $producto) {
    // Si se ha encontrado el producto a eliminar, lo elimina del carrito
    if ($producto['id'] == $_GET['id']) {
      unset($_SESSION['carrito'][$key]);
      break;
    }
  }
}

// Si no existen productos en el carrito, elimina la variable de sesión
if (empty($_SESSION['carrito'])) {
  unset($_SESSION['carrito']);
}

// Comprobamos si la variable de sesión 'logueado' existe y tiene el valor 'true'
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
  // Si no existe o no tiene el valor 'true', redirigimos al usuario a la página de inicio de sesión
  header('Location: index.php');
  exit;
}

// Si se ha enviado una solicitud para eliminar un producto
if (isset($_POST['id']) && isset($_SESSION['carrito'])) {
  // Recorre todos los productos del carrito
  foreach ($_SESSION['carrito'] as $key => $producto) {
    // Si se ha encontrado el producto a eliminar, lo elimina del carrito
    if ($producto['id'] == $_POST['id']) {
      unset($_SESSION['carrito'][$key]);
      break;
    }
  }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrito tienda gon</title>
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
          <a class="nav-link" href="index.php">Cerrar sesión</a>
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
  <?php
  if (isset($_POST['comprar'])) {
    // Conecta a la base de datos
    $conn = mysqli_connect("localhost", "root", "", "productos");

    // Selecciona el producto con el ID especificado por su tabla correspondientre
    if ($_POST['tabla'] == "carne") {
      $sql = "SELECT * FROM carne WHERE id = '" . $_POST['id'] . "'";
    } else if ($_POST['tabla'] == "pescado") {
      $sql = "SELECT * FROM pescado WHERE id = '" . $_POST['id'] . "'";
    } else if ($_POST['tabla'] == "fruta") {
      $sql = "SELECT * FROM fruta WHERE id = '" . $_POST['id'] . "'";
    }

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    // Añade el producto al carrito
    if (isset($_SESSION['carrito'])) {
      // Si ya existe un carrito, añade el producto a la lista de productos

      $_SESSION['carrito'][] = $row;
      var_dump($_SESSION['carrito']);

    } else {
      // Si no existe, crea un nuevo carrito con el producto seleccionado
      $_SESSION['carrito'] = array($row);
    }
  }
  echo "<div class='contenedor'>";
  // Inicializa el precio total a 0
  $coste_total = 0;
  $cantidad = 1;

  echo "<table>";
  echo "<tr>";
  echo "<th>categoria</th>";
  echo "<th>Nombre</th>";
  echo "<th>Precio</th>";
  echo "<th>Unidades</th>";
  echo "<th>Eliminar</th>";
  echo "</tr>";

  // Recorre todos los productos del carrito
  foreach ($_SESSION['carrito'] as $producto) {
    // Añade una fila a la tabla
    echo "<tr>";
    echo "<td>" . $producto['tabla'] . "</td>";
    echo "<td>" . $producto['nombre'] . "</td>";
    echo "<td>" . $producto['precio'] . " €</td>";
    echo "<td>" . $producto['stock'] . "</td>";


    // Añade un botón de eliminar y envía la información del producto a eliminar mediante un formulario y un campo oculto
    echo "<td>";
    echo "<form action='carrito.php' method='post'>";
    echo "<input type='hidden' name='id' value='" . $producto['id'] . "'>";
    echo "<a href='carrito.php?id=" . $producto['id'] . "&cantidad=-1'>-</a>";
    echo "<input type='submit' value='Eliminar'>";
    echo "<a href='carrito.php?id=" . $producto['id'] . "&cantidad=1'>+</a>";


    echo "</form>";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";




    // Añade el precio del producto multiplicado por la cantidad al precio total
  
    // Recorre todos los productos del carrito y calcula el coste total
    $coste_total = 0;
    foreach ($_SESSION['carrito'] as $producto) {
      $coste_total += $producto['precio'] * $producto['stock'];
    }
    $_SESSION['coste_total'] = $coste_total;
  }



  // Imprime el precio total
  echo "Precio total: " . $coste_total . " €";



  ?>

  <form action="procesar_pedido.php" method="post">
    <input type="submit" value="Comprar">
  </form>
  </div>
</body>

</html>