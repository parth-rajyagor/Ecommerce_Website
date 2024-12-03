<?php
    if(isset($_GET['edit_product'])) {
        $edit_id=$_GET['edit_product'];
        $select_query="SELECT * FROM `products` WHERE product_id=$edit_id";
        $result_query=mysqli_query($con, $select_query);
        $row_data=mysqli_fetch_assoc($result_query);
        $product_title=$row_data['product_title'];
        $product_description=$row_data['product_description'];
        $product_keyword=$row_data['product_keyword'];
        $product_category=$row_data['category_id'];
        $product_brand=$row_data['brand_id'];
        $product_image1=$row_data['product_image1'];
        $product_image2=$row_data['product_image2'];
        $product_image3=$row_data['product_image3'];
        $product_price=$row_data['product_price'];
        
        $select_category="SELECT * FROM `categories` WHERE category_id=$product_category";
        $result_category=mysqli_query($con, $select_category);
        $category_data=mysqli_fetch_assoc($result_category);
        $category=$category_data['category_title'];
        
        $select_brand="SELECT * FROM `brands` WHERE brand_id=$product_brand";
        $result_brand=mysqli_query($con, $select_brand);
        $brand_data=mysqli_fetch_assoc($result_brand);
        $brand=$brand_data['brand_title'];
    }

    if(isset($_POST['update_product'])) {
        $product_title = $_POST['product_title'];
        $product_description = $_POST['product_description'];
        $product_keyword = $_POST['product_keyword'];
        $product_category = $_POST['product_category'];
        $product_brand = $_POST['product_brand'];
        $product_price = $_POST['product_price'];
        $product_status = 'true';
        
        // accessing images
        $product_image1 = $_FILES['product_image1']['name'];
        $product_image2 = $_FILES['product_image2']['name'];
        $product_image3 = $_FILES['product_image3']['name'];

        // accessing images temporary name
        $temp_image1 = $_FILES['product_image1']['tmp_name'];
        $temp_image2 = $_FILES['product_image2']['tmp_name'];
        $temp_image3 = $_FILES['product_image3']['tmp_name'];

        // checking condition that all the fields are filled or not
        if($product_title=="" or $product_description=="" or $product_keyword=="" or $product_category=="" or $product_brand=="" or $product_price=="" or $product_image1=="" or $product_image2=="" or $product_image3=="") {
            echo "<script>alert('Please fill all the fields !!!')</script>";
            exit();
        }
        else {
            move_uploaded_file($temp_image1, "./product_images/$product_image1");
            move_uploaded_file($temp_image2, "./product_images/$product_image2");
            move_uploaded_file($temp_image3, "./product_images/$product_image3");

            // insert query
            $update_products = "UPDATE `products` SET product_title='$product_title', product_description='$product_description', product_keyword='$product_keyword', category_id='$product_category', brand_id='$product_brand', product_image1='$product_image1', product_image2='$product_image2', product_image3='$product_image3', product_price='$product_price', date=NOW(), status='$product_status' WHERE product_id=$edit_id";
            $update_query = mysqli_query($con, $update_products);
            if($update_query)  {
                echo "<script>alert('Product updated successfully')</script>";
                echo "<script>window.open('./index.php?view_products', '_self')</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Edit Products</title>
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center text-success mb-5">Edit Product</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- title -->
            <div class="form_outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" class="form-control" name="product_title" id="product_title" required="required" value="<?php echo $product_title ?>">
            </div>
            <!-- description -->
            <div class="form_outline mb-4 w-50 m-auto">
                <label for="product_description" class="form-label">Product Description</label>
                <input type="text" class="form-control" name="product_description" id="product_description" required="required" value="<?php echo $product_description ?>">
            </div>
            <!-- keyword -->
            <div class="form_outline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label">Product Keyword</label>
                <input type="text" class="form-control" name="product_keyword" id="product_keyword" required="required" value="<?php echo $product_keyword ?>">
            </div>
            <!-- categories -->
            <div class="form_outline mb-4 w-50 m-auto">
                <label for="product_category" class="form-label">Product Category</label>
                <select name="product_category" id="product_category" class="form-select">
                    <option value=""><?php echo $category ?></option>
                    <?php
                        $select_categories = "SELECT * FROM `categories`";
                        $result_categories = mysqli_query($con, $select_categories);
                        while($row_data = mysqli_fetch_assoc($result_categories)) {
                            $category_title = $row_data['category_title'];
                            $category_id = $row_data['category_id'];
                            echo " <option value='$category_id'>$category_title</option> ";
                        }
                    ?>                    
                </select>
            </div>
            <!-- brands -->
            <div class="form_outline mb-4 w-50 m-auto">
                <label for="product_brand" class="form-label">Product Brand</label>
                <select name="product_brand" id="product_brand" class="form-select">
                    <option value=""><?php echo $brand ?></option>
                    <?php
                        $select_brands = "SELECT * FROM `brands`";
                        $result_brands = mysqli_query($con, $select_brands);
                        while($row_data = mysqli_fetch_assoc($result_brands)) {
                            $brand_title = $row_data['brand_title'];
                            $brand_id = $row_data['brand_id'];
                            echo "<option value='$brand_id'>$brand_title</option>";
                        }
                    ?>
                </select>
            </div>
            <!-- product image -->
            <div class="form_outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Product Image1</label>
                <div class="d-flex">
                    <input type="file" class="form-control w-90 m-auto" name="product_image1" id="product_image1" required="required">
                    <img src="./product_images/<?php echo $product_image1 ?>" alt="product_image" class="cart_img">
                </div>
            </div>
            <div class="form_outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Product Image2</label>
                <div class="d-flex">
                    <input type="file" class="form-control w-90 m-auto" name="product_image2" id="product_image2" required="required">
                    <img src="./product_images/<?php echo $product_image2 ?>" alt="product_image" class="cart_img">
                </div>
            </div>
            <div class="form_outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Product Image3</label>
                <div class="d-flex">
                    <input type="file" class="form-control w-90 m-auto" name="product_image3" id="product_image3" required="required">
                    <img src="./product_images/<?php echo $product_image3 ?>" alt="product_image" class="cart_img">
                </div>
            </div>
            <!-- price -->
            <div class="form_outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" class="form-control" name="product_price" id="product_price" required="required" value="<?php echo $product_price ?>">
            </div>
            <!-- submit -->
            <div class="form_outline mb-4 w-50 m-auto text-center">
                <input type="submit" value="Update Product" name="update_product" class="btn btn-info mb-3 px-3">
            </div>
        </form>
    </div>
</body>
</html>