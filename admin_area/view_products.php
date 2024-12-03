<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
</head>
<body>
    <h1 class="text-center text-success">All Products</h1>
    <table class="table table-bordered mt-5 text-center">
        <thead class="bg-info">
            <tr>
                <th class="bg-info">Product ID</th>
                <th class="bg-info">Product Title</th>
                <th class="bg-info">Product Image</th>
                <th class="bg-info">Product Price</th>
                <th class="bg-info">Total Sold</th>
                <th class="bg-info">Status</th>
                <th class="bg-info">Edit</th>
                <th class="bg-info">Delete</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light text-center align-items-center">
            <?php
                if(isset($_GET['view_products'])) {
                    $select_query="SELECT * FROM `products`";
                    $result_products=mysqli_query($con, $select_query);
                    while($row_products_data=mysqli_fetch_assoc($result_products)) {
                        $product_id=$row_products_data['product_id'];
                        $product_title=$row_products_data['product_title'];
                        $product_image1=$row_products_data['product_image1'];
                        $product_price=$row_products_data['product_price'];
                        // $count_query="SELECT * FROM `orders_pending` WHERE product_id=$product_id";
                        // $result_count=mysqli_query($con, $count_query);
                        // $row_count=mysqli_num_rows($result_count);
                        // $row_count=mysqli_fetch_assoc($result_count);
                        // $count=$row_count['quantity'];
                        $status=$row_products_data['status'];
                        ?>
                            <tr>
                                <td class='bg-secondary text-light'><?php echo $product_id ?></td>
                                <td class='bg-secondary text-light'><?php echo $product_title ?></td>
                                <td class='bg-secondary text-light'><img src='./product_images/<?php echo $product_image1 ?>' class='cart_img'></td>
                                <td class='bg-secondary text-light'>₹<?php echo $product_price ?>/-</td>
                                <td class='bg-secondary text-light'><?php 
                                    $count_query="SELECT * FROM `orders_pending` WHERE product_id=$product_id";
                                    $result_count=mysqli_query($con, $count_query);
                                    while($row_count=mysqli_fetch_assoc($result_count)) {
                                        $count=$row_count['quantity'];
                                        if($count==null) {
                                            echo $count=0;
                                        }
                                        else {
                                            echo $count;
                                        }
                                    }
                                ?></td>
                                <td class='bg-secondary text-light'><?php echo $status ?></td>
                                <td class='bg-secondary text-light'><a href='index.php?edit_product=<?php echo $product_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
                                <td class='bg-secondary text-light'><a href='index.php?delete_product=<?php echo $product_id ?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
                            </tr>
                        <?php
                    }
                }
            ?>
        </tbody>
    </table>
</body>
</html>