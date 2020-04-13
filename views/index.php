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
$entrydb = new Entry();
$userdb = new User();
$sharedb = new Share();
$transferdb = new Transfer();
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



          <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Balance</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">BDT<?php echo number_format($entrydb->getTotalBalance(), 2)  ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calculator fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Users</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $userdb->totalUsers() ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Transfers</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $transferdb->totalTransfers()?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Shares</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $sharedb->totalShare() ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments-dollar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Capital</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">BDT<?php echo number_format($entrydb->totalByItem(1), 2)?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Profit</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">BDT<?php echo number_format($entrydb->totalByItem(4), 2)?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-success shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Loss</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800">BDT<?php echo number_format($entrydb->totalByItem(2), 2)?></div>
                              </div>
                              <div class="col-auto">
                                  <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Profit Withdrawn</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">BDT<?php echo number_format($entrydb->totalByItem(3), 2)?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments-dollar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Capital Withdrawn</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">BDT<?php echo number_format($entrydb->totalByItem(5), 2) ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Remaining Profit</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">BDT<?php echo number_format($entrydb->current_profit_of_company(), 2) ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calculator fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!--            <div class="row">-->
                <!-- Earnings (Monthly) Card Example -->
<!--                <div class="col-xl-3 col-md-6 mb-4">-->
<!--                    <div class="card border-left-primary shadow h-100 py-2">-->
<!--                        <div class="card-body">-->
<!--                            <div class="row no-gutters align-items-center">-->
<!--                                <div class="col mr-2">-->
<!--                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Remaining Profit</div>-->
<!--                                    <div class="h5 mb-0 font-weight-bold text-gray-800">BDT--><?php //echo number_format($entrydb->current_profit_of_company()) ?><!--</div>-->
<!--                                </div>-->
<!--                                <div class="col-auto">-->
<!--                                    <i class="fas fa-calculator fa-2x text-gray-300"></i>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->



        

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
        <?php include_once('includes/footer.php') ?>

