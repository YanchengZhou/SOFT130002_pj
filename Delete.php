<?php
require_once "connect.php";

$name = $_GET['name'];

mysqli_query($mysqli, "DELETE FROM carts
        WHERE artworkID=$name");

header("Location:Collection.php");
?>
