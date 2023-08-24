<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location:login.php');
    die;
}
$user = $_SESSION['user'];
$portal = 'Patient Waiting List';
$title = 'Waiting List';
include('./includes/header.php');
// include('./db_conn/user.php');
include('./db_conn/apiRegister.php');
include('./db_conn/apiDoctor.php');
// $result = getPatientDetail();
$fetchedPrescription = fetchWaitingPatient();
$fetched = fetchPrescription();


?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('./includes/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('./includes/nav.php') ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Patient List : Waiting</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="w-15">Prescription ID</th>
                                            <th class="w-15">Patient ID</th>
                                            <th class="w-25">Name</th>
                                            <th class="w-15">Prescribed By</th>
                                            <th class="w-15">Visit Date</th>
                                            <th class="w-15">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($list = mysqli_fetch_assoc($fetchedPrescription)) {
                                            include('./includes/modals/__deleteModal.php');
                                        ?>
                                            <tr>
                                                <td><?php echo $list['prescription_id'] ?></td>
                                                <td><?php echo $list['patient_id'] ?></td>
                                                <td><?php echo $list['name'] ?></td>
                                                <td><?php echo $list['attending_doctor'] ?></td>
                                                <td><?php echo date("Y-m-d", strtotime($list['visit_date'])) ?></td>
                                                <td class="d-flex justify-content-around">
                                                <a class="btn btn-success" href="doctorPortal.php?prescription_id=<?php echo $list['prescription_id'].'&patient_id='.$list['patient_id'] ?> "><i class="fas fa-file-prescription"></i></a>
                                                </td>
                                            </tr>
                                            
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <?php
                    include('./includes/footer.php');
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
