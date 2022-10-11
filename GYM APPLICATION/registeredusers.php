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
                    <h1 class="h3 mb-2 text-gray-800">Members Per Package</h1>

                    <!-- DataTales Example -->
                    <?php

                    $sqlQuery = "SELECT package_id, package, days, time_from, time_to, amount FROM packages";
                    $resultSet = mysqli_query($mysqli, $sqlQuery) or die("database error:" . mysqli_error($mysqli));
                    ?>
                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Package ID</th>
                                            <th>Package</th>
                                            <th>Amount</th>
                                            <th>Members</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php while ($package = mysqli_fetch_assoc($resultSet)) { ?>
                                            <tr>

                                                <td><?php echo $package['package_id']; ?></td>
                                                <td><?php echo $package['package']; ?></td>
                                                <td>$<?php echo $package['amount']; ?></td>
                                                <td>
                                                    <?php
                                                        $getUser = getRegisteredUsers($package['package']);
                                                        if (!empty($getUser)) {
                                                            foreach ($getUser as $user) {?>
                                                                <li><?=$user['firstname'] . " " .$user['lastname']; ?></li>
                                                        
                                                       
                                                    <?php } } else { ?>
                                                        <p>NO USER</p>
                                                    <?php } ?>
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
