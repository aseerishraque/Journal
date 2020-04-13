<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin')
    header('location: login.php');
include_once('../vendor/autoload.php')

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
                <h1 class="h3 mb-4 text-gray-800">Journal Entry</h1>

                <div class="row">

                    <div class="col-md-6">

                        <form action="backend/store.php" method="post">


                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputDate">Date</label>
                                    <input value="<?php echo date('Y-m-d') ?>" name="date" class="form-control" type="date">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Item Type</label>
                                    </div>
                                    <select name="item_id" class="custom-select" id="item">
                                        <option value="0" selected>Choose...</option>
                                        <?php
                                        use App\Item;
                                        $obj = new Item();
                                        $data = $obj->showData($obj->table);
                                        foreach ($data as $value){

                                            ?>
                                            <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                                        <?php
                                        }
                                        ?>





                                    </select>
                                </div>

                            </div>

                            <div id="userForm" class="form-row">

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">

                                    <div id="disabledAmount">

                                    </div>
                                </div>





                            </div>
                            <div class="form-row">
                                <div id="shareForm" class="form-group col-md-6">

                                </div>
                            </div>






                            <!-- Button trigger modal -->
                            <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Submit
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you Sure to Entry ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button name="proceed" type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </form>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include_once('includes/footer.php') ?>
