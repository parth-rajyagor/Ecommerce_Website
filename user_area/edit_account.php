<?php
    if(isset($_GET['edit_account'])) {
        $user_session_name=$_SESSION['username'];
        $select_query="SELECT * FROM `user_table` WHERE username='$user_session_name'";
        $result_query=mysqli_query($con, $select_query);
        $row_fetch=mysqli_fetch_assoc($result_query);
        $user_id=$row_fetch['user_id'];
        $username=$row_fetch['username'];
        $user_email=$row_fetch['user_email'];
        $user_address=$row_fetch['user_address'];
        $user_mobile=$row_fetch['user_mobile'];
    }
    if(isset($_POST['user_update'])) {
        $update_id=$user_id;
        $username=$_POST['user_username'];
        $user_email=$_POST['user_email'];
        $user_address=$_POST['user_address'];
        $user_mobile=$_POST['user_mobile'];

        // update query
        $update_data="UPDATE `user_table` SET username='$username', user_email='$user_email', user_address='$user_address', user_mobile='$user_mobile' WHERE user_id=$update_id";
        $result_update_query=mysqli_query($con, $update_data);
        if($result_update_query) {
            echo "<script>alert('Data updated successfully')</script>";
            echo "<script>window.open('user_logout.php', '_self')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
        <h3 class="text-success mb-4">Edit Account</h3>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-2">
                <input type="text" name="user_username" class="form-control mb-4 w-50 m-auto" value="<?php echo $username?>">
            </div>
            <div class="form-outline mb-2">
                <input type="email" name="user_email" class="form-control mb-4 w-50 m-auto" value="<?php echo $user_email?>">
            </div>
            <div class="form-outline mb-2 d-flex w-50 m-auto">
                <input type="file" name="user_image" class="form-control m-auto">
                <img src="./user_images/<?php echo $user_image ?>" alt="user_image" class="edit_img">
            </div>
            <div class="form-outline mb-2">
                <input type="text" name="user_address" class="form-control mb-4 w-50 m-auto" value="<?php echo $user_address?>">
            </div>
            <div class="form-outline mb-2">
                <input type="text" name="user_mobile" class="form-control mb-4 w-50 m-auto" value="<?php echo $user_mobile?>">
            </div>
            <input type="submit" value="Update" class="bg-info border-0 py-2 px-3" name="user_update">
        </form>
</body>
</html>