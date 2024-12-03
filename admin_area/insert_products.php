<?php
    if(isset($_POST['insert_products'])) {
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
            $insert_products = "INSERT INTO `products` (product_title, product_description, product_keyword, category_id, brand_id, product_image1, product_image2, product_image3, product_price, date, status) VALUES ('$product_title', '$product_description', '$product_keyword', '$product_category', '$product_brand', '$product_image1', '$product_image2', '$product_image3', $product_price, NOW(), '$product_status')";
            $result_query = mysqli_query($con, $insert_products);
            if($result_query)  {
                echo "<script>alert('Successfully inserted the product')</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    <!-- css file link -->
    <link rel="stylesheet" href="../style.css">

    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Awesome Font Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Admin Dashboard - Insert Products</title>
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center text-success mb-5">Insert Products</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- title -->
            <div class="form_outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" class="form-control" name="product_title" id="product_title" placeholder="Enter product title" autocomplete="off" required="required">
            </div>
            <!-- description -->
            <div class="form_outline mb-4 w-50 m-auto">
                <label for="product_description" class="form-label">Product Description</label>
                <input type="text" class="form-control" name="product_description" id="product_description" placeholder="Enter product description" autocomplete="off" required="required">
            </div>
            <!-- keyword -->
            <div class="form_outline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label">Product Keyword</label>
                <input type="text" class="form-control" name="product_keyword" id="product_keyword" placeholder="Enter product keyword" autocomplete="off" required="required">
            </div>
            <!-- categories -->
            <div class="form_outline mb-4 w-50 m-auto">
                <label for="product_category" class="form-label">Product Category</label>
                <select name="product_category" id="product_category" class="form-select">
                    <option value="">Select category</option>
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
                    <option value="">Select brand</option>
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
                <input type="file" class="form-control" name="product_image1" id="product_image1" required="required">
            </div>
            <div class="form_outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Product Image2</label>
                <input type="file" class="form-control" name="product_image2" id="product_image2" required="required">
            </div>
            <div class="form_outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Product Image3</label>
                <input type="file" class="form-control" name="product_image3" id="product_image3" required="required">
            </div>
            <!-- price -->
            <div class="form_outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Enter product price" autocomplete="off" required="required">
            </div>
            <!-- submit -->
            <div class="form_outline mb-4 w-50 m-auto text-center">
                <input type="submit" value="Insert Products" name="insert_products" class="btn btn-info mb-3 px-3">
            </div>
        </form>
    </div>
</body>
</html>