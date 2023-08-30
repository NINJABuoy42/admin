<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location:login.php');
    die;
}
$user = $_SESSION['user'];
$title = 'Search';
$portal = "Search:  Patients List";
include('../includes/header.php');
include('../db_conn/user.php');
$result = getPatientDetail();


if (isset($_GET['delete'])) {
    $dels = $_GET['delete'];
    delete($dels);
}
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('../includes/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('../includes/nav.php') ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">PATIENTS</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Patient ID</th>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Phone No.</th>
                                            <th>Reg_date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($rows = mysqli_fetch_assoc($result)) {
                                            include('../includes/modals/__deleteModal.php');
                                        ?>
                                            <tr>
                                                <td><?php echo $rows['patienId'] ?></td>
                                                <td><?php echo $rows['fullName'] ?></td>
                                                <td><?php echo $rows['age'] ?></td>
                                                <td><?php echo $rows['phoneNumber'] ?></td>
                                                <td><?php echo date("d-M-Y", strtotime($rows['regDate'])) ?></td>
                                                <td class="d-flex justify-content-around">
                                                    <!-- <a><button type="click" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                                        <i class="fas fa-trash"></i></button></a> -->
                                                    <a type="button"  class="btn btn-info" href="viewDetails.php?patient_id=<?php echo $rows['patienId'] ?>"><i class="fas fa-edit"></i></a>
                                                </td>
                                            </tr>
                                            
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <?php
                    include('../includes/footer.php');
                    ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
    </div>

    <!-- End of Content Wrapper -->

    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
