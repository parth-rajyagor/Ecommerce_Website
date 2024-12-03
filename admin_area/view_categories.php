<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Categories</title>
</head>
<body>
    <h1 class="text-center text-success">View Categories</h1>
    <table class="table table-bordered mt-5">
        <thead class="bg-info text-center">
            <tr>
                <th class="bg-info">Category ID</th>
                <th class="bg-info">Category Title</th>
                <th class="bg-info">Edit</th>
                <th class="bg-info">Delete</th>
            </tr>
        </thead>
        <tbody class="text-center bg-secondary align-items-center">
        <?php
            if(isset($_GET['view_categories'])) {
                $select_query="SELECT * FROM `categories`";
                $result_categories=mysqli_query($con, $select_query);
                while($row_categories_data=mysqli_fetch_assoc($result_categories)) {
                    $category_id=$row_categories_data['category_id'];
                    $category_title=$row_categories_data['category_title'];
                    echo "
                        <tr>
                            <td class='bg-secondary text-light'>$category_id</td>
                            <td class='bg-secondary text-light'>$category_title</td>
                            <td class='bg-secondary text-light'><a href='index.php?edit_category=$category_id' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
                            <td class='bg-secondary text-light'><a href='index.php?delete_category=$category_id' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
                        </tr>
                        ";
                }
            }
        ?>    
        </tbody>
    </table>
</body>
</html>