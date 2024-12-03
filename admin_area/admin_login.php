<?php
    include('../includes/connect.php');
    @session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- css file link -->
    <link rel="stylesheet" href="../style.css">

    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Awesome Font Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid m-5">
        <h2 class="text-center mb-5">Admin Login</h2>
    </div>
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-lg-6 col-xl-5">
            <img src="./admin_images/login-img.jpg" alt="admin_login_image" class="img-fluid">
        </div>
        <div class="col-lg-6 col-xl-4">
            <form action="" method="post">
                <div class="form-outline mb-4">
                    <label for="admin_username" class="form-label">Username</label>
                    <input type="text" name="admin_username" id="admin_username" placeholder="Enter username" required="required" class="form-control w-80" autocomplete="off">
                </div>
                <div class="form-outline mb-4">
                    <label for="admin_password" class="form-label">Password</label>
                    <input type="password" name="admin_password" id="admin_password" placeholder="Enter password" required="required" class="form-control w-80">
                </div>
                <div class="form-outline mb-4">
                    <input type="submit" value="Login" class="bg-info border-0 py-2 px-3" name="admin_login">
                    <p class="small fw-bold mt-2">Don't have an account ? <a href="admin_registration.php" class="text-danger text-decoration-none">Register</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap Javascript link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>

<?php
    if(isset($_POST['admin_login'])) {
        $admin_username=$_POST['admin_username'];
        $admin_password=$_POST['admin_password'];
        $select_query="SELECT * FROM `admin_table` WHERE admin_username='$admin_username'";
        $result_query=mysqli_query($con, $select_query);
        $row_count=mysqli_num_rows($result_query);
        $row_data=mysqli_fetch_assoc($result_query);
        if($row_count>0) {
            $_SESSION['username']=$admin_username;
            if(password_verify($admin_password, $row_data['admin_password'])) {
                if($row_count==1) {
                    $_SESSION['username']=$admin_username;
                    echo "<script>alert('Login Successfull')</script>";
                    echo "<script>window.open('index.php', '_self')</script>";
                }
                else {
                    echo "<script>alert('Invalid Password !!!')</script>";
                }
            }
            else {
                echo "<script>alert('Invalid Credentials !!!')</script>";
            }
        }
    }
?>