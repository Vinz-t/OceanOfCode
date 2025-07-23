<?php 
    session_start(); 
    include_once('../includes/config.php');
    // Code for login 
    if(isset($_POST['login'])) {

        $adminusername=$_POST['username'];
        // $pass=md5($_POST['password']);
        $pass=$_POST['password'];
        $ret=mysqli_query($con,"SELECT * FROM admin WHERE username='$adminusername' and password='$pass'");
        $num=mysqli_fetch_array($ret);

        if($num>0) {
            $extra="dashboard.php";
            $_SESSION['login']=$_POST['username'];
            $_SESSION['adminid']=$num['id'];

            echo "<script>
                    document.addEventListener('DOMContentLoaded', function () {
                        document.getElementById('loginForm').style.display = 'none';
                        document.getElementById('loader').style.display = 'block';
                        setTimeout(function() {
                            window.location.href='".$extra."';
                        }, 1500);
                    });
                </script>";
        } else {
            $_SESSION['error_message'] = 'Incorrect username or password';
            // Redirect to prevent resubmission
            header("Location: index.php");
            exit;
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
    <title>Admin Login</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h2 class="text-uppercase">
                                        <!-- Logo -->
                                        <img src="../img/lopez-logo.png" alt="Lopez Compound Logo" style="max-width: 80px; height: auto;" />
                                        Lopez Compound
                                    </h2>
                                    <hr class="mt-1">
                                    <h3 class="font-weight-light text-uppercase m-0" style="font-family:'Arial Black'; font-size:35px; text-align:center;">
                                        Admin Login
                                    </h3>
                                    <p class="text-center text-muted m-0">
                                        Enter admin credentials to access the control panel.
                                    </p>
                                </div>
                                <div class="card-body">

                                    <div id="loader" style="display:none; text-align:center; margin-top:20px;">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <p class="mt-2">Logging in, please wait...</p>
                                    </div>

                                    <form method="post" id="loginForm">

                                        <?php
                                            if (isset($_SESSION['error_message'])) {
                                                echo '<div class="alert bg-danger text-white">
                                                        <i class="fa fa-exclamation-triangle"></i> 
                                                        ' . $_SESSION['error_message'] . '
                                                    </div>';
                                                unset($_SESSION['error_message']);
                                            }
                                        ?>
                                            
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="username" type="text" placeholder="Username"  required/>
                                            <label for="inputEmail">Username</label>
                                        </div>
                                            
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" type="password" placeholder="Password" required />
                                            <label for="inputPassword">Password</label>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-2 mb-0">
                                            <!-- <a class="small" href="password-recovery.php">Forgot Password?</a> -->
                                            <button class="btn btn-primary w-100" name="login" type="submit">Login</button>
                                        </div>
                                        <p class="text-muted small text-center m-0">
                                                ⚠️ For security, never share your login details. Only authorized users are permitted.
                                            </p>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-2">
                                    <div class="small"><a href="../index.php">Back to Tenants Login</a></div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <?php //include('../includes/footer.php');?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
    </body>
</html>
