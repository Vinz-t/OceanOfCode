<?php session_start();
    include_once('includes/config.php');

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
        <title>Valenzuela Commercial Space</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

        <style>
            .custom-close {
                position: absolute;
                top: -14px;
                right: 3px;
                font-size: 40px;
                color: white;
                z-index: 1050;
                background: none;
                border: none;
                opacity: 0.8;
            }
            .custom-close:hover {
                opacity: 1;
            }
        </style>

    </head>
    <body class="sb-nav-fixed">
      <?php include_once('includes/navbar.php');?>
        <div id="layoutSidenav">
          <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Valenzuela Commercial Space</h1>
                        <hr />
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">You can see here the available commercial space, under bulacan area.</li>
                        </ol>

                        <div class="row">

                        <?php 
                            $i = 1;
                            $query = mysqli_query($con, "SELECT * FROM commercial_tbl WHERE space_location = 'valenzuela'");
                            if (mysqli_num_rows($query) != 0) {
                                // foreach ($query as $row):  $i++;
                                while($row = mysqli_fetch_array($query)) {
                            ?>
                                <div class="col-xl-4 col-md-6" >
                                <div class="card text-white mb-4">
                                    <a href="view_image.php?commercial_img=<?php echo $row['id']; ?>&ident=com">
                                        <img class="card-img-top" src="uploaded_img/<?php $images = explode(',', $row['space_images']); echo $images[0]; ?>" alt="Card image cap"  style="width: 100%; height: 200px; object-fit: cover;">
                                    </a>
                                    <div class="card-body text-dark">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4 class="card-title">₱ <?php echo $row['space_price']; ?></h4>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <span class="card-title">

                                                    <?php if ($row['remarks'] == 'Available') { ?>
                                                        &#9989; 
                                                    <?php } else { ?>
                                                        &#10060;
                                                    <?php } ?>

                                                    <!-- <i class="far fa-dot-circle"></i> -->
                                                    <?php echo $row['remarks']; ?>
                                                </span>
                                            </div>
                                        </div>

                                        <span class="text-muted"><i class="fas fa-map-marker-alt"></i>
                                            <?php echo $row['space_address']; ?>
                                        </span><br>
                                        <span class="text-muted"><i class="fas fa-ruler"></i>
                                            <?php echo $row['space_size']; ?>
                                        </span><br>
                                        <span class="text-muted"><i class="fas fa-info-circle"></i>
                                            <?php echo $row['space_description']; ?>
                                        </span>
                                    </div>

                                    <?php 
                                        if ($row['remarks'] == 'Available') { ?>
                                
                                    <a href="applying_form.php?apartment_id=<?php echo $row['id']; ?>&aprt_name=<?php echo $row['space_name']; ?>&loc=<?php echo $row['space_location']; ?>&identifier=2" 
                                        class="card-footer text-dark d-flex align-items-center justify-content-between" 
                                        style="text-decoration: none;">
                                        <div class="small">
                                            More Details
                                        </div>
                                        <div class="small"><i class="fas fa-angle-right"></i></div>
                                    </a>

                                    <?php } else { ?>
                                        <a type="button" class="card-footer text-dark d-flex align-items-center justify-content-between" 
                                            style="text-decoration: none;"
                                            data-bs-toggle="modal" data-bs-target="#errorModal">
                                            <div class="small">
                                                More Details
                                            </div>
                                            <div class="small"><i class="fas fa-angle-right"></i></div>
                                        </a>
                                    <?php } ?>
                                    
                                </div>
                                
                            </div>

                            <?php
                                    }
                                    // endforeach;
                                } else {
                                    echo '<div class="text-muted text-center"><p style="font-style:italic;">No Available Units</p></div>';
                                }   
                            ?>
                        </div>
                   
                    </div>
                </main>
                <?php include('includes/footer.php');?>
            </div>
        </div>

        <!-- Modal for Error -->
        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">&#128386; Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3 class="text-uppercase text-center">&#128577; The unit is not available.</h3>
                </div>
                </div>
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
