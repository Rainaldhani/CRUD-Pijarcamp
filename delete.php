<?php
if (isset($_GET ["id"])) {
    $id = $_GET["id"];

    $server      = "localhost";
    $user        = "root";
    $password    = "";
    $db          = "pijarcamp";

// Create Connection
$conn = new mysqli($server,$user,$password,$db);

$sql ="DELETE FROM produk WHERE id=$id";
$conn->query($sql);
}

header("location: index.php");
exit; 

?>