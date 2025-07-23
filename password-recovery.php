<?php
    session_start();
    include('includes/config.php');
    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception; 
    
    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);

    if(isset($_POST['send'])) {

        $femail=$_POST['femail'];

        $row1=mysqli_query($con,"select email,password,fname from users where email='$femail'");
        $row2=mysqli_fetch_array($row1);

        if($row2>0) {

            $toemail = $row2['email'];
            $fname = $row2['fname'];
            $subject = "Information about your password";
            $password=$row2['password'];
            $message = "Your password is ".$password;
            $mail->isSMTP();                            // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                     // Enable SMTP authentication
            $mail->Username = 'yourserver@gmail.com';    // SMTP username
            $mail->Password = '16 code';    // SMTP password
            $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                          // TCP port to connect to
            $mail->setFrom('yourserver@gmail.com','From Lopez Compound System');
            $mail->addAddress($toemail);   // Add a recipient
            $mail->isHTML(true);  // Set email format to HTML
            $bodyContent=$message;
            $mail->Subject =$subject;
            $bodyContent = 'Dear'." ".$fname;
            $bodyContent .='<p>'.$message.'</p>';
            $mail->Body = $bodyContent;

            if(!$mail->send()) {

                $_SESSION['err_msg'] = 'Message could not be sent.' . $mail->ErrorInfo;
                // Redirect to prevent resubmission
                header("Location: password-recovery.php");
                exit;
            } else {

                $_SESSION['recovery_sent_success'] = true;
                header("Location: password-recovery.php");
                exit;
            }
        } else {
            $_SESSION['err_msg'] = 'Email not register with us.';
            // Redirect to prevent resubmission
            header("Location: password-recovery.php");
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
        <title>Password Recovery</title>
        <link href="css/styles.css" rel="stylesheet" />
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
                                        <h3 class="font-weight-light text-uppercase m-0 my-4" style="font-family:'Arial Black'; font-size:30px; text-align:center;">Password Recovery</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="small mb-3 text-muted">Enter your email address and we will send you password on your email</div>
                                        <form method="post" id="loginForm">

                                            <?php
                                                if (isset($_SESSION['err_msg'])) {
                                                    echo '<div class="alert bg-danger text-white">
                                                            <i class="fa fa-exclamation-triangle"></i> 
                                                            ' . $_SESSION['err_msg'] . '
                                                        </div>';
                                                    unset($_SESSION['err_msg']);
                                                }
                                            ?>

                                            <!-- <div class="alert bg-danger text-white">
                                                <i class="fa fa-exclamation-triangle"></i> 
                                                Email ID already exist with another account. Please try with other Email ID
                                            </div> -->
                                           
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="femail" type="email" placeholder="name@example.com" required />
                                                <label for="inputEmail">Email address</label>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between mt-2 mb-0">
                                                <a class="small" href="index.php">Return to login</a>
                                                <button class="btn btn-primary" type="submit" name="send">Reset Password</button>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="signup.php">Need an account? Sign up now!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <?php //include('includes/footer.php');?>
        </div>

        <?php if (isset($_SESSION['recovery_sent_success'])): ?>
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
                <p class="mb-3">Your Password has been sent Successfully!</p>
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
        <?php unset($_SESSION['recovery_sent_success']); ?>
        <?php endif; ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
