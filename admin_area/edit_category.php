<?php
    if(isset($_GET['edit_category'])) {
        $edit_id=$_GET['edit_category'];
        $select_category="SELECT * FROM `categories` WHERE category_id=$edit_id";
        $result_category=mysqli_query($con, $select_category);
        $category_data=mysqli_fetch_assoc($result_category);
        $category=$category_data['category_title'];
    }

    if(isset($_POST['update_cat'])) {
        $category_title=$_POST['cat_title'];
        $update_query="UPDATE `categories` SET category_title='$category_title' WHERE category_id=$edit_id";
        $result_select=mysqli_query($con, $update_query);
        if($result_select) {
            echo "<script>alert('Category updated successfully')</script>";
            echo "<script>window.open('./index.php?view_categories', '_self')</script>";
        }
    }
?>

<h1 class="text-center text-success mb-5">Edit Category</h1>
<form action="" method="post" class="mb-2 w-50 m-auto">
    <div class="input-group w-90 mb-3">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_title" aria-label="categories" aria-describedby="basic-addon1" value=" <?php echo $category ?>">
    </div>

    <div class="form_outline mb-4 w-50 m-auto text-center">
        <input type="submit" class="btn btn-info mb-3 px-3" name="update_cat" value="Update Category" aria-label="Username" aria-describedby="basic-addon1" class="bg-info">
    </div>
</form>