<?php
    $con = mysqli_connect('localhost', 'root', '', 'mystore');
    if($con == false) {
        die(mysqli_connect_error($con));
    }
?>