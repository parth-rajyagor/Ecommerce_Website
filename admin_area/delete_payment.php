<?php
    if(isset($_GET['delete_payment'])) {
        $delete_id=$_GET['delete_payment'];
        $delete_query="DELETE FROM `user_payments` WHERE payment_id=$delete_id";
        $result_query=mysqli_query($con, $delete_query);
        if($delete_query)  {
            echo "<script>alert('Payment deleted successfully')</script>";
            echo "<script>window.open('./index.php?view_payments', '_self')</script>";
        }
    }
?>