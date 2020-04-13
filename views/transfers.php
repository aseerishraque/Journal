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
                <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">

                            <a href="share_transfer.php" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-flag"></i>
                    </span>
                                <span class="text">Make a new Transfer</span>
                            </a>

                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>

                                    <th>Date</th>
                                    <th>Transaction ID</th>
                                    <th>Seller</th>
                                    <th>Buyer</th>
                                    <th>Amount Per Share</th>
                                    <th>Shares</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                include_once('../vendor/autoload.php');
                                use App\Transfer;
                                $obj = new Transfer();
                                $All = $obj->allTransfers();
                                    foreach ($All as $value){
                                        ?>

                                        <tr>
                                            <td><?php echo $value['date']?>  </td>
                                            <td><?php echo $value['trxID']?></td>
                                            <td><?php echo $value['seller']?></td>
                                            <td><?php echo $value['buyer']?></td>
                                            <td><?php echo number_format($value['amount'], 2)?></td>
                                            <td><?php echo $value['total_shares']?></td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $value['trxID']?>">
                                                   Undo
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal<?php echo $value['trxID']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure to delete the Transfer?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <a  href="backend/rollback_transfers.php?trxID=<?php echo $value['trxID']?>" class="btn btn-danger">Delete</a>
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

                                    <th>Date</th>
                                    <th>Transaction ID</th>
                                    <th>Seller</th>
                                    <th>Buyer</th>
                                    <th>Amount Per Share</th>
                                    <th>Shares</th>
                                    <th>Action</th>
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
