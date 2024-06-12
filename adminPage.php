<?php
@include 'config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://pro.fontawesome.com/releases/v5.10.0/css/all.css'>
    <link rel="stylesheet" href="src/style/styleDashboard.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2">AP</span> <span class="text-white">Admin Panel</span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fal fa-stream"></i></button>
            </div>

            <ul class="list-unstyled px-2">
                <li class="active" data-target="#dashboard"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-home"></i> Dashboard</a></li>
                <li class="" data-target="#users"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-users"></i>
                        users</a></li>
                <li class="" data-target="#drivers"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-list"></i>
                        Drivers</a></li>
                <li class="" data-target="#product"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-envelope-open-text"></i> Products</a></li>

            </ul>

        </div>
        <div class="content">
            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2"><i class="fal fa-stream"></i></button>
                        <a class="navbar-brand fs-4" href="#"><span class="bg-dark rounded px-2 py-0 text-white">CL</span></a>

                    </div>
                    <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fal fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="btn btn-danger" aria-current="page" href="logout.php">logout</a>
                            </li>

                        </ul>

                    </div>
                </div>
            </nav>

            <div id="dashboard" class="detail-content active px-3 pt-4">
                <div class="card text-center" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Welcome <strong><?php echo $_SESSION['admin_name'] ?></strong> </h5>

                    </div>
                </div>

                <div class="card text-center" style="width: 100%;">
                    <div class="card-body">

                        <p class="card-text">Your Account type is: <strong>Administrator</strong> </p>

                    </div>
                </div>

            </div>

            <div id="users" class="detail-content px-3 pt-4">

                <div class="container my-5">
                    <h2>List of Users</h2>
                    <a class="btn btn-success" href="crudFiles/create.php" role="button">New User</a>
                    <br>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="userTable">
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $database = "user_db";

                            // Create connection
                            $connection = new mysqli($servername, $username, $password, $database);

                            // Check connection
                            if ($connection->connect_error) {
                                die("Connection failed: " . $connection->connect_error);
                            }

                            // SQL query to select user details filtered by user_type
                            $sql = "SELECT id, name, email, user_type FROM user_form WHERE user_type = 'user'";
                            $result = $connection->query($sql);

                            // Check if there are results
                            if ($result->num_rows > 0) {
                                // Read data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "
                <tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["user_type"] . "</td>
                    <td>
                        <a class='btn btn-success btn-sm' href='crudFiles/edit.php?id=" . $row["id"] . "' role='button'>Edit</a>
                        <a class='btn btn-danger btn-sm' role='button' onclick='deleteUser({$row["id"]})'>Delete</a>
                    </td>
                </tr>
                ";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No users found</td></tr>";
                            }

                            // Close connection
                            $connection->close();
                            ?>
                        </tbody>
                    </table>

                    <script>
                        function deleteUser(id) {
                            if (confirm('Are you sure you want to delete this user?')) {
                                const xhr = new XMLHttpRequest();
                                xhr.open('GET', `crudFiles/delete.php?id=${id}`, true);
                                xhr.onload = function() {
                                    if (xhr.status === 200 && xhr.responseText.trim() === "success") {
                                        const row = document.getElementById(`row-${id}`);
                                        if (row) {
                                            row.parentNode.removeChild(row);
                                        }
                                    } else {
                                        alert('Error deleting user');
                                    }
                                };
                                xhr.send();
                            }
                        }
                    </script>


                </div>

            </div>

            <div id="drivers" class="detail-content px-3 pt-4">

                <div class="container my-5">
                    <h2>List of Drivers</h2>
                    <a class="btn btn-success" href="crudFiles/createForDriver.php" role="button">New Driver</a>
                    <br>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="userTable">
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $database = "user_db";

                            // Create connection
                            $connection = new mysqli($servername, $username, $password, $database);

                            // Check connection
                            if ($connection->connect_error) {
                                die("Connection failed: " . $connection->connect_error);
                            }

                            // SQL query to select user details filtered by user_type
                            $sql = "SELECT id, name, email, user_type FROM user_form WHERE user_type = 'driver'";
                            $result = $connection->query($sql);

                            // Check if there are results
                            if ($result->num_rows > 0) {
                                // Read data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "
                <tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["user_type"] . "</td>
                    <td>
                        <a class='btn btn-success btn-sm' href='crudFiles/edit.php?id=" . $row["id"] . "' role='button'>Edit</a>
                        <a class='btn btn-danger btn-sm' role='button' onclick='deleteUser({$row["id"]})'>Delete</a>
                    </td>
                </tr>
                ";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No users found</td></tr>";
                            }

                            // Close connection
                            $connection->close();
                            ?>
                        </tbody>
                    </table>

                    <script>
                        function deleteUser(id) {
                            if (confirm('Are you sure you want to delete this driver?')) {
                                const xhr = new XMLHttpRequest();
                                xhr.open('GET', `crudFiles/delete.php?id=${id}`, true);
                                xhr.onload = function() {
                                    if (xhr.status === 200 && xhr.responseText.trim() === "success") {
                                        const row = document.getElementById(`row-${id}`);
                                        if (row) {
                                            row.parentNode.removeChild(row);
                                        }
                                    } else {
                                        alert('Error deleting driver');
                                    }
                                };
                                xhr.send();
                            }
                        }
                    </script>


                </div>

            </div>

            <div id="product" class="detail-content px-3 pt-4">

            <?php

@include 'configProduct.php';

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO products(name, price, image) VALUES('$product_name', '$product_price', '$product_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM products WHERE id = $id");
   header('location:admin_page.php');
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="src/style/styleProducts.css">

</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="messageProduct">'.$message.'</span>';
   }
}

?>
   
<div class="containerProduct">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new product</h3>
         <input type="text" placeholder="enter product name" name="product_name" class="boxProduct">
         <input type="number" placeholder="enter product price" name="product_price" class="boxProduct">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="boxProduct">
         <input type="submit" class="btnProduct" name="add_product" value="add product">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM products");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>product image</th>
            <th>product name</th>
            <th>product price</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td>$<?php echo $row['price']; ?>/-</td>
            <td>
               <a href="crudFiles/forProduct/updateProduct.php?edit=<?php echo $row['id']; ?>" class="btnProduct"> <i class="fas fa-edit"></i> edit </a>
               <a href="adminPage.php?delete=<?php echo $row['id']; ?>" class="btnProduct"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>


</body>
</html>

            </div>

        </div>
    </div>
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src="src/script/script.js"></script>

</body>

</html>