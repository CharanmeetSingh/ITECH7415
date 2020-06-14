<?php
    session_start();
    if(!isset($_SESSION["username"])) {
        header("Location: ../Login/login.php");
        exit();
    }
?>

<?php include "templates/header.php"; ?>

<button type="button"><a href="registration.php">Add Admin</a></button>
<body class="bg-img" >
	<h1 style="text-align:center" >Welcome Page</h1>

<h1 align="center">
	<button type="button"><a href="create.php"><strong>Create Item</strong></a></button>
	<button type="button"><a href="read.php"><strong>Read Item</strong></a></button>
	<button type="button"><a href="update.php"><strong>Update Item</strong></a></button>
	<button type="button"><a href="delete.php"><strong>Delete Item</strong></a></button>
</h1>
<h1 align="right">
<button  type="button"><a href="scan.php"><strong>Scanner</strong></a></button>
</h1>
<?php include "templates/footer.php"; ?>
