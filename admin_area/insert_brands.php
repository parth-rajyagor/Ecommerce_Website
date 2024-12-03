<?php
    include('../includes/connect.php');
    if(isset($_POST['insert_brand'])) {
        $brand_title = $_POST['brand_title'];

        // select data from database
        $select_query = "SELECT * FROM `brands` WHERE brand_title = '$brand_title'";
        $result_select = mysqli_query($con, $select_query);
        $number = mysqli_num_rows($result_select);
        if($number > 0) {
            echo "<script>alert('This brand is already present')</script>";
        }
        else {
            $insert_query = "INSERT INTO `brands` (brand_title) VALUES ('$brand_title')";
            $result = mysqli_query($con, $insert_query);
            if($result == true) {
                echo "<script>alert('Brand has been added successfully')</script>";
            }
        }
    }
?>

<h1 class="text-center text-success mb-5">Insert Brands</h1>
<form action="" method="post" class="mb-2 w-50 m-auto">
    <div class="input-group w-90 mb-3">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="brand_title" placeholder="Insert Brands" aria-label="brands" aria-describedby="basic-addon1">
    </div>

    <div class="input-group w-10 mb-auto text-center">
        <input type="submit" class="btn btn-info mb-3 px-3" name="insert_brand" value="Insert Brands" aria-label="brands" aria-describedby="basic-addon1" class="bg-info">
    </div>
</form>