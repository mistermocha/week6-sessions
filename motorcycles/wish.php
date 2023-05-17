<?php
session_start();
$id = $_GET["id"];
if (isset($_SESSION["wishList"])) {
  $motorcycle_ids = $_SESSION["wishList"];
  if (!in_array($id, $motorcycle_ids)) {
    array_push($motorcycle_ids, $id);
  }
  $_SESSION["wishList"] = $motorcycle_ids;
} else {
  $_SESSION["wishList"] = [$id];
}
header("Location: /motorcycles/show.php?motorcycle_id=$id");
?>
