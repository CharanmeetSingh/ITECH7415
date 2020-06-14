<?php
/**
 * Function to query information based on 
 * a parameter: in this case, location.
 *
 */

require "../config.php";
require "../common.php";

$upload_dir = 'images/';

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try  {
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * 
            FROM item
            WHERE category = :category";

    $category = $_POST['category'];
    $statement = $connection->prepare($sql);
    $statement->bindParam(':category', $category, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>
        
<?php  
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>
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

    <table class="center" >
      <thead>
        <tr>
          <th>#</th>
          <th>Image</th>
          <th>Item Name</th>
          <th>Item code</th>
          <th>Create Date</th>
          <th>Expiry Date</th>
          <th>Category</th>
          <th>Category code</th>
          <th>Price</th>
          <th>Quantity</th>
          
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
          <td><?php echo $row["price"]; ?></td>
          <td><?php echo escape($row["quantity"]); ?></td>
          <!-- <td><?php echo escape($row["date"]); ?> </td> -->
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php } else { ?>
      <blockquote>No results found for <?php echo escape($_POST['category']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>Find item based on category</h2>

<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <label for="category">Category</label>
  <input type="text" id="category" name="category">
  <input type="submit" name="submit" value="View Results">
</form><br>

<a class="center" href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>