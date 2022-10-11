<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

//Check if there's a message coming to the page
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    echo "<script>alert($msg)</script>";
}


include('edit_member.php');
require_once "db_connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Titan-Gym - Members</title>

    <!-- Custom fonts for this template -->
    <link rel="stylesheet" href="./assets/font-awesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="css/sb-admin-2.min.css">

    <!-- Custom styles for this page -->
    <link href="./assets/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
                    <h1 class="h3 mb-2 text-gray-800">Members</h1>

                    <!-- DataTales Example -->
                    <?php

                    $sqlQuery = "SELECT member_id, firstname, lastname, email, gender, contact_info, address, package FROM members";
                    $resultSet = mysqli_query($mysqli, $sqlQuery) or die("database error:" . mysqli_error($mysqli));
                    ?>
                    <div class="card shadow mb-4">


                        <div class="card-body">
                            <button class="btn btn-primary btn-block btn-sm col-sm-2 float-right mb-2" data-toggle="modal" data-target="#newModal" type="button"><i class="fa fa-plus"></i> New</button>
                            <br>

                            <!--New Menber modal-->
                            <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Add New Member</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="add_member.php" method="POST">
                                                <div class="form-group">
                                                    <input type="number" class="form-control form-control-user" value="" id="exampleFirstName" placeholder="Member ID " name="memberid">
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <input type="text" class="form-control form-control-user " id="exampleFirstName" placeholder="First Name" name="firstname">
                                                    </div>

                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <input type="text" class="form-control form-control-user " value="" id="exampleFirstName" placeholder="Last Name" name="lastname">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email">
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <input type="text" class="form-control form-control-user " value="" id="exampleFirstName" placeholder="Contact +905333" name="contact">
                                                    </div>

                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <select name="gender" required class="form-control" id="">
                                                            <option value="" selected disabled>Select Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Address" name="address">
                                                </div>


                                                <div class="form-group">
                                                    <select name="package" id="package" class="form-control">
                                                        <option value="" selected disabled>Select Gym Package</option>
                                                        <?php
                                                        $packages = getPackages();
                                                        if ($packages) {
                                                            foreach ($packages as $package) { ?>
                                                                <option value="<?= $package['package']; ?>"><?= $package['package']; ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
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
                                            <th>Member ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Package</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php while ($member = mysqli_fetch_assoc($resultSet)) { ?>
                                            <tr>

                                                <td><?php echo $member['member_id']; ?></td>
                                                <td><?php echo $member['firstname'] . " " . $member['lastname']; ?></td>
                                                <td><?php echo $member['email']; ?></td>
                                                <td><?php echo $member['gender']; ?></td>
                                                <td><?php echo $member['contact_info']; ?></td>
                                                <td><?php echo $member['address']; ?></td>
                                                <td><?= $member['package']; ?></td>

                                                <td class="d-flex">
                                                  
                                                <button class="btn btn-primary btn-sm mx-1" data-toggle="modal" data-target="#editMemModal<?php echo $member['member_id'] ?>">Edit</button>
                                                    <!--Edit Modal-->

                                                    <div class="modal fade" id="editMemModal<?php echo $member['member_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Edit Member</h5>
                                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" enctype="multipart/form-data">
                                                                        <div class="form-group">
                                                                            Member ID: <input type="number" class="form-control form-control-user" id="exampleFirstName" name="memberid" readonly value="<?php echo $member['member_id']; ?>">
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                                                First Name: <input type="text" class="form-control form-control-user " id="exampleFirstName" name="firstname" value="<?php echo $member['firstname']; ?>">
                                                                            </div>

                                                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                                                Last Name: <input type="text" class="form-control form-control-user " id="exampleFirstName" name="lastname" value="<?php echo $member['lastname']; ?>">
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            Email: <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" value="<?php echo $member['email']; ?>">
                                                                        </div>

                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                                                Contact: <input type="text" class="form-control form-control-user " id="exampleFirstName" name="contact" value="<?php echo $member['contact_info']; ?>">
                                                                            </div>

                                                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                                                Gender: <input type="text" class="form-control form-control-user" id="exampleInputEmail" name="gender" value="<?php echo $member['gender']; ?>">
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            Address: <input type="text" class="form-control form-control-user" id="exampleFirstName" name="address" value="<?php echo $member['address']; ?>">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <select name="package" id="package" class="form-control">
                                                                                <option value="<?= $member['package']; ?>" selected disabled><?= $member['package']; ?></option>
                                                                                <?php
                                                                                $packages = getPackages();
                                                                                if ($packages) {
                                                                                    foreach ($packages as $package) { ?>
                                                                                        <option value="<?= $package['package']; ?>"><?= $package['package']; ?></option>
                                                                                <?php }
                                                                                } ?>
                                                                            </select>
                                                                        </div>

                                                                        <div class="float-right">
                                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                            <button name="updateinfo" class="btn btn-primary">Edit</button>
                                                                        </div>


                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>



                                                    <button class="btn btn-danger btn-sm mx-1" data-toggle="modal" data-target="#deleteMemModal<?php echo $member['member_id'] ?>">Delete</button>
                                                    <!--Delete Modal-->
                                                    <div class="modal fade" id="deleteMemModal<?php echo $member['member_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                    <a href="delete_member.php?memberid=<?php echo $member['member_id'] ?>" class="btn btn-danger">Delete</a>
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