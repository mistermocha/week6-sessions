<?php
include 'header.php';

if (isset($_GET["clear"])) {
  unset($_SESSION["wishList"]);
  header("Location: /wishlist.php");
  exit();
}

if (!isset($_SESSION["wishList"])) {
  echo("<h2>Your Wish List is Empty</h2>");
  include('footer.php');
  exit();
}

$wishListMotorcycleIds = implode(", ", $_SESSION["wishList"]);

require 'config/db.php';

$db = new mysqli(
  $database_hostname,
  $database_username,
  $database_password,
  $database_db_name,
  $database_port
);
if ($db->connect_error) {
  die("Error: Could not connect to database. " . $db->connect_error);
}

$sql_motorcycles = "SELECT motorcycles.id AS id, model, year, engine_cc, engine_hp,
  manufacturers.id AS manufacturer_id, manufacturers.name AS manufacturer_name,
  categories.id AS category_id, categories.name AS category_name
  FROM motorcycles, manufacturers, categories
  WHERE motorcycles.id IN ($wishListMotorcycleIds)
  AND motorcycles.manufacturer_id = manufacturers.id
  AND motorcycles.category_id = categories.id;";

$motorcycles = $db->query($sql_motorcycles);
?>
<h2>Wish List</h2>
<p><a href="/wishlist.php?clear=true">[ clear my wish list ]</a></p>
<table id="motorcycles">
  <thead>
    <tr>
      <th><!-- thumbnail --></th>
      <th>Year</th>
      <th>Manufacturer</th>
      <th>Model</th>
      <th>Category</th>
      <th>Engine</th>
    </tr>
  </thead>
  <tbody>
<?php while ($motorcycle = $motorcycles->fetch_assoc()) {
  $id = $motorcycle['id'];
  $model = $motorcycle['model'];
  $year = $motorcycle['year'];
  $cc = $motorcycle['engine_cc'];
  $hp = $motorcycle['engine_hp'];
  $manufacturer_id = $motorcycle['manufacturer_id'];
  $manufacturer_name = $motorcycle['manufacturer_name'];
  $category_id = $motorcycle['category_id'];
  $category_name = $motorcycle['category_name'];
?>
    <tr>
      <td><a href="/motorcycles/show.php?motorcycle_id=<?= $id ?>"><img src="/assets/images/motorcycle_<?= $id ?>_thumb.jpg" alt="<?= $year ?> <?= $manufacturer_name ?> <?= $model ?>" class="thumbnail"></a></td>
      <td><?= $year ?></td>
      <td><a href="/manufacturers/show.php?id=<?= $manufacturer_id ?>"><?= $manufacturer_name ?></a></td>
      <td><a href="/motorcycles/show.php?motorcycle_id=<?= $id ?>"><?= $model ?></a></td>
      <td><a href="/categories/show.php?id=<?= $category_id ?>"><?= $category_name ?></a></td>
      <td><?= $cc ?>cc, <?= $hp ?>hp</td>
    </tr>
<?php } ?>
  </tbody>
</table>
<?php mysqli_close($db); ?>
<?php include 'footer.php'; ?>
