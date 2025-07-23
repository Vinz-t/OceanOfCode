<?php 
    session_start();
    include_once('../includes/config.php');

    if (isset($_POST['submit'])) {

        $unit_name = $_POST['u_name'];
        $price = $_POST['price'];
        $location = $_POST['location'];
        $size = $_POST['size'];
        $address = $_POST['address'];
        $description = $_POST['desc'];

        for ($i=0; $i < count($_FILES['img']['name']); $i++) { 
            $file_name[] = basename($_FILES['img']['name'][$i]);
            $file_tmp = $_FILES['img']['tmp_name'][$i];
            $folder = '../uploaded_img/' . $file_name[$i];

            move_uploaded_file($file_tmp, $folder);
        }
        $filesArray = implode(',', $_FILES['img']['name']);

        $msg = mysqli_query($con, "INSERT INTO apartment_tbl (unit_name, unit_price, unit_location, unit_size, unit_address, unit_description, remarks, unit_images) VALUES ('$unit_name', '$price', '$location', '$size', '$address', '$description', 'Available', '$filesArray')");

        if ($msg) {
            echo "<script>alert('Unit added successfully!');</script>";
        } else {
            echo "<script>alert('Error adding unit: " . mysqli_error($conn) . "');</script>";
        }

    }

    // for deleting user
    if(isset($_GET['id'])) {
        $delid=$_GET['id'];
        $msg = mysqli_query($con, "delete from apartment_tbl where id='$delid'");
        if($msg) {
            echo "<script>alert('Data deleted');</script>";
        }
    }
    
    if (strlen($_SESSION['adminid']==0)) {
        header('location:logout.php');
    } else { 
        
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Dashboard | Bulacan Units </title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
    <?php include_once('includes/navbar.php');?>
        <div id="layoutSidenav">
          <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Apartment Units</h1>
                        <hr>
                        <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Upload here the apartments</li>
                        </ol> -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                    Uploaded Apartment Units
                                <a type="button" class="btn btn-success pt-0 pb-0 float-end" data-bs-toggle="modal" data-bs-target="#addModal">
                                    <i class="fas fa-plus me-1"></i>
                                    Add Unit
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Unit Name</th>
                                            <th>Price</th>
                                            <th>Location</th>
                                            <th>Size</th>
                                            <th>Address</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Images</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i = 1;
                                            $query = mysqli_query($con, "SELECT * FROM apartment_tbl");

                                            foreach ($query as $row):  $i++; ?>
                                        <tr>
                                            <td><?php echo $row['unit_name']; ?></td>
                                            <td><?php echo $row['unit_price'];?></td>
                                            <td><?php echo $row['unit_location'];?></td>
                                            <td><?php echo $row['unit_size'];?></td>
                                            <td><?php echo $row['unit_address'];?></td>
                                            <td><?php echo $row['unit_description'];?></td>
                                            <td><?php echo $row['remarks'];?></td>
                                            <td>
                                                <?php $images = explode(',', $row['unit_images']); ?>
                                                <?php foreach ($images as $image): ?>
                                                    <img src="../uploaded_img/<?php echo $image; ?>" alt="Unit Image" style="width: 50px; height: 50px; margin-right: 5px;">
                                                <?php endforeach; ?>
                                            </td>
                                            <td>
                                                <!-- <a href="#" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i></a> -->
                                                <!-- <a href="#" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                                                <a href="manage_units.php?id=<?php echo $row['id'];?>" class="btn btn-danger" onClick="return confirm('Do you really want to delete');"><i class="fa fa-trash"></i></a>
                                                <!-- <a href="edit-unit.php?unitid=<?php //echo $row['unit_id'];?>" class="btn btn-primary">Edit</a>
                                                <a href="delete-unit.php?unitid=<?php //echo $row['unit_id'];?>" class="btn btn-danger">Delete</a> -->
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
             <?php include_once('includes/footer.php'); ?>
            </div>
        </div>

        <!-- Modal for Adding Unit -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">ADD APARTMENT UNIT</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                       
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group pb-3">
                                <label for="inputAddress">Unit Name :</label>
                                <input type="text" class="form-control" name="u_name" placeholder="Make the name unique!" required>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-4">
                                    <label>Price:</label>
                                    <input type="text" class="form-control" id="price" name="price" placeholder="Price (PHP)" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Location:</label>
                                    <select id="place" class="form-select" id="location" name="location" required>
                                        <option>Choose...</option>
                                        <option value="bulacan">Bulacan</option>
                                        <option value="valenzuela">Valenzuela</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Unit Size:</label>
                                    <input type="text" class="form-control" id="size" name="size" placeholder="Size (sq. ft)" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Address:</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="location" required>
                            </div>
                            <div class="form-group pb-3">
                                <label for="inputAddress2">Description:</label>
                                <textarea class="form-control" id="desc" name="desc" placeholder="Short Description" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Upload Pictues of Unit:</label>
                                <input type="file" class="form-control" id="img" name="img[]" multiple required></input>
                            </div><hr>
                            <div class="form-group">
                                <button type="submit" name="submit" class="form-control btn btn-primary text-uppercase">Add unit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
    </body>
</html>
<?php } ?>
