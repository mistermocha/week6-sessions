<?php
$id = $_GET["id"];
setcookie("favoriteCategoryId", $id);
header("Location: /categories/");
?>
