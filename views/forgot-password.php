<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once('../vendor/autoload.php');
use App\Utilities;

$d = new Utilities();
//$d->dd($_SESSION);
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
                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                    <p class="mb-4">We get it, stuff happens. Just enter the 6 DIGIT Number that is sent to you to reset your password! (Only For Admin)</p>

                  </div>
                  <form class="user" action="backend/verfy_password.php" method="post">

                      <div class="form-group">

                      <input name="token" type="number" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter 6 Digit Number...">
                    </div>


                      <div class="form-group">
                          <input name="reset_password" type="submit" class="form-control form-control-user btn btn-primary btn-user btn-block" value="Reset Password">
                      </div>
                  </form>
                                        <a href="backend/send_verification_password.php?send=ok" class="btn btn-info btn-user btn-block">
                                          Send Verification Mail
                                        </a>

                  <hr>
                    <?php
                    if (isset($_SESSION['info']))
                    {
                        ?>

                        <span class="alert alert-primary" role="alert">Please Check you Email!</span>

                    <?php
                    }elseif(isset($_GET['error']))
                    {
                        ?>
                        <span class="alert alert-danger" role="alert"> Verification Error! </span>
                    <?php
                    }
                    ?>



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
