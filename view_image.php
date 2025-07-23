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
        <title>Preview Images</title>
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
                        <h1 class="mt-4">IMAGES</h1>
                        <hr />
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">See SELECT images here.</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-body">
                                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">

                                        <?php 
                                        if ($_GET['ident'] == 'aprt') {
                                            $i = 1;
                                            $query = mysqli_query($con, "SELECT * FROM apartment_tbl WHERE id = '{$_GET['apartment_img']}'");
                                            foreach ($query as $row):  $i++; ?>

                                                <?php 
                                                $images = explode(',', $row['unit_images']);
                                                foreach ($images as $index => $image): ?>
                                                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                                        <img src="uploaded_img/<?php echo trim($image); ?>" class="d-block w-100" alt="...">
                                                    </div>
                                                <?php endforeach; ?>
                                                
                                            <?php endforeach; ?>
                                        <?php } else {
                                            $i = 1;
                                            $query = mysqli_query($con, "SELECT * FROM commercial_tbl WHERE id = '{$_GET['commercial_img']}'");
                                            foreach ($query as $row):  $i++; ?>

                                                <?php 
                                                $images = explode(',', $row['space_images']);
                                                foreach ($images as $index => $image): ?>
                                                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                                        <img src="uploaded_img/<?php echo trim($image); ?>" class="d-block w-100" alt="...">
                                                    </div>
                                                <?php endforeach; ?>
                                                
                                            <?php endforeach; ?>
                                        
                                        <?php } ?>

                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                        <span class="carousel-control-next-icon fs-6" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>  
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
