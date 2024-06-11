<?php 
if (isset($_GET["id"])) {

    $id = $_GET["id"];
    


    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "myshop";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM clients WHERE id=$id";
    $result = $connection->query($sql);
}

header("location: /myshop/index.php");
exit;

?>