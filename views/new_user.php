<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin')
    header('location: login.php');
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
                <h1 class="h3 mb-2 text-gray-800">New User Registeration</h1>
                <!--                <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>-->

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    </div>
                    <form action="backend/process_register.php?admin=1" method="post">
                        <div class="card-body p-2">
                            <!-- Nested Row within Card Body -->



                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="title">Full Name</label>
                                            <input name="name" type="text" id="name" class="form-control" placeholder="Enter Full Name" required="required" >

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="username">Username</label>
                                            <input name="username" type="text" id="username" class="form-control" placeholder="Enter Username" required="required">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="email">Email</label>
                                            <input name="email" type="text" id="email" class="form-control" placeholder="Enter Email" required="required">

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="pass">Password</label>
                                            <input name="pass" type="password" id="title" class="form-control" placeholder="Enter Password" required="required" >

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="repass">Re-Enter Password</label>
                                            <input name="repass" type="password" id="repass" class="form-control" placeholder="Re-Enter Password" required="required">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="NID">NID</label>
                                            <input name="NID" type="text" id="NID" class="form-control" placeholder="Enter NID number..." required="required">

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="NID_name">NID Name</label>
                                            <input name="NID_name" type="text" id="NID_name" class="form-control" placeholder="Enter NID Name" required="required" >

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="name_bangla">Name(Bangla)</label>
                                            <input name="name_bangla" type="text" id="name_bangla" class="form-control" placeholder="Enter Name(Bangla)" >

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="short_description">Gender</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="0">Select</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
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
                                            <input name="present_division" type="text" id="present_division" class="form-control" placeholder="Enter Your Present Division"  >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="present_district">Present District</label>
                                            <input name="present_district" type="text" id="present_district" class="form-control" placeholder="Enter Present District" >

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="present_address">Present Address</label>
                                            <input name="present_address" type="text" id="present_address" class="form-control" placeholder="Enter Present Address" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="permanent_division">Permanent Division</label>
                                            <input name="permanent_division" type="text" id="permanent_division" class="form-control" placeholder="Enter Permanent Division" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="permanent_district">Permanent District</label>
                                            <input name="permanent_district" type="text" id="permanent_district" class="form-control" placeholder="Enter Permanent District" >

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="permanent_address">Permanent Address</label>
                                            <input name="permanent_address" type="text" id="permanent_address" class="form-control" placeholder="Enter Permanent Address" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="profession">Profession</label>
                                            <input name="profession" type="text" id="profession" class="form-control" placeholder="Enter Profession"  >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="mobile">Mobile</label>
                                            <input name="mobile" type="text" id="mobile" class="form-control" placeholder="Enter Mobile" required="required">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="fb_id">Facebook ID</label>
                                            <input name="fb_id" type="text" id="fb_id" class="form-control" placeholder="https://www.facebook.com/username" >
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="father_name">Father's Name</label>
                                            <input name="father_name" type="text" id="father_name" class="form-control" placeholder="Enter Father's Name" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="father_mobile">Father's Mobile</label>
                                            <input name="father_mobile" type="text" id="father_mobile" class="form-control" placeholder="Enter Father's mobile" >

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="mother_name">Mother's Name</label>
                                            <input name="mother_name" type="text" id="mother_name" class="form-control" placeholder="Enter Mother's Name" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="mother_mobile">Mother's Mobile</label>
                                            <input name="mother_mobile" type="text" id="mother_mobile" class="form-control" placeholder="Enter Mother's Mobile" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="spouse_name">Spouse Name</label>
                                            <input name="spouse_name" type="text" id="spouse_name" class="form-control" placeholder="Enter Spouse Name" >

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="spouse_mobile">Spouse Mobile</label>
                                            <input name="spouse_mobile" type="text" id="spouse_mobile" class="form-control" placeholder="Enter Spouse Mobile" >
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="nominee_name">Nominee's Name</label>
                                            <input name="nominee_name" type="text" id="nominee_name" class="form-control" placeholder="Enter Nominee's Name" required="required" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="nominee_info">Nominee's Information</label>
                                            <input name="nominee_info" type="text" id="nominee_info" class="form-control" placeholder="Enter Nominee's Information" required="required">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="nominee_info_details">Nominee's relation with the investor</label>
                                            <input name="nominee_info_details" type="text" id="nominee_info_details" class="form-control" placeholder="" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="bank">Bank Name</label>
                                            <input name="bank" type="text" id="bank" class="form-control" placeholder="Enter Bank Name" required="required" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="bank_acc">Bank's account number</label>
                                            <input name="bank_acc" type="text" id="bank_acc" class="form-control" placeholder="Enter Bank's account number" required="required">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="bank_acc_branch">Branch</label>
                                            <input name="bank_acc_branch" type="text" id="bank_acc_branch" class="form-control" placeholder="Enter Branch" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="bkash">Bkash number</label>
                                            <input name="bkash" type="text" id="bkash" class="form-control" placeholder="Enter Bkash number" required="required" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="bkash_type">Bkash Type</label>
                                            <select name="bkash_type" id="bkash_type" class="form-control" required="required">
                                                <option value="0">Select</option>
                                                <option value="Personal">Personal</option>
                                                <option value="Agent">Agent</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="rocket">Rocket number</label>
                                            <input name="rocket" type="text" id="rocket" class="form-control" placeholder="Enter Rocket number" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-label-group">
                                            <label for="rocket_type">Rocket Type</label>
                                            <select name="rocket_type" id="rocket_type" class="form-control" required="required">
                                                <option value="0">Select</option>
                                                <option value="Personal">Personal</option>
                                                <option value="Agent">Agent</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>


                            <div class="form-group">

                                <div class="col-md-4">
                                    <div class="form-label-group">
                                        <input name="register" class="btn btn-primary" type="submit" value="Register">

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
