<?php 
    session_start();
    require_once('includes/config.php');

    //Code for Registration 
    if(isset($_POST['submit']))
    {
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $confirmpassword=$_POST['confirmpassword'];
        $contact=$_POST['contact'];
        
        $sql=mysqli_query($con,"select id from users where email='$email'");
        $row=mysqli_num_rows($sql);

        if($password!=$confirmpassword) {

            // echo "<script>alert('Password and Confirm Password field does not match');</script>";
            $_SESSION['err_msg_for_pwrd'] = 'Password and Confirm Password field does not match';
            // Redirect to prevent resubmission
            header("Location: signup.php");
            exit;

        } else {
            if($row>0) {
                // echo "<script>alert('Email id already exist with another account. Please try with other email id');</script>";
                $_SESSION['err_msg_for_email'] = 'Email ID already exist with another account. Please try with other Email ID';
                // Redirect to prevent resubmission
                header("Location: signup.php");
                exit;
            
            } else { 
                $msg=mysqli_query($con,"insert into users(fname,lname,email,password,contactno) values('$fname','$lname','$email','$password','$contact')");
    
                if($msg)
                {
                    $_SESSION['registration_success'] = true;
                    header("Location: signup.php");
                    exit;
                    //echo "<script>alert('Registered successfully');</script>";
                    //echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
                }
            }
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
    <title>Tenants Signup</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-4">
                                <div class="card-header">
                                    <h3 class="text-uppercase font-weight-light mt-2 mb-0" style="font-family:'Arial Black'; font-size:35px; text-align:center;">
                                        Create Account
                                    </h3>
                                    <p class="text-center text-muted m-0">
                                        Please fill in your details to create your tenant account and access your dashboard.
                                    </p>
                                </div>
                                    <div class="card-body">
                                    <form method="post">  
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="fname" name="fname" type="text" placeholder="Enter your first name" required />
                                                    <label for="inputFirstName">First name</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" id="lname" name="lname" type="text" placeholder="Enter your last name" required />
                                                    <label for="inputLastName">Last name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                            if (isset($_SESSION['err_msg_for_email'])) {
                                                echo '<div class="alert bg-danger text-white">
                                                        <i class="fa fa-exclamation-triangle"></i> 
                                                        ' . $_SESSION['err_msg_for_email'] . '
                                                    </div>';
                                                unset($_SESSION['err_msg_for_email']);
                                            }
                                        ?>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="email" name="email" type="email" placeholder="phpgurukulteam@gmail.com" required />
                                            <label for="inputEmail">Email address</label>
                                        </div>
 
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="contact" name="contact" type="number" placeholder="1234567890" min="0" oninput="this.value = this.value.slice(0, 11);" required />
                                            <label for="inputcontact">Contact Number</label>
                                        </div>

                                        <?php
                                            if (isset($_SESSION['err_msg_for_pwrd'])) {
                                                echo '<div class="alert bg-danger text-white">
                                                        <i class="fa fa-exclamation-triangle"></i> 
                                                        ' . $_SESSION['err_msg_for_pwrd'] . '
                                                    </div>';
                                                unset($_SESSION['err_msg_for_pwrd']);
                                            }
                                        ?>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="password" name="password" type="password" placeholder="Create a password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required/>
                                                    <label for="inputPassword">Password</label>
                                                </div>
                                            </div>
                                                
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="confirmpassword" name="confirmpassword" type="password" placeholder="Confirm password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required />
                                                    <label for="inputPasswordConfirm">Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>
                                            
                                        <div class="mt-2 mb-0">
                                            <div class="d-grid"><button type="submit" class="btn btn-primary btn-block" name="submit">Create Account</button></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="index.php">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <?php //include_once('includes/footer.php');?>
    </div>

    <?php if (isset($_SESSION['registration_success'])): ?>
    <!-- Bootstrap Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content text-center">
        <div class="modal-header border-0">
            <h1 class="modal-title w-100 text-success" id="successModalLabel">
                <i class="fas fa-check-circle me-2"></i>
                Success
            </h1>
        </div>
        <div class="modal-body pt-0">
            <p class="mb-3">You have registered successfully!</p>
            <a href="index.php" class="btn btn-success">Go to Login</a>
        </div>
        </div>
    </div>
    </div>

    <script>
        // Show the modal after page loads
        window.addEventListener('DOMContentLoaded', (event) => {
            var myModal = new bootstrap.Modal(document.getElementById('successModal'), {
                keyboard: false
            });
            myModal.show();
        });
    </script>
    <?php unset($_SESSION['registration_success']); ?>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
