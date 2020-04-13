<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'user')
    header('location: login.php');



if(!isset($_SESSION['user_id']))
    header('location: login.php');
include_once('../vendor/autoload.php');

use App\User;

$userdb = new User();
$user = $userdb->getById($_SESSION['user_id'], $userdb->table);
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
                <h1 class="h3 mb-2 text-gray-800">All Users</h1>
                <!--                <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>-->

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">

                            Edit User

                        </h6>
                    </div>
                    <form action="backend/update_user_information.php" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                        <div class="card-body p-2">
                            <!-- Nested Row within Card Body -->



                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="title">Full Name</label>
                                            <input value="<?php echo $user['name'] ?>" name="name" type="text" id="name" class="form-control" placeholder="Full Name" required="required" >

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="username">Username</label>
                                            <input type="hidden" name="username" value="<?php echo $user['username'] ?>">
                                            <input disabled value="<?php echo $user['username'] ?>" type="text" id="username" class="form-control" placeholder="username" required="required">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="email">Email</label>
                                            <input value="<?php echo $user['email'] ?>" name="email" type="text" id="email" class="form-control" placeholder="email" required="required">

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="form-row">
                                    <!--                                    <div class="col-md-4">-->
                                    <!--                                        <div class="form-label-group">-->
                                    <!--                                            <label for="pass">pass</label>-->
                                    <!--                                            <input name="pass" type="text" id="title" class="form-control" placeholder="pass" required="required" >-->
                                    <!---->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->
                                    <!--                                    <div class="col-md-4">-->
                                    <!--                                        <div class="form-label-group">-->
                                    <!--                                            <label for="repass">Re-Enter Password</label>-->
                                    <!--                                            <input name="repass" type="text" id="repass" class="form-control" placeholder="repass" required="required">-->
                                    <!---->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->

                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="NID">NID</label>
                                            <input value="<?php echo $user['NID'] ?>" name="NID" type="text" id="NID" class="form-control" placeholder="NID" required="required">

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="NID_name">NID Name</label>
                                            <input value="<?php echo $user['NID_name'] ?>" name="NID_name" type="text" id="NID_name" class="form-control" placeholder="NID_name" required="required" >

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="name_bangla">Name Bangla</label>
                                            <input value="<?php echo $user['name_bangla'] ?>" name="name_bangla" type="text" id="name_bangla" class="form-control" placeholder="name_bangla" >

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="short_description">Gender</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="0">Select</option>
                                                <option <?php if ($user['gender'] == 'Male') echo 'selected' ?> value="Male">Male</option>
                                                <option <?php if ($user['gender'] == 'Female') echo 'selected' ?> value="Female">Female</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="present_division">Present Division</label>
                                            <input value="<?php echo $user['present_division'] ?>" name="present_division" type="text" id="present_division" class="form-control" placeholder="present_division"  >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="present_district">Present District</label>
                                            <input value="<?php echo $user['present_district'] ?>" name="present_district" type="text" id="present_district" class="form-control" placeholder="present_district" >

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="present_address">Present Address</label>
                                            <input value="<?php echo $user['present_address'] ?>" name="present_address" type="text" id="present_address" class="form-control" placeholder="present_address" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="permanent_division">Permanent Division</label>
                                            <input value="<?php echo $user['permanent_division'] ?>" name="permanent_division" type="text" id="permanent_division" class="form-control" placeholder="permanent_division" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="permanent_district">Permanent District</label>
                                            <input value="<?php echo $user['permanent_district'] ?>" name="permanent_district" type="text" id="permanent_district" class="form-control" placeholder="permanent_district" >

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="permanent_address">Permanent Address</label>
                                            <input value="<?php echo $user['permanent_address'] ?>" name="permanent_address" type="text" id="permanent_address" class="form-control" placeholder="permanent_address" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="profession">Profession</label>
                                            <input value="<?php echo $user['profession'] ?>" name="profession" type="text" id="profession" class="form-control" placeholder="profession"  >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="mobile">Mobile</label>
                                            <input value="<?php echo $user['mobile'] ?>" name="mobile" type="text" id="mobile" class="form-control" placeholder="mobile" required="required">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="fb_id">Facebook ID</label>
                                            <input value="<?php echo $user['fb_id'] ?>" name="fb_id" type="text" id="fb_id" class="form-control" placeholder="fb_id" >
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="father_name">Father's Name</label>
                                            <input value="<?php echo $user['father_name'] ?>" name="father_name" type="text" id="father_name" class="form-control" placeholder="father_name" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="father_mobile">Father's Mobile</label>
                                            <input value="<?php echo $user['father_mobile'] ?>" name="father_mobile" type="text" id="father_mobile" class="form-control" placeholder="father_mobile" >

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="mother_name">Mother's Name</label>
                                            <input value="<?php echo $user['mother_name'] ?>" name="mother_name" type="text" id="mother_name" class="form-control" placeholder="mother_name" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="mother_mobile">Mother's Mobile</label>
                                            <input value="<?php echo $user['mother_mobile'] ?>" name="mother_mobile" type="text" id="mother_mobile" class="form-control" placeholder="mother_mobile" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="spouse_name">Spouse Name</label>
                                            <input value="<?php echo $user['spouse_name'] ?>" name="spouse_name" type="text" id="spouse_name" class="form-control" placeholder="spouse_name" >

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="spouse_mobile">Spouse Mobile</label>
                                            <input value="<?php echo $user['spouse_mobile'] ?>" name="spouse_mobile" type="text" id="spouse_mobile" class="form-control" placeholder="spouse_mobile" >
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="nominee_name">Nominee's Name</label>
                                            <input value="<?php echo $user['nominee_name'] ?>" name="nominee_name" type="text" id="nominee_name" class="form-control" placeholder="nominee_name" required="required" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="nominee_info">Nominee's Information</label>
                                            <input value="<?php echo $user['nominee_info'] ?>" name="nominee_info" type="text" id="nominee_info" class="form-control" placeholder="nominee_info" required="required">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="nominee_info_details">Nominee's relation with the investor</label>
                                            <input value="<?php echo $user['nominee_info_details'] ?>" name="nominee_info_details" type="text" id="nominee_info_details" class="form-control" placeholder="" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="bank">Bank Name</label>
                                            <input value="<?php echo $user['bank'] ?>" name="bank" type="text" id="bank" class="form-control" placeholder="bank" required="required" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="bank_acc">Bank's account number</label>
                                            <input value="<?php echo $user['bank_acc'] ?>" name="bank_acc" type="text" id="bank_acc" class="form-control" placeholder="bank_acc" required="required">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="bank_acc_branch">Branch</label>
                                            <input value="<?php echo $user['bank_acc_branch'] ?>" name="bank_acc_branch" type="text" id="bank_acc_branch" class="form-control" placeholder="bank_acc_branch" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="bkash">bkash number</label>
                                            <input value="<?php echo $user['bkash'] ?>" name="bkash" type="text" id="bkash" class="form-control" placeholder="bkash" required="required" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="bkash_type">Bkash Type</label>
                                            <select name="bkash_type" id="bkash_type" class="form-control" required="required">
                                                <option value="0">Select</option>
                                                <option <?php if ($user['bkash_type'] == 'Personal') echo 'selected' ?> value="Personal">Personal</option>
                                                <option <?php if ($user['bkash_type'] == 'Agent') echo 'selected' ?> value="Agent">Agent</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="rocket">rocket number</label>
                                            <input value="<?php echo $user['rocket'] ?>" name="rocket" type="text" id="rocket" class="form-control" placeholder="rocket" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="rocket_type">rocket_type</label>
                                            <select  name="rocket_type" id="rocket_type" class="form-control" required="required">
                                                <option value="0">Select</option>
                                                <option <?php if ($user['rocket_type'] == 'Personal') echo 'selected' ?> value="Personal">Personal</option>
                                                <option <?php if ($user['rocket_type'] == 'Agent') echo 'selected' ?> value="Agent">Agent</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>


                            <div class="form-group">

                                <div class="col-md-4">
                                    <div class="form-label-group">
                                        <input name="update" class="btn btn-primary" type="submit" value="Update Info">

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
