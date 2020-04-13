<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin')
    header('location: login.php');
if(!isset($_GET['userid']))
    header('Location:all_users.php');

include_once('../vendor/autoload.php');

use App\User;

$userdb = new User();
$user = $userdb->getById($_GET['userid'], $userdb->table);
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
                <h1 class="h3 mb-2 text-gray-800">User Information</h1>
                <!--                <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>-->

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">

                            <a href="edit_user.php?user_id=<?php echo $_GET['userid'] ?>" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-edit"></i>
                    </span>
                                <span class="text">Edit User</span>
                            </a>
                            <a href="reset_password.php?user_id=<?php echo $_GET['userid'] ?>" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-edit"></i>
                    </span>
                                <span class="text">Change Password</span>
                            </a>

                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th scope="row">Username</th>
                                    <td colspan="3"><?php echo $user['username'] ?></td>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">Full Name</th>
                                    <td><?php echo $user['name'] ?></td>
                                    <th scope="row">Email</th>
                                    <td><?php echo $user['email'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">NID</th>
                                    <td><?php echo $user['NID'] ?></td>
                                    <th scope="row">NID Name</th>
                                    <td><?php echo $user['NID_name'] ?></td>

                                </tr>
                                <tr>
                                    <th scope="row">Name(Bangla)</th>
                                    <td><?php echo $user['name_bangla'] ?></td>
                                    <th scope="row">Gender</th>
                                    <td><?php echo $user['gender'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Present Division</th>
                                    <td><?php echo $user['present_division'] ?></td>
                                    <th scope="row">Present District</th>
                                    <td><?php echo $user['present_district'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Present Address</th>
                                    <td><?php echo $user['present_address'] ?></td>
                                    <th scope="row">Permanent Division</th>
                                    <td><?php echo $user['permanent_division'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Permanent District</th>
                                    <td><?php echo $user['permanent_district'] ?></td>
                                    <th scope="row">Permanent Address</th>
                                    <td><?php echo $user['permanent_address'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Profession</th>
                                    <td><?php echo $user['profession'] ?></td>
                                    <th scope="row">Mobile</th>
                                    <td><?php echo $user['mobile'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Facebook Id</th>
                                    <td><?php echo $user['fb_id'] ?></td>
                                    <th scope="row">Father Name</th>
                                    <td><?php echo $user['father_name'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Father Mobile</th>
                                    <td><?php echo $user['father_mobile'] ?></td>
                                    <th scope="row">Mother Name</th>
                                    <td><?php echo $user['mother_name'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Mother Mobile</th>
                                    <td><?php echo $user['mother_mobile'] ?></td>
                                    <th scope="row">Spouse Name</th>
                                    <td><?php echo $user['spouse_name'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Spouse Mobile</th>
                                    <td><?php echo $user['spouse_mobile'] ?></td>
                                    <th scope="row">Nominee Name</th>
                                    <td><?php echo $user['nominee_name'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Nominee Information</th>
                                    <td><?php echo $user['nominee_info'] ?></td>
                                    <th scope="row">Nominee's relation with the investor</th>
                                    <td><?php echo $user['nominee_info_details'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Bank</th>
                                    <td><?php echo $user['bank'] ?></td>
                                    <th scope="row">Bank Account Number</th>
                                    <td><?php echo $user['bank_acc'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Bank Branch</th>
                                    <td><?php echo $user['bank_acc_branch'] ?> </td>
                                    <th scope="row">Bkash</th>
                                    <td><?php echo $user['bkash'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Bkash Type</th>
                                    <td><?php echo $user['bkash_type'] ?></td>
                                    <th scope="row">Rocket</th>
                                    <td><?php echo $user['rocket'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Rocket Type</th>
                                    <td colspan="3"><?php echo $user['rocket_type'] ?></td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include_once('includes/footer.php') ?>
