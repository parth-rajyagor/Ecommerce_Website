<?php
    include('../includes/connect.php');
    include('../functions/common_functions.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- css file link -->
    <link rel="stylesheet" href="../style.css">

    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Awesome Font Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../images/logo.jpg" alt="" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <!-- <a class="nav-link" href="index.php">Welcome Guest</a> -->
                            <?php
                    if(!isset($_SESSION['username'])) {
                        echo " <li class='nav-item'>
                                <a class='nav-link' href='index.php'>Welcome Guest</a>
                            </li>";
                    }
                    else {
                        echo " <li class='nav-item'>
                                <a class='nav-link' href='index.php'>Welcome ".$_SESSION['username']."</a>
                            </li>";
                    }
                    if(!isset($_SESSION['username'])) {
                        echo " <li class='nav-item'>
                                    <a class='nav-link' href='./admin_login.php'>Login</a>
                                </li>";
                    }
                    else {
                        echo " <li class='nav-item'>
                                    <a class='nav-link' href='./admin_logout.php'>Logout</a>
                                </li>";
                    }
                ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <div class="bg-light p-2">
            <h3 class="text-center">Manage Details</h3>
        </div>

        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-4">
                    <a href="index.php"><img src="../images/pineapplejuice.jpg" class="admin_image" alt="..."></a>
                    <p class="text-light text-center"><?php echo $_SESSION['username'] ?></p>
                </div>

                <div class="button text-center px-5">
                    <button><a href="index.php?insert_products" class="nav-link bg-info text-light my-1">Insert Products</a></button>
                    <button><a href="index.php?view_products" class="nav-link bg-info text-light my-1">View Products</a></button>
                    <button><a href="index.php?insert_category" class="nav-link bg-info text-light my-1">Insert Categories</a></button>
                    <button><a href="index.php?view_categories" class="nav-link bg-info text-light my-1">View Categories</a></button>
                    <button><a href="index.php?insert_brands" class="nav-link bg-info text-light my-1">Insert Brands</a></button>
                    <button><a href="index.php?view_brands" class="nav-link bg-info text-light my-1">View Brands</a></button>
                    <button><a href="index.php?view_orders" class="nav-link bg-info text-light my-1">All Orders</a></button>
                    <button><a href="index.php?view_payments" class="nav-link bg-info text-light my-1">All Payments</a></button>
                    <button><a href="index.php?view_users" class="nav-link bg-info text-light my-1">List Users</a></button>
                </div>
            </div>
        </div>

        <div class="container my-5">
            <?php 
                if(isset($_GET['insert_products'])) {
                    include('insert_products.php');
                }
                if(isset($_GET['view_products'])) {
                    include('view_products.php');
                }
                if(isset($_GET['edit_product'])) {
                    include('edit_product.php');
                }
                if(isset($_GET['delete_product'])) {
                    include('delete_product.php');
                }
                if(isset($_GET['insert_category'])) {
                    include('insert_categories.php');
                }
                if(isset($_GET['view_categories'])) {
                    include('view_categories.php');
                }
                if(isset($_GET['edit_category'])) {
                    include('edit_category.php');
                }
                if(isset($_GET['delete_category'])) {
                    include('delete_category.php');
                }
                if(isset($_GET['insert_brands'])) {
                    include('insert_brands.php');
                }
                if(isset($_GET['view_brands'])) {
                    include('view_brands.php');
                }
                if(isset($_GET['edit_brand'])) {
                    include('edit_brand.php');
                }
                if(isset($_GET['delete_brand'])) {
                    include('delete_brand.php');
                }
                if(isset($_GET['view_orders'])) {
                    include('view_orders.php');
                }
                if(isset($_GET['delete_order'])) {
                    include('delete_order.php');
                }
                if(isset($_GET['view_payments'])) {
                    include('view_payments.php');
                }
                if(isset($_GET['delete_payment'])) {
                    include('delete_payment.php');
                }
                if(isset($_GET['view_users'])) {
                    include('view_users.php');
                }
                if(isset($_GET['delete_user'])) {
                    include('delete_user.php');
                }
            ?>
        </div>

        <?php
            include ("../includes/footer.php")
        ?>
    </div>
    
    <!-- Bootstrap Javascript link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>