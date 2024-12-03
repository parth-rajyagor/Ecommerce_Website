<?php
    include('./includes/connect.php');
    include('./functions/common_functions.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website - Cart Details</title>
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Awesome Font Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <img src="./images/logo.jpg" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <?php 
                            if(isset($_SESSION['username'])) {
                                echo " <li class='nav-item'>
                                        <a class='nav-link' href='./user_area/profile.php'>My Account</a>
                                    </li>";
                            }
                            else {
                                echo "<li class='nav-item'>
                                        <a class='nav-link' href='./user_area/user_registration.php'>Register</a>
                                    </li>";
                            }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item_num(); ?></sup></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <?php
                    if(!isset($_SESSION['username'])) {
                        echo " <li class='nav-item'>
                                <a class='nav-link' href='index.php'>Welcome Guest</a>
                            </li>";
                    }
                    else {
                        echo " <li class='nav-item'>
                                <a class='nav-link' href='index.php'>Welcome ".$_SESSION['username']."</a>
                            </li>";
                    }
                    if(!isset($_SESSION['username'])) {
                        echo " <li class='nav-item'>
                                    <a class='nav-link' href='./user_area/user_login.php'>Login</a>
                                </li>";
                    }
                    else {
                        echo " <li class='nav-item'>
                                    <a class='nav-link' href='./user_area/user_logout.php'>Logout</a>
                                </li>";
                    }
                ?>
            </ul>
        </nav>

        <div class="bg-light">
            <h3 class="text-center">Hidden Store</h3>
            <p class="text-center">Communication is at the heart of e-commerce and community</p>
        </div>
        <div class="container">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered text-center">
                        <?php
                            global $con;
                            $ip=getIPAddress();
                            $total_price=0;
                            $cart_query="SELECT * FROM `cart_details` WHERE ip_address='$ip'";
                            $result_query=mysqli_query($con, $cart_query);
                            $result_count=mysqli_num_rows($result_query);
                            if($result_count>0) {
                                echo "
                                    <thead>
                                        <tr>
                                            <th>Product Title</th>
                                            <th>Product Image</th>
                                            <th>Quantity</th>
                                            <th>Total Price</th>
                                            <th>Remove</th>
                                            <th colspan='2'>Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                                while($row=mysqli_fetch_array($result_query)) {
                                    $product_id=$row['product_id'];
                                    $select_products="SELECT * FROM `products` WHERE product_id='$product_id'";
                                    $result_products=mysqli_query($con, $select_products);
                                    while($row_product_price=mysqli_fetch_array($result_products)) {
                                        $product_price=array($row_product_price['product_price']);
                                        $price_table=$row_product_price['product_price'];
                                        $product_title=$row_product_price['product_title'];
                                        $product_image1=$row_product_price['product_image1'];
                                        $product_values=array_sum($product_price);
                                        $total_price+=$product_values;
                                        ?>
                                        <tr>
                                            <td><?php echo $product_title?></td>
                                            <td><img src="./admin_area/product_images/<?php echo $product_image1?>" alt="product image" class="cart_img"></     td>
                                            <td><input type="text" name="qty" class="form-input w-50"></td>
                                            <?php
                                                $ip=getIPAddress();
                                                if(isset($_POST['update_cart'])) {
                                                    $quantities=$_POST['qty'];
                                                    $update_cart="UPDATE `cart_details` SET quantity=$quantities WHERE ip_address='$ip'";
                                                    $result_products_quantity=mysqli_query($con, $update_cart);
                                                    $total_price=$total_price*$quantities;
                                                }
                                            ?>
                                            <td><?php echo $price_table?>/-</td>
                                            <td><input type="checkbox" name="removeitem[]" id="" value="<?php echo $product_id?>"></td>
                                            <?php remove_cart_item();?>
                                            <td>
                                                <input type="submit" value="Update" class="bg-info text-light border-0 px-3 py-2 mx-3" name="update_cart">
                                                <input type="submit" value="Remove" class="bg-info text-light border-0 px-3 py-2" name="remove_cart">
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            }
                            else {
                                echo "<h2 class='text-center text-danger'>Cart is empty !!!</h2>";
                            }
                        ?>
                        </tbody>
                    </table>
                    <?php
                        if($result_count>0) {
                            echo"
                            <div class='d-flex px-5 mb-5'>
                            <h4>Subtotal: <strong class='text-info'>$total_price/-</strong></h4>
                            <input type='submit' value='Continue Shopping' class='bg-info text-light border-0 px-3 py-2 mx-3' name='continue_shopping'>
                            <input type='submit' value='Checkout' class='bg-secondary text-light border-0 p-3 py-2' name='checkout'>                           
                            </div>";
                            continue_shopping();
                            checkout_button();
                        }
                        else {
                            echo"<input type='submit' value='Continue Shopping' class='bg-info text-light border-0 px-3 py-2 mx-3 mb-3' name='continue_shopping'>";
                            continue_shopping();
                        }
                    ?>
                </form>
            </div>
        </div>
        <?php
            include ("./includes/footer.php")
        ?>
    </div>

    <!-- Bootstrap Javascript link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>