<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
</head>
<body>
    <h1 class="text-center text-success">View Orders</h1>
    <table class="table table-bordered mt-5">
        <tbody class="text-center bg-secondary align-items-center">
        <?php
            if(isset($_GET['view_orders'])) {
                $select_query="SELECT * FROM `user_orders`";
                $result_order=mysqli_query($con, $select_query);
                $count=mysqli_num_rows($result_order);
                if($count==0) {
                    echo "<h3 class='text-danger text-center mt-5'>No orders yet !!<h3>";
                }
                else {
                    echo "
                        <thead class='bg-info text-center'>
                            <tr>
                                <th class='bg-info'>Order ID</th>
                                <th class='bg-info'>Amount Due</th>
                                <th class='bg-info'>Invoice No</th>
                                <th class='bg-info'>Total Products</th>
                                <th class='bg-info'>Order Date</th>
                                <th class='bg-info'>Status</th>
                                <th class='bg-info'>Delete</th>
                            </tr>
                        </thead>
                    ";
                }
                while($row_order=mysqli_fetch_assoc($result_order)) {
                    $order_id=$row_order['order_id'];
                    $amount_due=$row_order['amount_due'];
                    $invoice_number=$row_order['invoice_number'];
                    $total_products=$row_order['total_products'];
                    $order_date=$row_order['order_date'];
                    $order_status=$row_order['order_status'];
                    echo "
                        <tr>
                            <td class='bg-secondary text-light text-center'>$order_id</td>
                            <td class='bg-secondary text-light text-center'>$amount_due</td>
                            <td class='bg-secondary text-light text-center'>$invoice_number</td>
                            <td class='bg-secondary text-light text-center'>$total_products</td>
                            <td class='bg-secondary text-light text-center'>$order_date</td>
                            <td class='bg-secondary text-light text-center'>$order_status</td>
                            <td class='bg-secondary text-light text-center'><a href='index.php?delete_order=$order_id' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
                        </tr>
                        ";
                }
            }
        ?>
        </tbody>
    </table>
</body>
</html>