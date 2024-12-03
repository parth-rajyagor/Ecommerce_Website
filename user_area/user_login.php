<?php
    include('../includes/connect.php');
    include('../functions/common_functions.php');
    @session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerece Website - Login Page</title>
    
    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            overflow-x:hidden;
        }
    </style>
</head>
<body>

    <div class="container-fluid my-5">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post">
                    <!-- name field -->
                    <div class="form-outline mb-3">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" name="user_username" id="user_username" placeholder="Enter your username" class="form-control" autocomplete="off" required="required">
                    </div>

                    <!-- password field -->
                    <div class="form-outline mb-3">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" name="user_password" id="user_password" placeholder="Enter Password" class="form-control" autocomplete="off" required="required">
                    </div>
                    
                    <div class="form-outline my-4">
                        <a href="forgot_password.php" class="text-info">Forgot Password</a>
                    </div>

                    <div class="mt-2 pt-2">
                        <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="user_login">
                        <p class="small fw-bold mt-2 pt-2 mb-0">Don't have an account? <a href="./user_registration.php" class=" text-danger">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>

<?php
    if(isset($_POST['user_login'])) {
        $user_username=$_POST['user_username'];
        $user_password=$_POST['user_password'];
        $select_query="SELECT * FROM `user_table` WHERE username='$user_username'";
        $result_query=mysqli_query($con, $select_query);
        $row_count=mysqli_num_rows($result_query);
        $row_data=mysqli_fetch_assoc($result_query);
        $user_ip=getIPAddress();

        // cart item
        $select_query_cart="SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
        $select_cart=mysqli_query($con, $select_query_cart);
        $row_count_cart=mysqli_num_rows($select_cart);
        if($row_count>0) {
            $_SESSION['username']=$user_username;
            if(password_verify($user_password, $row_data['user_password'])) {
                if($row_count==1 and $row_count_cart==0) {
                    $_SESSION['username']=$user_username;
                    echo "<script>alert('Login Successfull')</script>";
                    echo "<script>window.open('profile.php', '_self')</script>";
                }
                else {
                    $_SESSION['username']=$user_username;
                    echo "<script>alert('Login Successfull')</script>";
                    echo "<script>window.open('payment.php', '_self')</script>";
                }
            }
            else {
                echo "<script>alert('Invalid Password !!!')</script>";
            }
        }
        else {
            echo "<script>alert('Invalid Credentials !!!')</script>";
        }
    }
?>