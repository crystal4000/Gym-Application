<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include('edit_package.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Titan-Gym - Packages</title>

    <!-- Custom fonts for this template -->
    <link rel="stylesheet" href="./assets/font-awesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="css/sb-admin-2.min.css">

    <!-- Custom styles for this page -->
    <link href="./assets/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include 'sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include 'topbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Packages</h1>

                    <!-- DataTales Example -->
                    <?php

                    $sqlQuery = "SELECT package_id, package, days, time_from, time_to, amount FROM packages";
                    $resultSet = mysqli_query($mysqli, $sqlQuery) or die("database error:" . mysqli_error($mysqli));
                    ?>
                    <div class="card shadow mb-4">


                        <div class="card-body">
                            <button class="btn btn-primary btn-block btn-sm col-sm-2 float-right mb-2" data-toggle="modal" data-target="#newModal" type="button"><i class="fa fa-plus"></i> New Package</button>
                            <br>

                            <!--New Menber modal-->
                            <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Add New Package</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="add_package.php" method="POST">
                                                <div class="form-group">
                                                    Package ID <input type="number" class="form-control form-control-user"  id="exampleFirstName" placeholder="package ID " name="packageid">
                                                </div>
                                                <div class="form-group">
                                                    Package<input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Package Name" name="package_name">
                                                </div>
                                                <div class="form-group">
                                                    Days Avaliable<input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Days Avaliable" name="days">
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        Time From<input type="time" class="form-control form-control-user " id="exampleFirstName" placeholder="Time From" name="time_from">
                                                    </div>

                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        Time To<input type="time" class="form-control form-control-user "  id="exampleFirstName" placeholder="Time To" name="time_to">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <input type="number" class="form-control form-control-user" id="exampleInputEmail" placeholder="Amount" name="amount">
                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                                                    <input type="submit" class="btn btn-primary" value="Submit">
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Package ID</th>
                                            <th>Package</th>
                                            <th>Days</th>
                                            <th>Time From</th>
                                            <th>Time To</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php while ($package = mysqli_fetch_assoc($resultSet)) { ?>
                                            <tr>

                                                <td><?php echo $package['package_id']; ?></td>
                                                <td><?php echo $package['package']; ?></td>
                                                <td><?php echo $package['days']; ?></td>
                                                <td><?php echo $package['time_from']; ?></td>
                                                <td><?php echo $package['time_to']; ?></td>
                                                <td>$<?php echo $package['amount']; ?></td>

                                                <td class="d-flex">

                                                    <button class="btn btn-primary btn-sm mx-1" data-toggle="modal" data-target="#editPackModal<?php echo $package['package_id'] ?>">Edit</button>
                                                    <!--Edit Modal-->

                                                    <div class="modal fade" id="editPackModal<?php echo $package['package_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Edit Package</h5>
                                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form enctype="multipart/form-data" method="get">
                                                                        <div class="form-group">
                                                                            Package ID: <input type="number" class="form-control form-control-user" id="exampleFirstName" name="packageid" readonly value="<?php echo $package['package_id']; ?>">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            Package<input type="text" class="form-control form-control-user" id="exampleFirstName"  name="package_name" value="<?php echo $package['package']; ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            Days Avaliable<input type="text" class="form-control form-control-user" id="exampleFirstName" name="days" value="<?php echo $package['days']; ?>">
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                                                Time From<input type="time" class="form-control form-control-user " id="exampleFirstName" name="time_from" value="<?php echo $package['time_from']; ?>">
                                                                            </div>

                                                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                                                Time To<input type="time" class="form-control form-control-user "  id="exampleFirstName" name="time_to" value="<?php echo $package['time_to']; ?>">
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <input type="number" class="form-control form-control-user" id="exampleInputEmail" placeholder="Amount" name="amount" value="<?php echo $package['amount']; ?>">
                                                                        </div>

                                                                 <div class="float-right">
                                                                     <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                     <button name="updatepac" class="btn btn-primary">Edit</button>
                                                                 </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>



                                                    <button class="btn btn-danger btn-sm mx-1" data-toggle="modal" data-target="#deleteMemModal">Delete</button>
                                                    <!--Delete Modal-->
                                                     <div class="modal fade" id="deleteMemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">Select "Delete" below if you are ready to delete this record.</div>
                                                                <div class="modal-footer">
                                                                    <input type="reset" class="btn btn-secondary" data-dismiss="modal" value="Cancel">
                                                                    <a href="delete_package.php?package_id=<?php echo $package['package_id'] ?>" class="btn btn-danger">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>

                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include 'footer.php'; ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <script>
        $(document).ready(function() {
            $('#days').multiselect({
                nonSelectedText: 'Select Days'
            });
        });
    </script>

    <script src="./assets/js/edit_member_table.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="./assets/vendor/jquery/jquery.min.js"></script>
    <script src="./assets//vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="./assets//vendor/jquery.easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="./assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="./assets/datatables/jquery.dataTables.min.js"></script>
    <script src="./assets/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="./assets/js/demo/datatables-demo.js"></script>


</body>

</html>
