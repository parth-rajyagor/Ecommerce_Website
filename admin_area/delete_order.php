<?php
    if(isset($_GET['delete_order'])) {
        $delete_id=$_GET['delete_order'];
        $delete_query="DELETE FROM `user_orders` WHERE order_id=$delete_id";
        $result_query=mysqli_query($con, $delete_query);
        if($delete_query)  {
            echo "<script>alert('Order deleted successfully')</script>";
            echo "<script>window.open('./index.php?view_orders', '_self')</script>";
        }
    }
?>