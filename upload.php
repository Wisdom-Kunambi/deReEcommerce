<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $target_dir = 'uploads/';
    $target_file = $target_dir . basename($_FILES['test_file']['name']);
    
    if ($_FILES['test_file']['error'] !== UPLOAD_ERR_OK) {
        echo "File upload error: " . $_FILES['test_file']['error'];
    } else {
        if (move_uploaded_file($_FILES['test_file']['tmp_name'], $target_file)) {
            echo "The file ". basename($_FILES['test_file']['name']). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
?>
