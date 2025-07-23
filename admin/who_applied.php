<?php session_start();
    include_once('../includes/config.php');

    // for update user
    if(isset($_GET['uid'])) {
        $prtid=$_GET['uid'];
        $msg=mysqli_query($con,"update application_tbl set status = 'Approved' where id='$prtid'");
        if($msg) {
            echo "<script>alert('Successfully Updated the status');</script>";
        }
    }

    if (strlen($_SESSION['adminid']==0)) {
        header('location:logout.php');
    } else {
    // for deleting user
    if(isset($_GET['id'])) {
        $prtid=$_GET['id'];
        $msg=mysqli_query($con,"delete from application_tbl where id='$prtid'");
        if($msg) {
            echo "<script>alert('Data deleted');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Dashboard | Pending Applied</title>
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
                        <h1 class="mt-4">Submitted Application</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage applicants</li>
                        </ol>
            
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Applications Details
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Unit Avail</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Occupation</th>
                                            <th>Monthly Income</th>
                                            <th>Type</th>
                                            <th>Person Cnt</th>
                                            <th>Move Date</th>
                                            <th>Have Pets?</th>
                                            <th>Valid Id</th>
                                            <th>Avail Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $ret=mysqli_query($con,"select * from application_tbl");
                                        
                                        while($row=mysqli_fetch_array($ret)) {?>
                                        <tr>
                                            <td><?php echo $row['unit_iden'];?></td>
                                            <td><?php echo $row['full_name'];?></td>
                                            <td><?php echo $row['email'];?></td>
                                            <td><?php echo $row['occupation'];?></td>  
                                            <td><?php echo $row['m_income'];?></td>
                                            <td><?php echo $row['unit_type'];?></td>
                                            <td><?php echo $row['move_ins'];?></td>
                                            <td><?php echo $row['move_date'];?></td>
                                            <td><?php echo $row['have_pet'];?></td>
                                            <td> 
                                                <a type="button" data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-img="../uploaded_img/<?php echo $row['valid_id']; ?>">
                                                    <img src="../uploaded_img/<?php echo $row['valid_id']; ?>" alt="Valid ID" style="width: 50px; height: 50px;">
                                                </a>
                                            </td>
                                            <td><?php echo $row['avail_date'];?></td>
                                            <td><?php echo $row['status'];?></td>
                                            <td>
                                                <?php 
                                                    if ($row['status'] == 'Pending') { ?>
                                                        <a href="who_applied.php?uid=<?php echo $row['id'];?>" class="btn btn-success"> 
                                                            <!-- <i class="fas fa-edit"></i> -->
                                                            Approved
                                                        </a>
                                                <?php } ?>
                                                <a href="who_applied.php?id=<?php echo $row['id'];?>" class="btn btn-danger" onClick="return confirm('Do you really want to delete');">
                                                    <!-- <i class="fa fa-trash" aria-hidden="true"></i> -->
                                                     Delete
                                                </a>
                                            </td>
                                        </tr>
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

        <!-- Modal -->
        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">VALID ID</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-4">
                    <div class="card-body p-1">
                        <img src="" id="modalImage" class="d-block w-100" alt="Full Image">
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
            </div>
        </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var imageModal = document.getElementById('imageModal');
                imageModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget;
                    var imgSrc = button.getAttribute('data-bs-img');
                    var modalImg = imageModal.querySelector('#modalImage');
                    modalImg.src = imgSrc;
                });
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
    </body>
</html>
<?php } ?>