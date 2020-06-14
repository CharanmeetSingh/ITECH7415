<?php

/**
 * Delete a user
 */

require "../config.php";
require "../common.php";
$upload_dir = 'images/';
$success = null;

if (isset($_POST["submit"])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try {
    $connection = new PDO($dsn, $username, $password, $options);
  
    $id = $_POST["submit"];

    $sql = "DELETE FROM item WHERE id = :id";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $success = "User successfully deleted";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM item";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<style>
table {
  border: 1px solid black;
  padding: 15px;
  text-align: center;
  background-color:#FFFACD
}
td {
  border: 1px solid black;
  height: 50px;
  vertical-align: bottom;
}
tr{
  background-color:white
}
th{
  background-color:Orange
}

.center {
  margin: auto;
  width: 60%;
  border: 3px solid ;
  padding: 10px;
}
</style>
<?php require "templates/header.php"; ?>
        
<h2>Delete Item</h2>

<?php if ($success) echo $success; ?>

<form  method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <table class="center">
    <thead>
      <tr>
        <th>#</th>
        <th>Image</th>
        <th>Item Name</th>
        <th>Item Code</th>
        <th>Create Date</th>
        <th>Expiry Date</th>
        <th>Category</th>
        <th>Category Code</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["id"]); ?></td>
        <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="100px" width="100px"></td>
        <td><?php echo escape($row["item"]); ?></td>
        <td><?php echo escape($row["icode"]); ?></td>
        <td><?php echo escape($row["createdate"]); ?></td>
        <td><?php echo escape($row["expirydate"]); ?></td>
        <td><?php echo escape($row["category"]); ?></td>
        <td><?php echo escape($row["ccode"]); ?></td>
        <td><?php echo escape($row["price"]); ?> </td>
        <td><?php echo escape($row["quantity"]); ?></td>
        <td><button type="submit" name="submit" value="<?php echo escape($row["id"]); ?>">Delete</button></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</form>

<a class="center" href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>