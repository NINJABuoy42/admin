<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location:login.php');
    die;
}

$user = $_SESSION['user'];
$title = 'Invoice';
include('../includes/header.php');
include('../db_conn/apiRegister.php');
$portal="Patient Detail";

if(isset($_GET['patient_id'])  && isset($_GET['prescription_id'])){
    $patient_id = $_GET['patient_id'];
    $prescription_id=$_GET['prescription_id'];
}
$portal = "Invoice";
?>

<body id="page-top">
    <div id="wrapper">
        <?php include('../includes/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('../includes/nav.php') ?>
                <div class="container-fluid">
                    <main id="main" class="main">
                        <div class="card ">
                            <div class="card-body ">
                                <div class="row">
                                    <?php if(isset($patient_id) && isset($prescription_id)): ?>
                                    <div class="col-sm-6">
                                        <label for="prescription_id" class="form-label">Prescription ID</label>
                                        <input autocomplete="off" type="text" class="form-control" id="prescription_id" value="<?php echo $prescription_id ;?>" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="patient_id" class="form-label">Patient ID</label>
                                        <input autocomplete="off" type="text" class="form-control" id="patient_id" value="<?php echo $patient_id ;?>" readonly>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-sm-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input autocomplete="off" type="text" class="form-control" id="name">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="age" class="form-label">Age</label>
                                        <input autocomplete="off" type="text" class="form-control" id="age">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <?php
                include('../includes/footer.php'); ?>
                </div>
            </div>