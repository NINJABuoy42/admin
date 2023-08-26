<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location:login.php');
    die;
}
$user = $_SESSION['user'];
$title = 'Prescribed Patients';
$portal = "Prescribed Patients List";
include('../includes/header.php');
// include('./db_conn/user.php');
include('../db_conn/apiRegister.php');
// $result = getPatientDetail();
$fetchedPrescription = fetchPrescription();


// if (isset($_GET['delete'])) {
//     $dels = $_GET['delete'];
//     delete($dels);
// }
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



                <div class="container-fluid">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Patient List : Prescribed</h6>
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
                                        <?php while ($prescription = mysqli_fetch_assoc($fetchedPrescription)) {
                                            include('../includes/modals/__deleteModal.php');
                                        ?>
                                        <tr>
                                            <td><?php echo $prescription['prescription_id'] ?></td>
                                            <td><?php echo $prescription['patient_id'] ?></td>
                                            <td><?php echo $prescription['name'] ?></td>
                                            <td><?php echo $prescription['attending_doctor'] ?></td>
                                            <td><?php echo date("Y-m-d", strtotime($prescription['visit_date'])) ?></td>
                                            <td class="d-flex justify-content-around">
                                                <?php if($_SESSION['role']=='doctor' && $prescription['attending_doctor']==$user ){
                                                    ?>
                                                <a class="btn btn-info"
                                                    href="../doctor/doctorPortal.php?prescription_id=<?php echo $prescription['prescription_id'].'&patient_id='.$prescription['patient_id'] ?> "><i
                                                        class="fas fa-edit"></i></a>

                                                <?php
                                                } ?>
                                                <a class="btn btn-secondary"
                                                    href="prescription.php?prescription_id=<?php echo $prescription['prescription_id'].'&patient_id='.$prescription['patient_id'] ?> "
                                                    onclick="window.open(this.href, '_blank', 'width=975,height=700'); return false;"><i
                                                        class="fas fa-print"></i></a>
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
    <script>
    $('#dataTable').dataTable({
        "ordering": false
    });
    </script>

    <!-- End of Content Wrapper -->

    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->