<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location:login.php');
    die;
}

// if ($_SESSION['role']!='register') {
//     header('location:index.php');
//     die;
// }

$user = $_SESSION['user'];
$title = 'Patient Detail';
include('../includes/header.php');
include('../db_conn/apiRegister.php');
$portal="Patient Detail";

if(!isset($_GET['patient_id'])){
    // header('location:204.php');
}

$patient_id = $_GET['patient_id'];
$patientDetails = viewPatientDetail($patient_id);
$patientHistory = viewPatientHistory($patient_id);


if (isset($_POST['check_in'])) {
    $pId = $_POST['pId'];
    $pHeight = $_POST['height'];
    $pWeight = $_POST['weight'];
    $pBP = $_POST['blood_pressure'];
    $spo2 = $_POST['spo2'];
    $pulse = $_POST['pulse'];
    $attendingDoc = $_POST['attending_doctor'];
    $serviceType = $_POST['serviceType'];
    if($attendingDoc!=""){
        patientCheckIn($pBP, $pWeight, $pHeight,$pulse, $spo2, $pId, $attendingDoc,$serviceType);
    }
    header("location:../public/viewDetails.php?patient_id=$pId");
}
if(isset($_POST['p_Edit'])){
    $pId = $_POST['pId'];
    $pName = $_POST['pName'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone = $_POST['phoneNumber'];
    $mstatus = $_POST['maritialStatus'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $pin = $_POST['pinCode'];
    $address = $_POST['address'];
    patientEdit($pId,$pName,$age,$gender,$phone,$mstatus,$state,$district,$pin,$address);

}
$portal = "Doctors Dashboard";
?>

<body id="page-top">
    <div id="wrapper">
        <?php include('../includes/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('../includes/nav.php') ?>
                <div class="container-fluid">
                    <main id="main" class="main">
                        <?php
                        while ($patientDetail = mysqli_fetch_assoc($patientDetails)) {
                            include('../includes/modals/__patientCheckIn.php');
                            include('../includes/modals/__patientEdit.php');

                        ?>
                            <section class=" card section profile">
                                <div class="d-flex flex-row justify-content-between flex-wrap">
                                    <div class="d-flex flex-column col-xl-6">
                                        <div class="card-body profile-card d-flex flex-column align-items-center">
                                            <img src="../img/undraw_profile.svg" class="rounded-circle" width="100">
                                            <hr />
                                            <h5><strong>Patient ID: </strong><?php echo $patientDetail["patienId"]; ?></h5>
                                            <h5><?php echo $patientDetail["fullName"]; ?></h5>
                                            <h5><?php echo $patientDetail["age"]; ?>Y/<?php echo $patientDetail["gender"]; ?></h5>
                                        </div>
                                        <?php if($_SESSION['role']=='register'){ ?>
                                        <div class=" d-flex flex-row justify-content-around">
                                            <button type="button" class="btn btn-success m-2 col" id="checkIn" data-toggle="modal" data-bs-target="#verticalycentered" data-target="#checkin"><i class="far fa-address-card mr-1"></i>Check In</button>
                                            <button type="button" class="btn btn-info m-2 col" id="paEdit" data-toggle="modal" data-bs-target="#verticalycentered" data-target="#pEdit"><i class="fas fa-edit mr-1"></i>EDIT</button>
                                        </div>
                                        <?php } ?>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="card-body pt-3">
                                            <!-- Bordered Tabs -->
                                            <h4 class="card-title">Patient Details</h4>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label"><strong>Phone No.</strong></div>
                                                <div class="col-lg-9 col-md-8">+91<?php echo $patientDetail["phoneNumber"] ?></div>
                                                <div class="col-lg-3 col-md-4 label"><strong>Address</strong></div>
                                                <div class="col-lg-9 col-md-8"><?php echo $patientDetail["address"] . "-" . $patientDetail["district"] . "-" . $patientDetail["state"]; ?></div>
                                            </div>
                                            <h4 class="card-title pt-3">Emergency Contact Details</h4>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label"><strong>Name</strong></div>
                                                <div class="col-lg-9 col-md-8"><?php echo $patientDetail["emName"]; ?></div>
                                                <div class="col-lg-3 col-md-4 label"><strong>Relation</strong></div>
                                                <div class="col-lg-9 col-md-8"><?php echo $patientDetail["emRelation"]; ?></div>
                                                <div class="col-lg-3 col-md-4 label"><strong>Contact No.</strong></div>
                                                <div class="col-lg-9 col-md-8">+91<?php echo $patientDetail["emNumber"]; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Prescription ID</th>
                                                    <th>Doctor</th>
                                                    <th>Service</th>
                                                    <th>Amt/Status</th>
                                                    <th>Visit Date</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                 while ($pateintD = mysqli_fetch_assoc($patientHistory)) {
                                                     include('../includes/modals/__prescriptionEdit.php');
                                                ?>
                                                    <tr>
                                                        <td><?php echo $pateintD['prescription_id'] ?></td>
                                                        <td><?php echo $pateintD['attending_doctor'] ?></td>
                                                        <td><?php echo $pateintD['service'] ?></td>
                                                        <td>&#8377; <?php echo $pateintD['amount'] ?>/- | <span class="badge badge-pill badge-success"><?php echo $pateintD['amtStatus'] ?></span></td>
                                                        <td><?php echo $pateintD['visit_date'] ?></td>
                                                        <td class="d-flex justify-content-around">
                                                            <a class="btn btn-secondary" href="prescription.php?prescription_id=<?php echo $pateintD['prescription_id'].'&patient_id='.$pateintD['patient_id'] ?> " onclick="window.open(this.href, '_blank', 'width=975,height=700'); return false;"><i class="fas fa-print"></i></a>

                                                            <?php if($_SESSION['role']=='doctor'){
                                                    ?>
                                                <a class="btn btn-info"
                                                    href="../doctor/doctorPortal.php?prescription_id=<?php echo $pateintD['prescription_id'].'&patient_id='.$pateintD['patient_id'] ?> "><i
                                                        class="fas fa-edit"></i></a>

                                                <?php
                                                } ?>
                                                        </td>
                                                    </tr>

                                                <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>
                            <?php } ?>
                    </main>
                <?php
                include('../includes/footer.php'); ?>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $.ajax({
                        url: "./db_conn/getDoctors.php",
                        type: 'POST',
                        success: function(data) {
                            console.log(data);
                        }
                    })
                })
            </script>