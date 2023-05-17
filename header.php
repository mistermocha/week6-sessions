<?php
session_start();
if (isset($_SESSION["wishList"])) {
  $wishListLength = count($_SESSION["wishList"]);
} else {
  $wishListLength = 0;
}

$numberOfItemsInCart = 'TODO';

?>
<!DOCTYPE html>
<html lang="en-us">
<head>
  <title>Motorcycle Mania</title>
  <link rel="stylesheet" type="text/css" media="all" href="/assets/stylesheets/main.css">
  <style>
  </style>
  <script src="/assets/javascript/main.js"></script>
</head>
<body>
  <header>
    <h1><a href="/">Motorcycle Mania!</a></h1>
    <nav>
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/categories">Categories</a></li>
        <li><a href="/manufacturers">Manufacturers</a></li>
      </ul>
      <a class="lnk_right" href="/cart.php">Cart (<?= $numberOfItemsInCart ?>)</a>
      <a class="lnk_right" href="/wishlist.php">Wish List (<?= $wishListLength ?>)</a>
      <a class="lnk_right" href="/motorcycles/new.php">+ Add a Bike</a>
    </nav>
  </header>
  <main>
