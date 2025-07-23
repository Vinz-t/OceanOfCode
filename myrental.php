<?php session_start();

    include_once('includes/config.php');

    // for deleting user
    if(isset($_GET['id'])) {
        $delid = $_GET['id'];
        $prt = $_GET['aprt_iden'];
        $msg = mysqli_query($con, "delete from application_tbl where id='$delid'");
        if($msg) {
            echo "<script>alert('Data deleted');</script>";

            if ($_GET['type'] == 'aprmt') {
                mysqli_query($con, "Update apartment_tbl Set remarks = 'Available' where id = '$prt'");
            } else {
                mysqli_query($con, "Update commercial_tbl Set remarks = 'Available' where id = '$prt'");
            }
        }
    }

    if (strlen($_SESSION['id']==0)) {
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
        <title>My Rentals | Tenant</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
      <?php include_once('includes/navbar.php');?>
        <div id="layoutSidenav">
          <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Rental Records</h1>
                        <hr />
                        <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">See data here.</li>
                        </ol> -->

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                    List of Applied Apartment Units and Commercial Spaces
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Unit Avail</th>
                                            <th>Unit Price</th>
                                            <th>Unit Size</th>
                                            <th>Unit Address</th>
                                            <th>Date Avail</th>   
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                    <?php 
                                        $userid=$_SESSION['id'];
                                        $query=mysqli_query($con,"select * from users where id='$userid'");
                                        while($result=mysqli_fetch_array($query)) { 
                                            $full_name = $result['fname'] . ' ' . $result['lname'];
                                            $query1 = mysqli_query($con, "SELECT * FROM application_tbl where full_name = '$full_name'");
                                            if (mysqli_num_rows($query1) > 0) {
                                                while ($row = mysqli_fetch_assoc($query1)) {
                                                    $unit_type = $row['unit_type'];
                                                    $first_word = explode(' ', trim($unit_type))[0];
                                                    if ($first_word == 'Apartment') {
                                                        $query2 = mysqli_query($con, "SELECT * FROM apartment_tbl WHERE unit_name = '{$row['unit_iden']}'");
                                                        while($result1 = mysqli_fetch_array($query2)) { ?>
                                                            <tr>
                                                                <td><?php echo $row['id']; ?></td>
                                                                <td><?php echo $row['unit_iden']; ?></td>
                                                                <td><?php echo $result1['unit_price']; ?></td>
                                                                <td><?php echo $result1['unit_size']; ?></td>
                                                                <td><?php echo $result1['unit_address']; ?></td>
                                                                <td><?php echo $row['avail_date']; ?></td>
                                                                <td><?php echo $row['status']; ?></td>
                                                                <td>
                                                                    <!-- <a href="view-applied.php?id=<?php //echo $result['id']; ?>" class="btn btn-primary">View</a> -->
                                                                    <a href="myrental.php?id=<?php echo $row['id'];?>&aprt_iden=<?php echo $result1['id'];?>$type=aprmt" class="btn btn-danger" onClick="return confirm('Do you really want to delete');">Cancel</a>
                                                                </td>
                                                            </tr>
                                                  <?php }
                                                    } else {
                                                        $query2 = mysqli_query($con, "SELECT * FROM commercial_tbl WHERE space_name = '{$row['unit_iden']}'");
                                                        while($result1 = mysqli_fetch_array($query2)) { ?>
                                                            <tr>
                                                                <td><?php echo $row['id']; ?></td>
                                                                <td><?php echo $row['unit_iden']; ?></td>
                                                                <td><?php echo $result1['space_price']; ?></td>
                                                                <td><?php echo $result1['space_size']; ?></td>
                                                                <td><?php echo $result1['space_address']; ?></td>
                                                                <td><?php echo $row['avail_date']; ?></td>
                                                                <td><?php echo $row['status']; ?></td>
                                                                <td>
                                                                    <!-- <a href="view-applied.php?id=<?php //echo $result['id']; ?>" class="btn btn-primary">View</a> -->
                                                                    <a href="myrental.php?id=<?php echo $row['id'];?>&aprt_iden=<?php echo $result1['id'];?>$type=comm" class="btn btn-danger" onClick="return confirm('Do you really want to delete');">Cancel</a>
                                                                </td>
                                                            </tr>
                                                  <?php }
                                                    }
                                                }
                                            }
                                        ?>  

                                    <?php } ?>

                                    
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                   
                    </div>
                </main>
                <?php include('includes/footer.php');?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
<?php } ?>
