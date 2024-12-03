<?php
    if(isset($_GET['edit_brand'])) {
        $edit_id=$_GET['edit_brand'];
        $select_brand="SELECT * FROM `brands` WHERE brand_id=$edit_id";
        $result_brand=mysqli_query($con, $select_brand);
        $brand_data=mysqli_fetch_assoc($result_brand);
        $brand=$brand_data['brand_title'];
    }

    if(isset($_POST['update_brand'])) {
        $brand_title=$_POST['brand_title'];
        $update_query="UPDATE `brands` SET brand_title='$brand_title' WHERE brand_id=$edit_id";
        $result_select=mysqli_query($con, $update_query);
        if($result_select) {
            echo "<script>alert('Brand updated successfully')</script>";
            echo "<script>window.open('./index.php?view_brands', '_self')</script>";
        }
    }
?>

<h1 class="text-center text-success mb-5">Edit Brand</h1>
<form action="" method="post" class="mb-2 w-50 m-auto">
    <div class="input-group w-90 mb-3">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="brand_title" aria-label="categories" aria-describedby="basic-addon1" value=" <?php echo $brand ?>">
    </div>

    <div class="form_outline mb-4 w-50 m-auto text-center">
        <input type="submit" class="btn btn-info mb-3 px-3" name="update_brand" value="Update Brand" aria-label="Username" aria-describedby="basic-addon1" class="bg-info">
    </div>
</form>