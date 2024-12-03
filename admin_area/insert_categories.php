<?php
    include('../includes/connect.php');
    if(isset($_POST['insert_cat'])) {
        $category_title = $_POST['cat_title'];

        // select data from database
        $select_query = "SELECT * FROM `categories` WHERE category_title = '$category_title'";
        $result_select = mysqli_query($con, $select_query);
        $number = mysqli_num_rows($result_select);
        if($number > 0) {
            echo "<script>alert('This category is already present')</script>";
        }
        else {
            $insert_query = "INSERT INTO `categories` (category_title) VALUES ('$category_title')";
            $result = mysqli_query($con, $insert_query);
            if($result == true) {
                echo "<script>alert('Category has been added successfully')</script>";
            }
        }
    }
?>

<h1 class="text-center text-success mb-5">Insert Categories</h1>
<form action="" method="post" class="mb-2 w-50 m-auto">
    <div class="input-group w-90 mb-3">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert Categories" aria-label="categories" aria-describedby="basic-addon1">
    </div>

    <div class="input-group w-10 mb-auto text-center">
        <input type="submit" class="btn btn-info mb-3 px-3" name="insert_cat" value="Insert Categories" aria-label="Username" aria-describedby="basic-addon1" class="bg-info">
    </div>
</form>