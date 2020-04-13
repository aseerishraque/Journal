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

                            <a href="new_entry.php" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-flag"></i>
                    </span>
                                <span class="text">New Entry</span>
                            </a>

                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>

                                    <th>Date</th>
                                    <th>Item</th>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                include_once('../vendor/autoload.php');
                                use App\Entry;
                                $obj = new Entry();
                                $All = $obj->showJournal();
                                $d = 0;
                                $c = 0;
                                $b = 0;
                                if ($All != 0)
                                    foreach ($All as $value){
                                        $d += $value['debit'];
                                        $c += $value['credit'];
                                        $b = $c - $d;
                                        ?>

                                        <tr>
                                            <td><?php echo $value['date']?>  </td>
                                            <td><?php echo $value['item']?></td>
                                            <td><?php
                                                if($value['user_id'] != 0)
                                                echo $value['user_id']?></td>
                                            <td><a href="single-user.php?user_id=<?php echo $value['user_id']?>"><?php echo $value['name'] ?></a> </td>
                                            <td><?php
                                                if($value['debit']!=0)
                                                    echo number_format($value['debit'], 2)?></td>
                                            <td><?php
                                                if ($value['credit']!=0)
                                                    echo number_format($value['credit'], 2)?></td>
                                            <td><?php echo number_format($b, 2)?></td>
                                        </tr>

                                        <?php

                                    }
                                ?>


                                </tbody>
                                <tfoot>
                                <tr>

                                    <th>Date</th>
                                    <th>Item</th>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
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
