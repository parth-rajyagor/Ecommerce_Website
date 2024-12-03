<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Payments</title>
</head>
<body>
    <h1 class="text-center text-success">View Payments</h1>
    <table class="table table-bordered mt-5">
        <tbody class="text-center bg-secondary align-items-center">
        <?php
            if(isset($_GET['view_payments'])) {
                $select_query="SELECT * FROM `user_payments`";
                $result_payment=mysqli_query($con, $select_query);
                $count=mysqli_num_rows($result_payment);
                if($count==0) {
                    echo "<h3 class='text-danger text-center mt-5'>No payments received yet !!<h3>";
                }
                else {
                    echo "
                        <thead class='bg-info text-center'>
                            <tr>
                                <th class='bg-info'>Payment ID</th>
                                <th class='bg-info'>Invoice No</th>
                                <th class='bg-info'>Amount Due</th>
                                <th class='bg-info'>Payment Mode</th>
                                <th class='bg-info'>Date</th>
                                <th class='bg-info'>Delete</th>
                            </tr>
                        </thead>
                    ";
                }
                while($row_payment=mysqli_fetch_assoc($result_payment)) {
                    $payment_id=$row_payment['payment_id'];
                    $invoice_number=$row_payment['invoice_number'];
                    $amount_due=$row_payment['amount_due'];
                    $payment_mode=$row_payment['payment_mode'];
                    $date=$row_payment['date'];
                    echo "
                        <tr>
                            <td class='bg-secondary text-light text-center'>$payment_id</td>
                            <td class='bg-secondary text-light text-center'>$invoice_number</td>
                            <td class='bg-secondary text-light text-center'>$amount_due</td>
                            <td class='bg-secondary text-light text-center'>$payment_mode</td>
                            <td class='bg-secondary text-light text-center'>$date</td>
                            <td class='bg-secondary text-light text-center'><a href='index.php?delete_payment=$payment_id' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
                        </tr>
                        ";
                }
            }
        ?>
        </tbody>
    </table>
</body>
</html>