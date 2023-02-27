<?php

// Iniciamos la sesión
session_start();

// Comprobamos si el usuario está logueado y si hay productos en el carrito
if (isset($_SESSION['logueado']) && $_SESSION['logueado'] === true && !empty($_SESSION['carrito'])) {
  // Establecemos la conexión a la base de datos de la tienda
  $conn_tienda = mysqli_connect("localhost", "root", "", "tienda");

  // Obtenemos los datos del pedido
  $usuario = $_SESSION['nombre_usuario'];
  $num_pedido = rand(1, 1000000); // Genera un número aleatorio para el número de pedido
  $articulos = mysqli_real_escape_string($conn_tienda, serialize($_SESSION['carrito'])); // Serializa el contenido del carrito para poder guardarlo en la base de datos
  $coste_total = $_SESSION['coste_total'];

  // Creamos la consulta para insertar el pedido en la base de datos de la tienda
  $query_tienda = "INSERT INTO carrito (usuario, num_pedido, articulos, coste_total) VALUES ('$usuario', $num_pedido, '$articulos', $coste_total)";
  mysqli_query($conn_tienda, $query_tienda);

  // Establecemos la conexión a la base de datos de productos
  $conn_productos = mysqli_connect("localhost", "root", "", "productos");

  // Comprobamos si se ha establecido la conexión a la base de datos de productos
  if (!$conn_productos) {
    die("Conexión fallida: " . mysqli_connect_error());
  }

  // Creamos las consultas múltiples para actualizar el stock de varios productos al mismo tiempo en cada una de las tablas de la base de datos de productos
  $query_carne = "";
  $query_pescado = "";
  $query_fruta = "";



  foreach ($_SESSION['carrito'] as $producto) {
    if ($producto['stock'] < $cantidad) {
      // Mostrar mensaje de error al usuario

      echo '<p>No hay suficiente stock disponible para el producto ' . $producto['nombre'] . '. Por favor, reduzca la cantidad de unidades en el carrito.</p>';
    } else {

      $categoria = $producto['tabla'];
      $id = $producto['id'];
      $cantidad = $producto['stock'];
      if ($categoria === 'carne') {
        $query_carne = "UPDATE carne SET stock = stock - $cantidad WHERE id = $id";
      } elseif ($categoria === 'pescado') {
        $query_pescado = "UPDATE pescado SET stock = stock - $cantidad WHERE id = $id";
      } elseif ($categoria === 'fruta') {
        $query_fruta = "UPDATE fruta SET stock = stock - $cantidad WHERE id = $id";
      }
    }
  }


  // Establecemos la conexión a la base de datos de productos
  $conn_productos = mysqli_connect("localhost", "root", "", "productos");

  // Ejecutamos las consultas múltiples


  if ($query_carne !== "") {
    mysqli_query($conn_productos, $query_carne);

  }

  if ($query_pescado !== "") {
    mysqli_query($conn_productos, $query_pescado);

  }

  if ($query_fruta !== "") {
    mysqli_query($conn_productos, $query_fruta);

  }
  


  // Cerramos la conexión a la base de datos de productos
  mysqli_close($conn_productos);

  // Eliminamos el contenido del carrito de la sesión
  unset($_SESSION['carrito']);
  //
  // Redirigimos al usuario a la página de gracias
  header('Location: gracias.php');
  exit;
}

?>