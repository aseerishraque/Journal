<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once('../vendor/autoload.php');
use App\Utilities;

$d = new Utilities();
//$d->dd($_SESSION);

if (!isset($_SESSION['pass_verify']))
    header('Location: login.php');
?>
<?php include_once("includes/head.php") ?>

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">

                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Enter New Password</h1>


                                </div>
                                <form class="user" action="backend/new_password.php" method="post">



                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="form-label-group">
                                                    <label for="NID">New Password</label>
                                                    <input name="new_pass" type="password" id="new_pass" class="form-control" placeholder="Enter New Password" required="required">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="form-label-group">
                                                    <label for="NID">Re-Enter Password</label>
                                                    <input name="repass" type="password" id="repass" class="form-control" placeholder="Re-Enter Password" required="required">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <div class="col-md-12">
                                            <div class="form-label-group">
                                                <input name="update_pass" class="btn btn-primary" type="submit" value="Update Password">

                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <hr>
                                <div class="text-center">
                                    <a class="small" href="register.php">Create an Account!</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="login.php">Already have an account? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<?php include_once('includes/script.php')?>

</body>

</html>
