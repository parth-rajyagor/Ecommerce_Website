<?php
    // include('./includes/connect.php');

    // get products on index page
    function getproducts($limit, $offset) {
        global $con;
        // checking category or brand is set or not
        if(!isset($_GET['category'])) {
            if(!isset($_GET['brand'])) {
                $select_query = "SELECT * FROM `products` LIMIT $limit OFFSET $offset";
                $result_query = mysqli_query($con, $select_query);
                while($row = mysqli_fetch_assoc($result_query)) {
                    $product_id=$row['product_id'];
                    $product_title=$row['product_title'];
                    $product_description=$row['product_description'];
                    $product_category=$row['category_id'];
                    $product_brand=$row['brand_id'];
                    $product_image1=$row['product_image1'];
                    $product_price=$row['product_price'];
                    echo "<div class='col-md-4 mb-2'>
                            <div class='card'>
                                <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>$product_description</p>
                                    <p class='card-text'>Price: ₹$product_price/-</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                                </div>
                            </div>                       
                        </div>";
                }
                $products_per_page = 6; // Customize as needed
                $query = "SELECT COUNT(*) FROM `products`";
                $result = mysqli_query($con, $query);
                $total_products = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_products / $products_per_page);
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($page - 1) * $products_per_page;
                echo '<nav aria-label="Page navigation">';
                echo '<ul class="pagination justify-content-center">';
                // First page button
                if ($page > 1) {
                    echo '<li class="page-item">';
                    echo '<a class="page-link" href="index.php?page=1">First</a>';
                    echo '</li>';
                }
                // Previous page button
                if ($page > 1) {
                    $prev_page = $page - 1;
                    echo '<li class="page-item">';
                    echo '<a class="page-link" href="index.php?page='.$prev_page.'">Previous</a>';
                    echo '</li>';
                }
                // Page number buttons
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<li class="page-item '.($i == $page ? 'active' : '').'">';
                    echo '<a class="page-link" href="index.php?page='.$i.'">'.$i.'</a>';
                    echo '</li>';
                }
                // Next page button
                if ($page < $total_pages) {
                    $next_page = $page + 1;
                    echo '<li class="page-item">';
                    echo '<a class="page-link" href="index.php?page='.$next_page.'">Next</a>';
                    echo '</li>';
                }
                // Last page button
                if ($page < $total_pages) {
                    echo '<li class="page-item">';
                    echo '<a class="page-link" href="index.php?page='.$total_pages.'">Last</a>';
                    echo '</li>';
                }
                echo '</ul>';
                echo '</nav>';
            }
        }
    }

    // get all products
    function get_all_products() {
        global $con;
        $select_query="SELECT * FROM `products` ORDER BY rand()";
        $result_query=mysqli_query($con, $select_query);
        while($row=mysqli_fetch_assoc($result_query)) {
            $product_id=$row['product_id'];
            $product_title=$row['product_title'];
            $product_description=$row['product_description'];
            $product_category=$row['category_id'];
            $product_brand=$row['brand_id'];
            $product_image1=$row['product_image1'];
            $product_price=$row['product_price'];
            echo "<div class='col-md-4 mb-2'>
                    <div class='card'>
                        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_description</p>
                            <p class='card-text'>Price: ₹$product_price/-</p>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                            <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                        </div>
                    </div>                       
                </div>";
        }
    }
    
    // displaying items with selected categories only
    function get_unique_categories() {
        global $con;
        // checking isset or not
        if(isset($_GET['category'])) {
            $category_id=$_GET['category'];
            $select_query="SELECT * FROM `products` WHERE category_id = $category_id ";
            $result_query=mysqli_query($con, $select_query);
            $num_of_rows=mysqli_num_rows($result_query);
            if($num_of_rows==0) {
                echo "<h2 class='text-center text-danger'>No stock available !!!</h2>";
            }
            while($row=mysqli_fetch_assoc($result_query)) {
                $product_id=$row['product_id'];
                $product_title=$row['product_title'];
                $product_description=$row['product_description'];
                $product_category=$row['category_id'];
                $product_brand=$row['brand_id'];
                $product_image1=$row['product_image1'];
                $product_price=$row['product_price'];
                echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: ₹$product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                            </div>
                        </div>                       
                    </div>";
            }
        }
    }

    // displaying items with selected brands only
    function get_unique_brands() {
        global $con;
        // checking isset or not
        if(isset($_GET['brand'])) {
            $brand_id=$_GET['brand'];
            $select_query="SELECT * FROM `products` WHERE brand_id=$brand_id ";
            $result_query=mysqli_query($con, $select_query);
            $num_of_rows=mysqli_num_rows($result_query);
            if($num_of_rows==0) {
                echo "<h2 class='text-center text-danger'>No stock available !!!</h2>";
            }
            while($row = mysqli_fetch_assoc($result_query)) {
                $product_id=$row['product_id'];
                $product_title=$row['product_title'];
                $product_description=$row['product_description'];
                $product_category=$row['category_id'];
                $product_brand=$row['brand_id'];
                $product_image1=$row['product_image1'];
                $product_price=$row['product_price'];
                echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: ₹$product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                            </div>
                        </div>                       
                    </div>";
            }
        }
    }
    
    // displaying brands in side nav
    function getbrands() {
        global $con;
        $select_brands="SELECT * FROM `brands`";
        $result_brands=mysqli_query($con, $select_brands);
        while($row_data=mysqli_fetch_assoc($result_brands)) {
            $brand_title=$row_data['brand_title'];
            $brand_id=$row_data['brand_id'];
            echo "<li class='nav-item'>
                <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
                </li>";
        }
    }

    // displaying categories in side nav
    function getcategories() {
        global $con;
        $select_categories="SELECT * FROM `categories`";
        $result_categories=mysqli_query($con, $select_categories);
        while($row_data=mysqli_fetch_assoc($result_categories)) {
            $category_title=$row_data['category_title'];
            $category_id=$row_data['category_id'];
            echo "<li class='nav-item'>
                <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
                </li>";
        }
    }
        
    // searching products
    function search_product() {
        global $con;
        if(isset($_GET['search_data_product'])) {
            $search_data_value=$_GET['search_data'];
            $search_query="SELECT * FROM `products` WHERE product_keyword LIKE '%$search_data_value%'";
            $result_query=mysqli_query($con, $search_query);
            $num_of_rows=mysqli_num_rows($result_query);
            if($num_of_rows==0) {
                echo "<h2 class='text-center text-danger'>No results match. No products found on this category !!!</h2>";
            }
            while($row=mysqli_fetch_assoc($result_query)) {
                $product_id=$row['product_id'];
                $product_title=$row['product_title'];
                $product_description=$row['product_description'];
                $product_category=$row['category_id'];
                $product_brand=$row['brand_id'];
                $product_image1=$row['product_image1'];
                $product_price=$row['product_price'];
                echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: ₹$product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                            </div>
                        </div>                       
                    </div>";
            }
        }
    }

    // view more details
    function view_details() {
        global $con;
        // checking category or brand is set or not
        if(isset($_GET['product_id'])) {
            if(!isset($_GET['category'])) {
                if(!isset($_GET['brand'])) {
                    $product_id=$_GET['product_id'];
                    $select_query="SELECT * FROM `products` WHERE product_id=$product_id";
                    $result_query=mysqli_query($con, $select_query);
                    while($row=mysqli_fetch_assoc($result_query)) {
                        $product_id=$row['product_id'];
                        $product_title=$row['product_title'];
                        $product_description=$row['product_description'];
                        $product_category=$row['category_id'];
                        $product_brand=$row['brand_id'];
                        $product_image1=$row['product_image1'];
                        $product_image2=$row['product_image2'];
                        $product_image3=$row['product_image3'];
                        $product_price=$row['product_price'];
                        echo "
                       <div class='col-md-10'>
                            <div class='row'>
                                <div class='col-md-12'>
                                    <h4 class='text-center text-info m-3'>Related Products</h4>
                                </div>

                                <div class='col-md-4 mb-2'>
                                    <div class='card'>
                                        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>$product_title</h5>
                                            <p class='card-text'>$product_description</p>
                                            <p class='card-text'>Price: ₹$product_price/-</p>
                                            <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                            <a href='index.php' class='btn btn-secondary'>Go Home</a>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-md-4 mb-2'>
                                    <div class='card'>
                                        <img src='./admin_area/product_images/$product_image2' class='card-img-top' alt='$product_title'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>$product_title</h5>
                                            <p class='card-text'>$product_description</p>
                                            <p class='card-text'>Price: ₹$product_price/-</p>
                                            <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                            <a href='index.php' class='btn btn-secondary'>Go Home</a>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-md-4 mb-2'>
                                    <div class='card'>
                                        <img src='./admin_area/product_images/$product_image3' class='card-img-top' alt='$product_title'>
                                            <div class='card-body'>
                                                <h5 class='card-title'>$product_title</h5>
                                                <p class='card-text'>$product_description</p>
                                                <p class='card-text'>Price: ₹$product_price/-</p>
                                                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                                <a href='index.php' class='btn btn-secondary'>Go Home</a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    }
                }
            }
        }
    }

    // get ip address
    function getIPAddress() {  
        //whether ip is from the share internet  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip=$_SERVER['HTTP_CLIENT_IP'];  
            }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];  
         }  
        //whether ip is from the remote address  
        else{  
                 $ip=$_SERVER['REMOTE_ADDR'];  
         }  
         return $ip;  
    }

    // cart function
    function cart() {
        if(isset($_GET['add_to_cart'])) {
            global $con;
            $ip=getIPAddress();
            $get_product_id=$_GET['add_to_cart'];
            $select_query="SELECT * FROM `cart_details` WHERE ip_address='$ip' AND product_id=$get_product_id";
            $result_query=mysqli_query($con, $select_query);
            $num_of_rows=mysqli_num_rows($result_query);
            if($num_of_rows>0) {
                echo "<script>alert('This item is already present in cart')</script>";
                echo "<script>window.open('index.php', '_self')</script>";
            }
            else {
                $insert_query="INSERT INTO `cart_details` (product_id, ip_address, quantity, dt) VALUES ($get_product_id, '$ip', 0, NOW())";
                $result_query=mysqli_query($con, $insert_query);
                echo "<script>alert('Product added to cart successfully')</script>";
                echo "<script>window.open('index.php', '_self')</script>";
            } 
        }
    }

    // cart item numbers
    function cart_item_num() {
            global $con;
            $ip=getIPAddress();
            $select_query="SELECT * FROM `cart_details` WHERE ip_address='$ip'";
            $result_query=mysqli_query($con, $select_query);
            $count_cart_items=mysqli_num_rows($result_query);
            echo $count_cart_items;
    }

    // total price
    function total_cart_price() {
        global $con;
        $ip=getIPAddress();
        $total_price=0;
        $cart_query="SELECT * FROM `cart_details` WHERE ip_address='$ip'";
        $result_query=mysqli_query($con, $cart_query);
        while($row=mysqli_fetch_array($result_query)) {
            $product_id=$row['product_id'];
            $select_products="SELECT * FROM `products` WHERE product_id='$product_id'";
            $result_products=mysqli_query($con, $select_products);
            while($row_product_price=mysqli_fetch_array($result_products)) {
                $product_price=array($row_product_price['product_price']);
                $product_values=array_sum($product_price);
                $total_price+=$product_values;
            }
        }
        echo $total_price;
    }

    // remove cart item
    function remove_cart_item() {
        global $con;
        if(isset($_POST['remove_cart'])) {
            foreach($_POST['removeitem'] as $remove_id) {
                echo $remove_id;
                $delete_query="DELETE FROM `cart_details` WHERE product_id=$remove_id";
                $result_delete=mysqli_query($con, $delete_query);
                if($result_delete) {
                    echo "<script>window.open('cart.php', '_self')</script>";
                }
            }
        }
    }

    // continue shopping
    function continue_shopping() {
        if(isset($_POST['continue_shopping'])) {
            echo"<script>window.open('index.php', '_self')</script>";
        }
    }

    // checkout button
    function checkout_button() {
        if(isset($_POST['checkout'])) {
            echo"<script>window.open('./user_area/checkout.php', '_self')</script>";
        }
    }

    // get user order details
    function get_user_order_details() {
        global $con;
        $username=$_SESSION['username'];
        $get_details="SELECT * FROM `user_table` WHERE username='$username'";
        $result_query=mysqli_query($con, $get_details);
        while($row_query=mysqli_fetch_array($result_query)) {
            $user_id=$row_query['user_id'];
            if(!isset($_GET['edit_account'])) {
                if(!isset($_GET['my_orders'])) {
                    if(!isset($_GET['delete_account'])) {
                        $get_orders="SELECT * FROM `user_orders` WHERE order_status='pending'";
                        //$get_orders="SELECT * FROM `user_orders` WHERE user_id=$user_id AND order_status='pending'";
                        $result_orders_query=mysqli_query($con, $get_orders);
                        $row_count=mysqli_num_rows($result_orders_query);
                        if($row_count > 0) {
                            echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'>$row_count</span> pending orders</h3>
                            <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>";
                        }
                        else {
                            echo "<h3 class='text-center text-success mt-5 mb-2'>You have 0 pending orders</h3>
                            <p class='text-center'><a href='../index.php' class='text-dark'>Explore Products</a></p>";
                        }
                    }
                }
            }
        }
    }
?>