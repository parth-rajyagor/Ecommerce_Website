<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>
<body>
    <h3 class="text-danger my-5">Delete Account</h3>
    <form action="" method="post">
        <div class="form-outline mb-4">
            <input type="submit" value="Delete Account Permanently" class="form-control py-2 px-3 w-50 m-auto" name="delete">
        </div>
        <div class="form-outline mb-4">
            <input type="submit" value="Do not Delete Account" class=" form-control py-2 px-3 w-50 m-auto" name="dont_delete">
        </div>
    </form>
</body>
</html>

<?php
    $username_session=$_SESSION['username'];
    if(isset($_POST['delete'])) {
        $delete_query="DELETE FROM `user_table` WHERE username='$username_session'";
        $result_delete_query=mysqli_query($con, $delete_query);
        if($result_delete_query) {
            session_destroy();
            echo "<script>alert('Account Deleted Successfully. We are sad to see you go.')</script>";
            echo "<script>window.open('../index.php', '_self')</script>";
        }
    }
    if(isset($_POST['dont_delete'])) {
        echo "<script>window.open('profile.php', '_self')</script>";
    }
?>