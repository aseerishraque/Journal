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
                <h1 class="h3 mb-4 text-gray-800">Transfer Share</h1>
                <form action="backend/transfer_share.php" method="post">
                    <div class="row" >
                        <div class="col-md-6" style="border-right: 6px solid #d6d6d6;">
                            <h2>Seller </h2>
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="inputUserId">User ID(Recommended) </label>
                                    <input onkeyup="getUserName()" name="seller_id" type="number" class="form-control" id="user_id" placeholder="User ID">

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputName">Name</label>
                                    <input onkeyup="getUserId()"  type="text" class="form-control" id="user_name" placeholder="Name">
                                    <span id="userError">  </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="Balance">Balance</label>
                                    <input disabled type="number" class="form-control" id="balance" value="000">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="shareAmount">Share(s)</label>
                                    <input disabled type="number" class="form-control" id="shares" value="000">
                                </div>

<!--                                <div class="form-group col-md-12">-->
<!--                                    <label  for="inputAmount"><span id="amount_label" >Amount Per Share</span> </label>-->
<!--                                    <input type="hidden" value="1" id="amountHidden" name="amountHidden">-->
<!--                                    <input disabled type="number" class="form-control" id="amountPerSHare" value="1">-->
<!--                                </div>-->
                                <div class="form-group col-md-6">
                                    <label for="current_value_per_share">Current Value Per Share</label>
                                    <input readonly type="number" class="form-control" id="current_value_per_share" value="000" name="current_value_per_share">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="current_profit">Current Profit Per Share</label>
                                    <input readonly type="number" class="form-control" id="current_profit_per_share" value="000" name="current_profit_per_share">
                                </div>

                                <div class="form-group col-md-7">
                                    <label for="share">Number of Share(s) to be Transferred</label>
                                    <input onkeyup="transferShares()" name="shares" type="number" class="form-control" id="transferShare" value="1">
                                </div>

                                <div class="form-group col-md-7">
                                    <label for="date">Date</label>
                                    <input  name="date" type="date" class="form-control" id="date" value="<?php echo date('Y-m-d')?>">
                                </div>
                            </div>

                        </div>


                        <div class="col-md-6">
                            <h2>Buyer</h2>
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="inputUserId">User ID(Recommended) </label>
                                    <input onkeyup="getBuyerName()" name="buyer_id" type="number" class="form-control" id="buyer_id" placeholder="User ID">

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputName">Name</label>
                                    <input onkeyup="getBuyerId()"  type="text" class="form-control" id="buyer_name" placeholder="Name">
                                    <span id="buyerError">  </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="Balance">Balance</label>
                                    <input disabled type="number" class="form-control" id="buyer_balance" value="000">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="shareAmount">Share(s)</label>
                                    <input disabled type="number" class="form-control" id="buyer_shares" value="000">
                                </div>

<!--                                <div class="form-group col-md-12">-->
<!--                                    <label  for="inputAmount"><span id="amount_label" >Amount Per Share</span> </label>-->
<!--                                    <input type="hidden" value="1" id="buyersAmountPerSHareHidden" >-->
<!--                                    <input disabled type="number" class="form-control" id="buyersAmountPerSHare" value="1">-->
<!--                                </div>-->
                                <div class="form-group col-md-6">
                                    <label for="current_value_per_share">Current Value Per Share</label>
                                    <input readonly type="number" class="form-control" id="buyers_current_value_per_share" value="000" name="buyers_current_value_per_share">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="current_profit">Current Profit Per Share</label>
                                    <input readonly type="number" class="form-control" id="buyers_current_profit_per_share" value="000" name="buyers_current_profit_per_share">
                                </div>

                                <div class="form-group col-md-7">
                                    <label for="share">Number of Share(s) to be Added</label>
                                    <input disabled type="number" class="form-control" id="transferedShare" value="1">
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <!-- Button trigger modal -->
                            <a href="#" class="btn btn-success btn-icon-split mt-3" data-toggle="modal" data-target="#confirmTransfer">
                                <span class="icon text-white-50">
                                <i class="fas fa-exchange-alt"></i>
                                </span><span class="text">Transfer Share</span>
                            </a>


                            <!-- Modal -->
                            <div class="modal fade" id="confirmTransfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                          Are You Sure To Transfer ?

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--                                            <button type="button" class="btn btn-primary">Save changes</button>-->
                                            <input name="transferShare" class="btn btn-primary" type="submit" value="Transfer">
                                        </div>
                                    </div>
                                </div>
                            </div>






                        </div>
                    </div>
                </form>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include_once('includes/footer.php') ?>
