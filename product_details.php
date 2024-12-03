<?php
    include('./includes/connect.php');
    include('./functions/common_functions.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website</title>
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Awesome Font Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <img src="./images/logo.jpg" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <?php 
                            if(isset($_SESSION['username'])) {
                                echo " <li class='nav-item'>
                                        <a class='nav-link' href='./user_area/profile.php'>My Account</a>
                                    </li>";
                            }
                            else {
                                echo "<li class='nav-item'>
                                        <a class='nav-link' href='./user_area/user_registration.php'>Register</a>
                                    </li>";
                            }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item_num(); ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price: <?php total_cart_price(); ?>/-</a>
                        </li>
                    </ul>
                    <form action="search_product.php" class="d-flex" method="get">
                        <input type="search" class="form-control me-2" placeholder="Search" aria-label="Search" name="search_data">
                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>

        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
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
                                    <a class='nav-link' href='./user_area/user_login.php'>Login</a>
                                </li>";
                    }
                    else {
                        echo " <li class='nav-item'>
                                    <a class='nav-link' href='./user_area/user_logout.php'>Logout</a>
                                </li>";
                    }
                ?>
            </ul>
        </nav>

        <div class="bg-light">
            <h3 class="text-center">Hidden Store</h3>
            <p class="text-center">Communication is at the heart of e-commerce and community</p>
        </div>

        <div class="row px-3">
            <div class="col-md-10">
                <div class="row">
                    <!-- fetching products -->
                    <?php
                        view_details();
                        get_unique_categories();
                        get_unique_brands();
                        cart();
                    ?>
                </div>
            </div>

            <div class="col-md-2 bg-secondary p-0">
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light"><h4>Delivery Brands</h4></a>
                    </li>
                    <?php
                        getbrands();
                    ?>
                    
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light"><h4>Categories</h4></a>
                    </li>
                    <?php
                        getcategories();
                    ?>
                </ul>
            </div>
        </div>

        <?php
            include ("./includes/footer.php")
        ?>
    </div>


    <!-- Bootstrap Javascript link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>