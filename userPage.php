<?php
@include 'config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Page</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://pro.fontawesome.com/releases/v5.10.0/css/all.css'>
    <link rel="stylesheet" href="src/style/styleDashboard.css">

    <!-- for View Product -->
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="src/style/styleProducts.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2">UP</span> <span class="text-white">User Panel</span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fal fa-stream"></i></button>
            </div>

            <ul class="list-unstyled px-2">
                <li class="active" data-target="#dashboard"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-home"></i> Dashboard</a></li>
                <li class="" data-target="#viewProduct"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-box-open"></i>
                        View Product</a></li>
                <li class="" data-target="#requestProduct"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-shopping-cart"></i>
                        Request Product</a></li>

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
                        <h5 class="card-title">Welcome <strong><?php echo $_SESSION['user_name'] ?></strong> </h5>

                    </div>
                </div>

                <div class="card text-center" style="width: 100%;">
                    <div class="card-body">

                        <p class="card-text">Your Account type is: <strong>Customer</strong> </p>

                    </div>
                </div>

            </div>

            <div id="viewProduct" class="detail-content px-3 pt-4">

                <?php
                @include 'config.php';

                if (isset($_POST['add_order'])) {
                    $product_name = $_POST['product_name'];
                    $product_price = $_POST['product_price'];

                    if (empty($product_name) || empty($product_price)) {
                        $message[] = 'Please fill out all fields';
                    } else {
                        // Use prepared statements to prevent SQL injection
                        $stmt = $conn->prepare("INSERT INTO orders (product_name, product_price) SELECT name, price FROM products WHERE name = ? AND price = ?");
                        $stmt->bind_param("ss", $product_name, $product_price);

                        if ($stmt->execute()) {
                            $message[] = 'Added successfully!';
                        } else {
                            $message[] = 'Failed to add order: ' . $stmt->error;
                        }

                        $stmt->close();
                    }
                }
                ?>

                <?php
                if (isset($message)) {
                    foreach ($message as $msg) {
                        echo '<span class="messageProduct">' . htmlspecialchars($msg) . '</span>';
                    }
                }
                ?>

                <div class="containerProduct">
                    <div class="admin-product-form-container">
                        <?php
                        $select = $conn->query("SELECT * FROM products");
                        ?>
                        <div class="product-display">
                            <table class="product-display-table">
                                <thead>
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Request</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $select->fetch_assoc()) { ?>
                                        <tr>
                                            <td><img src="uploaded_img/<?php echo htmlspecialchars($row['image']); ?>" height="100" alt=""></td>
                                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                                            <td>$<?php echo htmlspecialchars($row['price']); ?>/-</td>
                                            <td>
                                                <form method="post" action="">
                                                    <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                                                    <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($row['price']); ?>">
                                                    <button type="submit" name="add_order" class="btn btn-success"><i class="fas fa-edit"></i> Order</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>






            <div id="requestProduct" class="detail-content px-3 pt-4">

                <?php
                @include 'config.php';

                // Check if the connection was successful
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Delete an order
                if (isset($_GET["delete_id"])) {
                    $id = $_GET["delete_id"];

                    // Use prepared statement to prevent SQL injection
                    $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
                    $stmt->bind_param("i", $id);

                    if ($stmt->execute()) {
                        echo '<div class="alert alert-success" role="alert">Order canceled successfully!</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Error canceling order: ' . $stmt->error . '</div>';
                    }

                    $stmt->close();
                }

                // Fetch orders from the database
                $query = "SELECT id, product_name, product_price FROM orders";
                $result = $conn->query($query);

                // Check if the query was successful
                if (!$result) {
                    die("Query failed: " . $conn->error);
                }

                if ($result->num_rows > 0) {
                ?>

                    <div class="containerProduct">
                        <div class="admin-product-form-container">
                            <div class="product-display">
                                <table class="product-display-table">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Product Price</th>
                                            <th>Requested</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                                <td>$<?php echo htmlspecialchars($row['product_price']); ?>/-</td>
                                                <td>
                                                    <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this order?');"><i class="fas fa-trash"></i> Cancel</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                <?php
                } else {
                    echo '<p>No orders found.</p>';
                }
                ?>

            </div>












        </div>
    </div>
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src="src/script/script.js"></script>

</body>

</html>