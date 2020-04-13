<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin')
    header('location: login.php');
if(!isset($_GET['user_id']))
    header('location: all_users.php');
include_once('../vendor/autoload.php');

use App\User;

$userdb = new User();
$user = $userdb->getById($_GET['user_id'], $userdb->table);
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
                <h1 class="h3 mb-2 text-gray-800"> Edit Password of <?php echo $user['name'] ?></h1>
                <!--                <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>-->

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">

                            Edit Password

                        </h6>
                    </div>
                    <form action="backend/reset_pass.php" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $_GET['user_id'] ?>">
                        <div class="card-body p-2">
                            <!-- Nested Row within Card Body -->
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="NID">New Password</label>
                                            <input name="new_pass" type="password" id="new_pass" class="form-control" placeholder="Enter New Password" required="required">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="NID">Re-Enter Password</label>
                                            <input name="repass" type="password" id="repass" class="form-control" placeholder="Re-Enter Password" required="required">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-md-4">
                                    <div class="form-label-group">
                                        <input name="update_pass" class="btn btn-primary" type="submit" value="Update Password">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include_once('includes/footer.php') ?>
