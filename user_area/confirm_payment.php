<?php
    include('../includes/connect.php');
    session_start();
    if(isset($_GET['order_id'])) {
        $order_id=$_GET['order_id'];
        $select_query="SELECT * FROM `user_orders` WHERE order_id=$order_id";
        $result_query=mysqli_query($con, $select_query);
        $row_data=mysqli_fetch_assoc($result_query);
        $invoice_number=$row_data['invoice_number'];
        $amount_due=$row_data['amount_due'];
    }
    if(isset($_POST['confirm_payment'])) {
        $invoice_number=$_POST['invoice_number'];
        $amount_due=$_POST['amount_due'];
        $payment_mode=$_POST['payment_mode'];
        $insert_query="INSERT INTO `user_payments` (order_id, invoice_number, amount_due, payment_mode, date) VALUES ($order_id, $invoice_number, $amount_due, '$payment_mode', NOW())";
        $result_insert_query=mysqli_query($con, $insert_query);
        if($result_insert_query) {
            echo "<script>alert('Payment Completed Successfully')</script>";
            echo "<script>window.open('profile.php?my_orders','_self')</script>";
        }
        $update_orders="UPDATE `user_orders` SET order_status='Complete' WHERE order_id=$order_id";
        $result_update_query=mysqli_query($con, $update_orders);
        $update_pending_orders="UPDATE `orders_pending` SET order_status='Complete' WHERE order_id=$order_id";
        $result_update_pending_query=mysqli_query($con, $update_pending_orders);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Payment Page</title>
</head>
<body class="bg-secondary">
    <div class="container my-5">
        <h1 class="text-center text-light">Confirm Payment</h1>
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" name="invoice_number" class="form-control w-50 m-auto" value="<?php echo $invoice_number ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Amount:</label>
                <input type="text" name="amount_due" class="form-control w-50 m-auto" value="<?php echo $amount_due ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option>Select Payment Mode</option>
                    <option>UPI</option>
                    <option>Net Banking</option>
                    <option>Paypal</option>
                    <option>Cash On Delivery</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" name="confirm_payment" class="bg-info py-2 px-3 border-0" value="Confirm">
            </div>
        </form>
    </div>
</body>
</html>