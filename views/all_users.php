<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin')
    header('location: login.php');
?>

<!DOCTYPE html>
<html lang="en">


<?php include_once('includes/head.php') ?>
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

                            <a href="new_user.php" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus-square"></i>
                    </span>
                                <span class="text">New User</span>
                            </a>

                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                <thead>
                                <tr>

                                    <th>User ID</th>
                                    <th>Username</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Balance</th>
                                    <th>Edit</th>
                                    <th>Ledger</th>
                                    <th>Info</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                include_once('../vendor/autoload.php');
                                use App\User;
                                $obj = new User();
                                $All = $obj->showData($obj->table);
                                    foreach ($All as $value){
                                        ?>

                                        <tr>
                                            <td><?php echo $value['id']?>  </td>
                                            <td><a href="user_info.php?userid=<?php echo $value['id']?>"><?php echo $value['username']?></a></td>
                                            <td><?php echo $value['name']?></td>
                                            <td><?php echo $value['email'] ?></td>
                                            <td><?php echo number_format($obj->getBalance($value['id']), 2)?></td>
                                            <td><a href="edit_user.php?user_id=<?php echo $value['id'] ?>" class="btn btn-primary">Edit</a></td>
                                            <td><a href="single-user.php?user_id=<?php echo $value['id']?>" class="btn btn-primary">Ledger</a></td>
                                            <td><a href="user_info.php?userid=<?php echo $value['id']?>" class="btn btn-primary">Info</a></td>

                                            <td>

                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $value['id'] ?>">
                                                    Delete
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal<?php echo $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                               Are you sure to Delete <span class="text-danger" > <strong><?php echo $value['name']?> </strong></span>  and other Information?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <a href="backend/delete_user.php?user_id=<?php echo $value['id'] ?>" class="btn btn-danger" >Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>


                                        </tr>

                                        <?php

                                    }
                                ?>


                                </tbody>
                                <tfoot>
                                <tr>

                                    <th>User ID</th>
                                    <th>Username</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Balance</th>
                                    <th>Edit</th>
                                    <th>Ledger</th>
                                    <th>Info</th>
                                    <th>Delete</th>
                                </tr>
                                </tfoot>

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
