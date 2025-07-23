<?php session_start();

    include_once('includes/config.php');

    if (isset($_POST['submit'])) {
        $aprt_id = $_GET['apartment_id'];
        $aprt_name = $_GET['aprt_name'];
        $fullname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $cAddress = $_POST['cAddress'];
        $occupation = $_POST['occupation'];
        $income = $_POST['income'];
        $Utype = $_POST['Utype'];
        $moveins = $_POST['moveins'];
        $moveDate = $_POST['moveDate'];
        $pets = $_POST['pet'];

        $valid_id_name = $_FILES['valid_id']['name'];
        $valid_id_tmp = $_FILES['valid_id']['tmp_name'];
        $folder = "uploaded_img/" . $valid_id_name;

        $query = mysqli_query($con, "Insert into application_tbl (unit_iden, full_name, phone_no, email, c_Address, occupation, m_income, unit_type, move_ins, move_date, have_pet, valid_id, status) values ('$aprt_name', '$fullname', '$phone', '$email', '$cAddress', '$occupation', '$income', '$Utype', '$moveins', '$moveDate', '$pets', '$valid_id_name', 'Pending')");
        if ($query) {
            echo "<script>alert('Application submitted successfully.');</script>";

            move_uploaded_file($valid_id_tmp, $folder);

            if ($_GET['identifier'] == 1) {
                $aprt_update = mysqli_query($con, "UPDATE apartment_tbl SET remarks = 'Not Available' WHERE id = '$aprt_id'");
            } else {
                $aprt_update = mysqli_query($con, "UPDATE commercial_tbl SET remarks = 'Not Available' WHERE id = '$aprt_id'");
            }
            
            // if ($aprt_update) {
            //     echo "<script>alert('Apartment status updated.');</script>";
            // } else {
            //     echo "<script>alert('Error updating apartment status.');</script>";
            // }

            echo "<script>window.location.href='myrental.php';</script>";
        } else {
            echo "<script>alert('Error submitting application.');</script>";
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
        <title>Application Form</title>
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
                        <h1 class="mt-4"><?php //echo $_GET['apartment_id']; ?> Application Form</h1>
                        <hr />
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Kindly fill out informations here.</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="card text-white">
                                    <div class="card-body text-dark">

                                    <?php
                                        $query = mysqli_query($con, "SELECT * FROM users WHERE id = '".$_SESSION['id']."'");
                                        while($result = mysqli_fetch_array($query)) { ?>

                                        <form method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Name :</label>
                                                    <input type="text" class="form-control" name="fullname" value="<?php echo $result['fname']. " " . $result['lname']; ?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Phone number :</label>
                                                    <input type="number" class="form-control" name="phone" value="<?php echo $result['contactno']; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email :</label>
                                                <input type="email" class="form-control" name="email" value="<?php echo $result['email']; ?>" readonly>
                                            </div>
                                            <div class="form-group pb-3">
                                                <label>Current address :</label>
                                                <input type="text" class="form-control" name="cAddress" placeholder="(Brgy, Street, City)" required>
                                            </div>
                                            <div class="row pb-3">
                                                <div class="col-md-4">
                                                    <label>Occupation :</label>
                                                    <input type="text" class="form-control" name="occupation" placeholder="Occupation" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Monthly income :</label>
                                                    <input type="text" class="form-control" name="income" placeholder="Estimated only" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Unit type :</label>

                                                    <?php
                                                        if ($_GET['identifier'] == 1) {
                                                            if ($_GET['loc'] == 'bulacan') {
                                                                echo '<input type="text" class="form-control" name="Utype" value="Apartment Bulacan" readonly>';
                                                            } else {
                                                                echo '<input type="text" class="form-control" name="Utype" value="Apartment Valenzuela" readonly>';
                                                            }
                                                        } else {
                                                            if ($_GET['loc'] == 'bulacan') {
                                                                echo '<input type="text" class="form-control" name="Utype" value="Commercial Bulacan" readonly>';
                                                            } else {
                                                                echo '<input type="text" class="form-control" name="Utype" value="Commercial Valenzuela" readonly>';
                                                            }
                                                        }
                                                        
                                                    ?>

                                                    
                                                </div>
                                            </div>
                                            <div class="row pb-3">
                                                <div class="col-md-6">
                                                    <label>Moveins :</label>
                                                    <input type="text" class="form-control" name="moveins" placeholder="Number of Persons Moving In" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Preferred Move-in Date :</label>
                                                    <input type="date" class="form-control" name="moveDate" required>
                                                </div>
                                            </div>
                                            <div class="form-group pb-3">
                                                <label>Do you have pets?</label>
                                                <input type="radio" name="pet" value="yes" required>
                                                <label>Yes</label>
                                                <input type="radio" name="pet" value="no" required>
                                                <label>No</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputAddress">Upload any valid id :</label>
                                                <input type="file" class="form-control" name="valid_id" required>
                                            </div><hr>
                                            <div class="form-group">
                                                <button type="submit" name="submit" class="form-control btn btn-primary text-uppercase">Apply Now</button>
                                            </div>
                                        </form>

                                        <?php } ?>

                                    </div>
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
