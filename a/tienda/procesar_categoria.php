<?php
if (isset($_POST["categoria"])) {
  $category = $_POST["categoria"];

  // Aquí puedes establecer la cookie con la categoría seleccionada
  setcookie("favorite_category", $category, time() + (86400 * 7), "/"); // 86400 = segundos en un día

  // Redirigimos al usuario a la página correspondiente
  header("Location: $category.php");
  exit;
}
?>