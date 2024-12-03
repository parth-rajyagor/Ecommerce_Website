<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Brands</title>
</head>
<body>
    <h1 class="text-center text-success">View Brands</h1>
    <table class="table table-bordered mt-5">
        <thead class="bg-info text-center">
            <tr>
                <th class="bg-info">Brand ID</th>
                <th class="bg-info">Brand Title</th>
                <th class="bg-info">Edit</th>
                <th class="bg-info">Delete</th>
            </tr>
        </thead>
        <tbody class="text-center bg-secondary">
        <?php
            if(isset($_GET['view_brands'])) {
                $select_query="SELECT * FROM `brands`";
                $result_brands=mysqli_query($con, $select_query);
                while($row_brands_data=mysqli_fetch_assoc($result_brands)) {
                    $brand_id=$row_brands_data['brand_id'];
                    $brand_title=$row_brands_data['brand_title'];
                    echo "
                        <tr>
                            <td class='bg-secondary text-light'>$brand_id</td>
                            <td class='bg-secondary text-light'>$brand_title</td>
                            <td class='bg-secondary text-light'><a href='index.php?edit_brand=$brand_id' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
                            <td class='bg-secondary text-light'><a href='index.php?delete_brand=$brand_id' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
                        </tr>
                        ";
                }
            }
        ?>    
        </tbody>
    </table>
</body>
</html>

<!-- Modal -->
<!-- <td class='bg-secondary text-light'><a href='index.php?delete_brand=$brand_id' type='button' class='text-light' data-bs-toggle='modal' data-bs-target='#staticBackdrop'><i class='fa-solid fa-trash'></i></a>
</td> -->
<!-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h4>Are you sure you want to delete this ?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="./index.php?view_brands" class="text-light text-decoration-none">No</a></button>
        <button type="button" class="btn btn-primary"><a href="index.php?delete_brand=<?php echo $brand_id ?>" class="text-light text-decoration-none">Yes</a></button>
      </div>
    </div>
  </div>
</div> -->