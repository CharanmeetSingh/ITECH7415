<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try  {
    $connection = new PDO($dsn, $username, $password, $options);
    
    $new_user = array(
      "image" => $_POST['file'],
      "item" => $_POST['item'],
      "icode" => $_POST['icode'],
      "createdate"  => $_POST['createdate'],
      "expirydate"     => $_POST['expirydate'],
      "category"  => $_POST['category'],
      "ccode"  => $_POST['ccode'],
      "price"  => $_POST['price'],
      "quantity"  => $_POST['quantity']
    );

    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "item",
      implode(", ", array_keys($new_user)),
      ":" . implode(", :", array_keys($new_user))
    );
    
    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

  <?php if (isset($_POST['submit']) && $statement) : ?>
    <blockquote><?php echo escape($_POST['item']); ?> successfully added.</blockquote>
  <?php endif; ?>
<body >
  <h2 class="container">Add an item</h2>

  <form class="container" method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <label for="file">Image</label><br>
    <input type="file" name="file" id="file"><br>
    <label for="item">Item Name</label><br>
    <input type="text" name="item" id="item"><br>
    <label for="icode">Item code</label><br>
    <input type="text" name="icode" id="icode"><br>
    <label for="createdate">Create Date</label><br>
    <input type="text" name="createdate" id="createdate"><br>
    <label for="expirydate">Expiry Date</label><br>
    <input type="text" name="expirydate" id="expirydate"><br>
    <label for="category">Category</label><br>
    <input type="text" name="category" id="category"><br>
    <label for="ccode">Category code</label><br>
    <input type="text" name="ccode" id="ccode"><br>
    <label for="price">Price</label><br>
    <input type="text" name="price" id="price"><br>
    <label for="quantity">Quantity</label><br>
    <input type="text" name="quantity" id="quantity"><br>
    <input type="submit" name="submit" value="Submit"><br>
  

  <a href="index.php">Back to home</a>
  </form>
<?php require "templates/footer.php"; ?>
