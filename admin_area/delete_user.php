<?php
    if(isset($_GET['delete_user'])) {
        $delete_id=$_GET['delete_user'];
        $delete_query="DELETE FROM `user_table` WHERE user_id=$delete_id";
        $result_query=mysqli_query($con, $delete_query);
        if($delete_query)  {
            echo "<script>alert('User deleted successfully')</script>";
            echo "<script>window.open('./index.php?view_users', '_self')</script>";
        }
    }
?>