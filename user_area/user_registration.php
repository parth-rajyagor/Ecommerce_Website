<?php
    include('../includes/connect.php');
    include('../functions/common_functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerece Website - User Registration Page</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .logo {
            width: 7%;
            height: 7%;
        }
    </style>

    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
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
                            <a class="nav-link" href="./user_registration.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                    <form action="../search_product.php" class="d-flex" method="get">
                        <input type="search" class="form-control me-2" placeholder="Search" aria-label="Search" name="search_data">
                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>
    </div>

    <div class="container-fluid my-5">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- name field -->
                    <div class="form-outline mb-3">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" name="user_username" id="user_username" placeholder="Enter your name" class="form-control" autocomplete="off" required="required">
                    </div>
                    
                    <!-- email field -->
                    <div class="form-outline mb-3">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="email" name="user_email" id="user_email" placeholder="Enter your email" class="form-control" autocomplete="off" required="required">
                    </div>
                    
                    <!-- image field -->
                    <div class="form-outline mb-3">
                        <label for="user_image" class="form-label">User Image</label>
                        <input type="file" name="user_image" id="user_image" class="form-control" required="required">
                    </div>
                    
                    <!-- password field -->
                    <div class="form-outline mb-3">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" name="user_password" id="user_password" placeholder="Enter Password" class="form-control" autocomplete="off" required="required">
                    </div>
                    
                    <!-- confirm password field -->
                    <div class="form-outline mb-3">
                        <label for="conf_user_password" class="form-label">Confirm Password</label>
                        <input type="password" name="conf_user_password" id="conf_user_password" placeholder="Confirm Password" class="form-control" autocomplete="off" required="required">
                    </div>
            
                    <!-- address field -->
                    <div class="form-outline mb-3">
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" name="user_address" id="user_address" placeholder="Enter your name" class="form-control" autocomplete="off" required="required">
                    </div>

                    <!-- mobile field -->
                    <div class="form-outline mb-3">
                        <label for="user_mobile" class="form-label">Mobile No</label>
                        <input type="text" name="user_mobile" id="user_mobile" placeholder="Enter your mobile no" class="form-control" autocomplete="off" required="required">
                    </div>

                    <div class="mt-2 pt-2">
                        <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_register">
                        <p class="small fw-bold mt-2 pt-2 mb-0">Already have an account? <a href="user_login.php" class=" text-danger">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
            include ("../includes/footer.php")
    ?>

</body>
</html>

<?php
    if(isset($_POST['user_register'])) {
        $user_username=$_POST['user_username'];
        $user_email=$_POST['user_email'];
        $user_password=$_POST['user_password'];
        $hash_password=password_hash($user_password, PASSWORD_DEFAULT);
        $conf_user_password=$_POST['conf_user_password'];
        $user_address=$_POST['user_address'];
        $user_mobile=$_POST['user_mobile'];
        $user_image=$_FILES['user_image']['name'];
        $user_image_tmp=$_FILES['user_image']['tmp_name'];
        $user_ip=getIPAddress();

        if($user_username=="" or $user_email=="" or $user_password=="" or $conf_user_password=="" or $user_address=="" or $user_mobile=="" or $user_image=="") {
            echo "<script>alert('Please fill all the fields !!!')</script>";
            exit();
        }
        else {
            $select_query="SELECT * FROM `user_table` WHERE username='$user_username'";
            $result_query=mysqli_query($con, $select_query);
            $row_count=mysqli_num_rows($result_query);
            if($row_count>0) {
                echo "<script>alert('This username already exists !!')</script>";
            }
            else {
                $select_query="SELECT * FROM `user_table` WHERE user_email='$user_email'";
                $result_query=mysqli_query($con, $select_query);
                $row_count=mysqli_num_rows($result_query);
                if($row_count>0) {
                    echo "<script>alert('This email already exists !!')</script>";
                }
                else {
                    $select_query="SELECT * FROM `user_table` WHERE user_mobile='$user_mobile'";
                    $result_query=mysqli_query($con, $select_query);
                    $row_count=mysqli_num_rows($result_query);
                    if($row_count>0) {
                        echo "<script>alert('This phone no already exists !!')</script>";
                    }
                    else if($user_password!=$conf_user_password) {
                        echo "<script>alert('Both passwords do not match !!')</script>";
                    }
                    else {
                        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
                        $insert_query="INSERT INTO `user_table` (username, user_email, user_password, user_image, user_ip, user_address, user_mobile, date) VALUES ('$user_username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_mobile', NOW())";
                        $result_query=mysqli_query($con, $insert_query);
                        if($result_query)  {
                            echo "<script>alert('Successfully created an account')</script>";
                            }
                        else {
                            die(mysqli_error($con));
                        }
                    }
                }
            }
        }
        // selecting cart items
        $select_cart_items="SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
        $result_cart=mysqli_query($con, $select_cart_items);
        $rows_count=mysqli_num_rows($result_cart);
        if($rows_count>0) {
            $_SESSION['username']=$user_username;
            echo "<script>alert('You have items in your cart')</script";
            echo "<script>window.open('checkout.php', '_self')</script";
        }
        else {
            echo "<script>window.open('../index.php', '_self')</script";
        }
    }
?>