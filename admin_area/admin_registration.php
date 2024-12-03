<?php
    include('../includes/connect.php');
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <!-- css file link -->
    <link rel="stylesheet" href="../style.css">

    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Awesome Font Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <div class="container-fluid m-5">
        <h2 class="text-center mb-5">Admin Registration</h2>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6 col-xl-5">
            <img src="./admin_images/admin-and-teacher-conversation-free-vector.jpg" alt="admin_registration_image" class="img-fluid">
        </div>
        <div class="col-lg-6 col-xl-4">
            <form action="" method="post">
                <div class="form-outline mb-4">
                    <label for="admin_username" class="form-label">Username</label>
                    <input type="text" name="admin_username" id="admin_username" placeholder="Enter username" required="required" class="form-control w-80" autocomplete="off">
                </div>
                <div class="form-outline mb-4">
                    <label for="admin_email" class="form-label">Email</label>
                    <input type="email" name="admin_email" id="admin_email" placeholder="Enter email" required="required" class="form-control w-80" autocomplete="off">
                </div>
                <div class="form-outline mb-4">
                    <label for="admin_password" class="form-label">Password</label>
                    <input type="password" name="admin_password" id="admin_password" placeholder="Enter password" required="required" class="form-control w-80" autocomplete="off">
                </div>
                <div class="form-outline mb-4">
                    <label for="conf_admin_password" class="form-label">Confirm Password</label>
                    <input type="text" name="conf_admin_password" id="conf_admin_password" placeholder="Re-enter password" required="required" class="form-control w-80" autocomplete="off">
                </div>
                <div class="form-outline mb-4">
                    <input type="submit" value="Register" class="bg-info border-0 py-2 px-3" name="admin_register">
                    <p class="small fw-bold mt-2">Already have an account ? <a href="admin_login.php" class="text-danger text-decoration-none">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap Javascript link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>

<?php
    if(isset($_POST['admin_register'])) {
        $admin_username=$_POST['admin_username'];
        $admin_email=$_POST['admin_email'];
        $admin_password=$_POST['admin_password'];
        $hash_password=password_hash($admin_password, PASSWORD_DEFAULT);
        $conf_admin_password=$_POST['conf_admin_password'];
        if($admin_username=="" or $admin_email=="" or $admin_password=="" or $conf_admin_password=="") {
            echo "<script>alert('Please fill all the fields !!!')</script>";
            exit();
        }
        else {
            $select_query="SELECT * FROM `admin_table` WHERE admin_username='$admin_username'";
            $result_query=mysqli_query($con, $select_query);
            $row_count=mysqli_num_rows($result_query);
            if($row_count>0) {
                echo "<script>alert('This username already exists !!')</script>";
            }
            else {
                $select_query="SELECT * FROM `admin_table` WHERE admin_email='$admin_email'";
                $result_query=mysqli_query($con, $select_query);
                $row_count=mysqli_num_rows($result_query);
                if($row_count>0) {
                    echo "<script>alert('This email already exists !!')</script>";
                }
                else if($admin_password!=$conf_admin_password) {
                    echo "<script>alert('Both passwords do not match !!')</script>";
                }
                else {
                    $insert_query="INSERT INTO `admin_table` (admin_username, admin_email, admin_password, date) VALUES ('$admin_username', '$admin_email', '$hash_password', NOW())";
                    $result_query=mysqli_query($con, $insert_query);
                    if($result_query)  {
                        echo "<script>alert('Successfully created an admin account')</script>";
                        }
                    else {
                            die(mysqli_error($con));
                    }
                }
            }
        }            
    }
?>