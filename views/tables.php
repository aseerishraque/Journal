<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin')
    header('location: login.php');
include_once('../vendor/autoload.php');
use App\Entry;
use App\Utilities;
use App\User;
use App\Share;
use App\MultiEntry;
use App\Transfer;
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
            <table hidden id="tblData_to_excel" >
                <thead>
                <tr>
                    <th colspan="7">Full Ledger</th>
                </tr>
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
                            <td><?php echo $value['name'] ?>
                            </td>
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


                $shareUsers = $obj->getEntryUserIds();

                foreach ($shareUsers as $user)
                {
                    $userdb = new User();

                    $userInfo = $userdb->getById($user, $userdb->table);
                    $share_quantity = $userdb->getUserShareQuantity($user);
                    $balance = $userdb->getBalance($user);
                    ?>
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                    <tr>
                        <th colspan="7">User ID: <?php echo $user ?></th>
                    </tr>
                    <tr>
                        <th colspan="7"><?php echo $userInfo['name'] ?></th>
                    </tr>
                    <tr>
                        <th colspan="7">Current Balance: BDT <?php echo number_format($balance, 2) ?></th>
                    </tr>
                    <tr>
                        <th colspan="7">Share(s): <?php echo $share_quantity ?> </th>
                    </tr>
                    <tr>

                        <th>Date</th>
                        <th colspan="3">Item</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Balance</th>

                    </tr>
                    <?php
                    $obj = new Entry();
                    $All = $obj->showUserJournal($user);
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
                                <td colspan="3"><?php echo $value['item']?></td>
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
                    <?php
                }
                ?>

                </tbody>

            </table>
<?php include_once("includes/generate_report_btn.php") ?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Full Ledger</h1>


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
                      <th>Delete</th>
                    </tr>
                  </thead>

                  <tbody>
                  <?php


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
                          <td>
                              <!-- Button trigger modal -->
                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $value['id']?>">
                                 Delete
                              </button>

                              <!-- Modal -->
                              <div class="modal fade" id="exampleModal<?php echo $value['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          <div class="modal-body">
                                             Are yuo sure to delete the Entry?
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <a  href="backend/delete_entry.php?entry_id=<?php echo $value['id']?>" class="btn btn-danger">Delete</a>
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
                        <th>Item</th>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Balance</th>
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
