<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Orders</title>
</head>
<body>
    <?php
        $username=$_SESSION['username'];
        $select_query="SELECT * FROM `user_table` WHERE username='$username'";
        $result_query=mysqli_query($con, $select_query);
        $row_fetch=mysqli_fetch_assoc($result_query);
        $user_id=$row_fetch['user_id'];
    ?>
    <h3 class="text-success my-5">All my orders</h3>
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th class="bg-info">Sr No.</th>
                <th class="bg-info">Amount Due</th>
                <th class="bg-info">Total Products</th>
                <th class="bg-info">Invoice Number</th>
                <th class="bg-info">Date</th>
                <th class="bg-info">Complete/Incomplete</th>
                <th class="bg-info">Status</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
                $get_order_details="SELECT * FROM `user_orders`";
                // $get_order_details="SELECT * FROM `user_orders` WHERE user_id=$user_id";
                $result_order_query=mysqli_query($con, $get_order_details);
                while($order_fetch=mysqli_fetch_assoc($result_order_query)) {
                    $order_id=$order_fetch['order_id'];
                    $serial_number=$order_fetch['order_id'];
                    $amount_due=$order_fetch['amount_due'];
                    $invoice_number=$order_fetch['invoice_number'];
                    $total_products=$order_fetch['total_products'];
                    $order_date=$order_fetch['order_date'];
                    $order_status=$order_fetch['order_status'];
                    if($order_status=='pending') {
                        $order_status='Incomplete';
                    }
                    else {
                        $order_status='Complete';
                    }
                    echo "<tr>
                            <td class='bg-secondary text-light'>$serial_number</td>
                            <td class='bg-secondary text-light'>$amount_due</td>
                            <td class='bg-secondary text-light'>$total_products</td>
                            <td class='bg-secondary text-light'>$invoice_number</td>
                            <td class='bg-secondary text-light'>$order_date</td>
                            <td class='bg-secondary text-light'>$order_status</td>";
                            ?>
                            <?php
                                if($order_status=='Complete') {
                                    echo "<td class='bg-secondary text-light'>Paid</td>";
                                }
                                else {
                                    echo " <td class='bg-secondary text-light'><a href='confirm_payment.php?order_id=$order_id' class='text-light'>Confirm</a></td>
                                    </tr>";
                                }
                }
            ?>
        </tbody>
    </table>
</body>
</html>