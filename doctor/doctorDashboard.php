<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location:../public/login.php');
    die;
}
if ($_SESSION['role'] != 'doctor') {
    header('location:../public/index.php');
    die;
}
$user = $_SESSION['user'];
$title = 'Dashboard';
include('../includes/header.php');
$portal = "Doctor's Dashboard";
?>


<body id="page-top">
    <div id="wrapper">
        <?php include('../includes/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('../includes/nav.php') ?>
                <div class="container-fluid">

                <?php include('../includes/status.php'); ?>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="card border-left-success d-flex align-items-center col-xl-3 col-md-6 mb-4  mr-4">
                            <a class="btn" href="patientWaitingList.php">
                            <div class=" card-body col-auto">
                                <i class="fas fa-users fa-6x text-success"></i>
                                <div class="col-auto text-lg font-weight-bold text-success text-uppercase mb-1">PATIENT LIST</div>
                            </div>
                            </a>
                        </div>
                        <div class="card border-left-primary d-flex align-items-center col-xl-3 col-md-6 mb-4  mr-4">
                            <a class="btn" href="../public/patientDetails.php">
                                <div class=" card-body col-auto">
                                    <i class="fas fa-search fa-6x text-primary"></i>
                                    <div class="col-auto text-lg font-weight-bold text-primary text-uppercase mb-1">SEARCH</div>
                                </div>
                            </a>
                        </div>
                        <div class="card border-left-info d-flex align-items-center col-xl-3 col-md-6 mb-4  mr-4">
                            <a class="btn" href="../public/patientList.php">
                                <div class=" card-body col-auto">
                                    <i class="fas fa-file-prescription fa-6x text-info"></i>
                                    <div class="col-auto text-lg font-weight-bold text-info text-uppercase mb-1">PRESCRIPTION</div>
                                </div>
                            </a>
                        </div>



                    </div>


                    <?php
                    include('../includes/footer.php'); ?>
                </div>
            </div>