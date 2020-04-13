<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin')
    header('location: login.php');
include_once('../vendor/autoload.php');

use App\User;
$userdb = new User();
$user = $userdb->getById(1, 'admin');

use App\Email;
$mail = new Email();
$showForm = $mail->getAdminCode();
?>
<!DOCTYPE html>
<html lang="en">


<?php include_once('includes/head.php')  ?>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include_once('includes/sidebar.php') ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include_once('includes/topbar.php') ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800"> Edit Settings </h1>
                <!--                <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>-->

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">

                            Here are some Information that can be edited

                        </h6>
                    </div>


                        <div class="card-body p-2">
                            <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-md-6">
                                <form action="backend/admin_reset_pass.php" method="post">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-9">
                                            <div class="form-label-group">
                                                <label for="title">Old Password</label>
                                                <input name="old_pass" type="password" id="old_pass" class="form-control" placeholder="Enter Old Password" required="required" >

                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-9">
                                            <div class="form-label-group">
                                                <label for="NID">New Password</label>
                                                <input name="new_pass" type="password" id="new_pass" class="form-control" placeholder="Enter New Password" required="required">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-9">
                                            <div class="form-label-group">
                                                <label for="NID">Re-Enter Password</label>
                                                <input name="repass" type="password" id="repass" class="form-control" placeholder="Re-Enter Password" required="required">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-md-8">
                                        <div class="form-label-group">
                                            <input name="update_pass" class="btn btn-primary" type="submit" value="Update Password">

                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <div class="col-md-6">

                                <form action="backend/set_admin_email.php" method="post">
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-9">
                                                <div class="form-label-group">
                                                    <label for="email">Email</label>
                                                    <input name="email" type="email" class="form-control" placeholder="Enter Email" required="required" value="<?php echo $user['email'] ?>" >

                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="form-group">

                                        <div class="col-md-8">
                                            <div class="form-label-group">
                                                <input name="update_email" class="btn btn-primary" type="submit" value="Update Email">

                                                <?php
                                                if ($user['email_verified'])
                                                {
                                                    ?>
                                                    <span class="btn btn-success btn-circle btn-sm">
                                                          <i class="fas fa-check"></i>
                                                      </span>
                                                    <span style="font-size: 12px;" >Email Verified</span>
                                                <?php
                                                }else{
                                                    ?>
                                                    <span href="#" class="btn btn-warning btn-circle btn-sm">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </span>
                                                    <span style="font-size: 12px;" >Email Not Verified</span>
                                                <?php
                                                }
                                                ?>




                                            </div>
                                        </div>
                                    </div>
                                </form>
                                    <?php
                                    if ($user['email_verified'] == 0)
                                    {

                                        ?>

                                        <!--Send Verification Mail-->
                                        <form action="backend/send_verification_mail.php" method="post">
                                            <input name="email" type="hidden" value="<?php echo $user['email'] ?>">
                                            <div class="form-group">
                                                <div class="col-md-8">
                                                    <div class="form-label-group">
                                                        <input name="send_verification" class="btn btn-info" type="submit" value="Send Verification Mail">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>



                                        <?php
                                        if ($showForm != false)
                                        {
                                            ?>

                                            <!--Input Verfication Code -->
                                            <form action="backend/verify_email.php" method="post">
                                                <input name="email" type="hidden" value="<?php echo $user['email'] ?>">


                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-9">
                                                            <div class="form-label-group">
                                                                <input name="code_mail" type="number" class="form-control" placeholder="Enter 6 Digit Number" required="required" value="<?php echo $user['email'] ?>" >

                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="form-label-group">
                                                                <input name="verify" class="btn btn-primary" type="submit" value="Verify">
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>



                                            </form>

                                            <?php
                                        }
                                        ?>



                                    <?php
                                    }
                                    ?>








                            </div>
                        </div>




                        </div>

                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">

                            Backup/Restore

                        </h6>
                    </div>


                    <div class="card-body p-2">
                        <!-- Nested Row within Card Body -->


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="title">Backup Data</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="col-md-9">
                                        <div class="form-label-group">
                                            <a href="backend/downloadDB.php?download=1" class="btn btn-info btn-icon-split">
                                                        <span class="icon text-white-50">
                                                          <i class="fas fa-info-circle"></i>
                                                        </span>
                                                <span class="text">Export All Data</span>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-row">
                                    <div class="col-md-9">
                                        <div class="form-label-group">
                                            <label for="title">Restore Data</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <a href="backend/downloadDB.php?download=1" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#restoreModal" >
                                                        <span class="icon text-white-50">
                                                          <i class="fas fa-info-circle"></i>
                                                        </span>
                                                <span class="text">Restore</span>
                                            </a>

<!--                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#restoreModal" >Open modal for @mdo</button>-->

                                            <!-- Button trigger modal -->


                                            <!-- Modal -->
                                            <div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Admin Credentials are Required!</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="backend/restore.php" enctype="multipart/form-data" method="post">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="username" class="col-form-label">Username:</label>
                                                                    <input name="username" type="text" class="form-control" id="username" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="password" class="col-form-label">Password:</label>
                                                                    <input name="password" type="password" class="form-control" id="password" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="import_file" class="col-form-label">File:</label>
                                                                    <input name="import_file" type="file" class="form-control" id="import" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <input name="import" type="submit" class="btn btn-primary" value="Restore">
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>




                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>

                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include_once('includes/footer.php') ?>
