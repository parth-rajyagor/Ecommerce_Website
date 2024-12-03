<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
</head>
<body>
    <h1 class="text-center text-success">View Users</h1>
    <table class="table table-bordered mt-5">
        <tbody class="text-center bg-secondary align-items-center">
        <?php
            if(isset($_GET['view_users'])) {
                $select_query="SELECT * FROM `user_table`";
                $result_user=mysqli_query($con, $select_query);
                $count=mysqli_num_rows($result_user);
                if($count==0) {
                    echo "<h3 class='text-danger text-center mt-5'>No Users yet !!<h3>";
                }
                else {
                    echo "
                        <thead class='bg-info text-center'>
                            <tr>
                                <th class='bg-info'>User ID</th>
                                <th class='bg-info'>Username</th>
                                <th class='bg-info'>User Email</th>
                                <th class='bg-info'>User Mobile</th>
                                <th class='bg-info'>User Address</th>
                                <th class='bg-info'>User Image</th>
                                <th class='bg-info'>Date of Registration</th>
                                <th class='bg-info'>Delete</th>
                            </tr>
                        </thead>
                    ";
                }
                while($row_user=mysqli_fetch_assoc($result_user)) {
                    $user_id=$row_user['user_id'];
                    $username=$row_user['username'];
                    $user_email=$row_user['user_email'];
                    $user_mobile=$row_user['user_mobile'];
                    $user_address=$row_user['user_address'];
                    $user_image=$row_user['user_image'];
                    $date=$row_user['date'];
                    echo "
                        <tr>
                            <td class='bg-secondary text-light text-center'>$user_id</td>
                            <td class='bg-secondary text-light text-center'>$username</td>
                            <td class='bg-secondary text-light text-center'>$user_email</td>
                            <td class='bg-secondary text-light text-center'>$user_mobile</td>
                            <td class='bg-secondary text-light text-center'>$user_address</td>
                            <td class='bg-secondary text-light text-center'><img src='../user_area/user_images/$user_image' class='edit_img'></td>
                            <td class='bg-secondary text-light text-center'>$date</td>
                            <td class='bg-secondary text-light text-center'><a href='index.php?delete_user=$user_id' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
                        </tr>
                        ";
                }
            }
        ?>
        </tbody>
    </table>
</body>
</html>