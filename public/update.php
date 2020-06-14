<?php

/**
 * List all users with a link to edit
 */

require "../config.php";
require "../common.php";
$upload_dir = 'images/';

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
<?php require "templates/header.php"; ?>
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
        
<h2>All Item List</h2>

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
            <th>Category code</th>
            <th>Price</th>
            <th>Quantity</th>
            <!-- <th>Date</th> -->
            <th>Edit</th>
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
            <td><?php echo escape($row["price"]); ?></td>
            <td><?php echo escape($row["quantity"]); ?></td>
            <!-- <td><?php echo escape($row["date"]); ?> </td> -->
            <td><a href="update-single.php?id=<?php echo escape($row["id"]); ?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<br>

<a class=center href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>