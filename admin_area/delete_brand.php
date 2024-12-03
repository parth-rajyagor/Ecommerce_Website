<?php
    if(isset($_GET['delete_brand'])) {
        $delete_id=$_GET['delete_brand'];
        $delete_query="DELETE FROM `brands` WHERE brand_id=$delete_id";
        $result_query=mysqli_query($con, $delete_query);
        if($delete_query)  {
            echo "<script>alert('Brand deleted successfully')</script>";
            echo "<script>window.open('./index.php?view_brands', '_self')</script>";
        }
    }
?>