<?php 
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "user_db";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $sql = "DELETE FROM user_form WHERE id=$id";
    if ($connection->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error deleting user: " . $connection->error;
    }
}
?>
