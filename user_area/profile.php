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
    <title>Welcome <?php echo $_SESSION['username'] ?></title>
    <link rel="stylesheet" href="../style.css">

    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Awesome Font Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <img src="../images/logo.jpg" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">My Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item_num(); ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price: <?php total_cart_price(); ?>/-</a>
                        </li>
                    </ul>
                    <form action="../search_product.php" class="d-flex" method="get">
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
                                <a class='nav-link' href='#'>Welcome Guest</a>
                            </li>";
                    }
                    else {
                        echo " <li class='nav-item'>
                                <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
                            </li>";
                    }
                    if(!isset($_SESSION['username'])) {
                        echo " <li class='nav-item'>
                                    <a class='nav-link' href='user_login.php'>Login</a>
                                </li>";
                    }
                    else {
                        echo " <li class='nav-item'>
                                    <a class='nav-link' href='user_logout.php'>Logout</a>
                                </li>";
                    }
                ?>
            </ul>
        </nav>

        <div class="bg-light">
            <h3 class="text-center">Hidden Store</h3>
            <p class="text-center">Communication is at the heart of e-commerce and community</p>
        </div>

        <div class="row">
            <div class="col-md-2">
                <ul class="navbar-nav bg-secondary text-center" style="height:100vh">
                    <li class="nav-item bg-info">
                        <a href="profile.php" class="nav-link text-light"><h4>Your Profile</h4></a>
                    </li>
                    <?php
                        $username=$_SESSION['username'];
                        $user_image="SELECT * FROM `user_table` WHERE username='$username'";
                        $user_image=mysqli_query($con, $user_image);
                        $row_image=mysqli_fetch_array($user_image);
                        $user_image=$row_image['user_image'];
                        echo "  <li class='nav-item my-2'>
                                    <img src='./user_images/$user_image' alt='user image' class='profile_img'>
                                </li>";
                    ?>
                    <li class="nav-item">
                        <a href="profile.php" class="nav-link text-light">Pending Orders</a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php?edit_account" class="nav-link text-light">Edit Account</a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php?my_orders" class="nav-link text-light">My Orders</a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php?delete_account" class="nav-link text-light">Delete Account</a>
                    </li>
                    <li class="nav-item">
                        <a href="user_logout.php" class="nav-link text-light">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 text-center">
                <?php
                    get_user_order_details();
                    if(isset($_GET['edit_account'])) {
                        include('edit_account.php');
                    }
                    if(isset($_GET['my_orders'])) {
                        include('user_orders.php');
                    }
                    if(isset($_GET['delete_account'])) {
                        include('delete_account.php');
                    }
                ?>
            </div>
        </div>

        <?php
            include ("../includes/footer.php")
        ?>
    </div>

    <!-- Bootstrap Javascript link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>