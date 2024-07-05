<?php

                @include 'configProduct.php';
                    // echo "<pre>". print_r($_POST, true). "</pre>";
                    // echo "<pre>". print_r($_FILES, true). "</pre>";
                    // exit;
                if (isset($_POST['add_product'])) {

                    $product_name = $_POST['product_name'];
                    $product_price = $_POST['product_price'];
                    $product_image = $_FILES['product_image']['name'];
                    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
                    $product_image_folder = 'uploads/' . $product_image;

                    $save_file = move_uploaded_file($product_image_tmp_name, $product_image_folder);

                    if ($upload) {
                        move_uploaded_file($product_image_tmp_name, $product_image_folder);
                        $message[] = 'new product added successfully';
                    } else {
                        $message[] = 'could not add the product';
                    }

                    exit;

                    if (empty($product_name) || empty($product_price) || empty($product_image)) {
                        $message[] = 'please fill out all';
                    } else {
                        $insert = "INSERT INTO products(name, price, image) VALUES('$product_name', '$product_price', '$product_image')";
                        $upload = mysqli_query($conn, $insert);
                        // if ($upload) {
                        //     move_uploaded_file($product_image_tmp_name, $product_image_folder);
                        //     $message[] = 'new product added successfully';
                        // } else {
                        //     $message[] = 'could not add the product';
                        // }
                    }
                };

                if (isset($_GET['delete'])) {
                    $id = $_GET['delete'];
                    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
                    header('location:admin_page.php');
                };

                ?>