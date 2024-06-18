<?php 
@include 'config.php';

session_start();

if(!isset($_SESSION['driver_name'])){
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
                <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2">DP</span> <span class="text-white">Driver Panel</span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fal fa-stream"></i></button>
            </div>

            <ul class="list-unstyled px-2">
                <li class="active" data-target="#dashboard"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-home"></i> Dashboard</a></li>
                <li class="" data-target="#acceptOrder"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-box-open"></i>
                        Accept Order</a></li>

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
                        <h5 class="card-title">Welcome <strong><?php echo $_SESSION['driver_name'] ?></strong> </h5>

                    </div>
                </div>

                <div class="card text-center" style="width: 100%;">
                    <div class="card-body">

                        <p class="card-text">Your Account type is: <strong>Driver</strong> </p>

                    </div>
                </div>

            </div>

           





           












        </div>
    </div>
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src="src/script/script.js"></script>

</body>

</html>