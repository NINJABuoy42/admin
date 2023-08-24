<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location:../login.php');
    die;
}
if ($_SESSION['role']!='admin') {
    header('location:../index.php');
    die;
}

$user = $_SESSION['user'];
$title = 'Dashboard';
$portal="Admin Dashboard";
include('./includes/header.php');
include('../db_conn/user.php');
?>


<body id="page-top">
    <div id="wrapper">
        <?php include('./includes/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('./includes/nav.php') ?>
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="row">
                        <div class=" card border-left-success d-flex align-items-center col-xl-3 col-md-6 mb-4  mr-4">
                            <a class="btn" href="user.php">
                                <div class=" card-body col-auto">
                                    <i class="fas fa-id-card-alt fa-6x text-success"></i>
                                </div>
                                <div class="col-auto text-lg font-weight-bold text-success text-uppercase mb-1">USERS</div>
                            </a>
                        </div>
                        <div class=" card border-left-primary d-flex align-items-center col-xl-3 col-md-6 mb-4  mr-4">
                            <a class="btn" href="patientDetails.php">
                                <div class=" card-body col-auto">
                                    <i class="fas fa-search fa-6x text-primary"></i>
                                </div>
                                <div class="col-auto text-lg font-weight-bold text-primary text-uppercase mb-1">SEARCH</div>
                            </a>
                        </div>
                        <div class=" btn card border-left-info d-flex align-items-center col-xl-3 col-md-6 mb-4  mr-4">
                            <a class="btn" href="#">
                                <div class=" card-body col-auto">
                                    <i class="fas fa-user-md fa-6x text-info"></i>
                                    <div class="col-auto text-lg font-weight-bold text-info text-uppercase mb-1">DOCTOR LIST</div>
                                </div>
                            </a>
                        </div>


                    </div>
                    <!-- Content Row -->


                    <?php
                    include('./includes/footer.php'); ?>
                </div>
            </div>