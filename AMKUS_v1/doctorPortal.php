<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location:login.php');
    die;
}

if ($_SESSION['role'] != 'doctor') {
    header('location:index.php');
    die;
}

$user = $_SESSION['user'];
$title = 'Dashboard';
include('./includes/header.php');
// include('./db_conn/user.php');
include('./db_conn/apiDoctor.php');
// include('./db_conn/dbConn.php');

if(!isset($_GET['prescription_id'])){
    header('location:204.php');
}
$dataPatients = getPrescriptiontDetails($_GET['prescription_id'], $_GET['patient_id']);

// $data = mysqli_fetch_assoc(getUsers());
$portal = "Doctors Dashboard";

if (isset($_POST['save'])) {
    $result = updatePrescription();
}
?>

<body id="page-top">
    <div id="wrapper">
        <?php include('./includes/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('./includes/nav.php'); ?>
                <div class="container-fluid">

                    <div class="card ">
                        <div class="card-body ">
                            <!-- Multi Columns Form -->
                            <form class="row g-3 form-group" method="POST">
                                <h5 class="card-title col-md-12">Diagnosis/Prescription </h5>
                                <?php while ($dataPatient = mysqli_fetch_assoc($dataPatients)) { ?>
                                    <div class="col-md-4">
                                        <label for="prescription_id" class="form-label">Prescription ID</label>
                                        <input type="text" class="form-control" id="prescription_id" value="<?php echo $dataPatient['prescription_id'] ?>" name="prescription_id" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="patient_id" class="form-label">Patient ID</label>
                                        <input type="text" class="form-control" id="patient_id" value="<?php echo $dataPatient['patient_id'] ?>" name="patient_id" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" value="<?php echo $dataPatient['name'] ?>" name="name" readonly>
                                    </div>
                                
                                <div class="col-md-12">
                                    <label for="medicalHistory" class="form-label">Past Medical History</label>
                                    <input type="text" class="form-control" id="medicalHistory" name="medicalHistory" value="<?php echo $dataPatient['past_history'] ?>">
                                </div>
                                <div class="col-md-12">
                                    <label for="cheifComplaints" class="form-label">Chief Complaint</label>
                                    <input type="text" class="form-control" id="cheifComplaints" name="cheifComplaints" value="<?php echo $dataPatient['cheif_complaint'] ?>">
                                </div>
                                <div class="col-xl-12">
                                    <label for="diagnosis" class="form-label">Diagnosis/Provisional Diagnosis
                                    </label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="diagnosisF" placeholder="Diagnosis/Provisional Diagnosis here...">
                                        <div class="input-group-append">
                                            <button class="btn btn-success" id="addField" type="button"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <ol type="number_format" id="medDiagnosis">
                                    </ol>
                                </div>
                                <div class="col-md-12">
                                    <label for="note" class="form-label" >Additional Notes</label>
                                    <input type="text" class="form-control" id="note" name="note" value="<?php echo $dataPatient['note'] ?>">
                                </div>


                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="w-50">Medicine Name</th>
                                                <th class="w-25">Dosage</th>
                                                <th class="w-25">Duration</th>
                                                <th class="w-5">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tBody">
                                            <tr>
                                                <td class="w-50"><input type="text" class="form-control input" id="medName" placeholder="Medicine name here..."></td>
                                                <td class="w-25"><input type="text" class="form-control input" id='medDosage' placeholder="Dosage here ..."></td>
                                                <td class="w-25"><input type="text" class="form-control input" id='medDuration' placeholder="Duration here ..."></td>
                                                <th class="w-5"><button type="button" class="btn btn-success" id="add">ADD</button></th>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-12">
                                    <label for="referTo" class="form-label">Refer To:</label>
                                    <input type="text" class="form-control" id="referTo" name="referTo" value="<?php echo $dataPatient['refer_to'] ?>">
                                </div>
                                <div class="col-md-10">
                                    <label for="advice" class="form-label">Advice Given</label>
                                    <input type="text" class="form-control" id="referTo" name="advice" value="<?php echo $dataPatient['advice'] ?>">
                                </div>
                                <div class="col-md-2">
                                    <label for="followUP" class="form-label">Next Follow-up</label>
                                    <input type="date" class="form-control" id="followUP" name="followUP" value="<?php echo $dataPatient['follow_up'] ?>">
                                </div>
                                <!-- ********** -->
                                <?php } ?>
                                <hr>
                                <div class="text-center mt-3 col-md-12">
                                    <!-- <button type="button" class="btn btn-warning" name="getpatienId" id="getpatienId">Generate ID</button> -->
                                    <button type="submit" class="btn btn-success" name="save" id="save">Save & Verify</button>
                                    <button type="reset" class="btn btn-secondary" id="reset">Reset</button>
                                </div>
                            </form><!-- End Multi Columns Form -->

                        </div>
                    </div>


                    <?php
                    include('./includes/footer.php'); ?>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $("#add").on('click', (e) => {
                        // console.log("add");
                        html = `<tr>
                                    <td class="w-50"><input type="text" class="form-control input" name='medName[]' value=${$('#medName').val()}></td>
                                    <td class="w-25"><input type="text" class="form-control input" name='medDosage[]' value=${$('#medDosage').val()}></td>
                                    <td class="w-25"><input type="text" class="form-control input" name='medDuration[]' value=${$('#medDuration').val()}></td>
                                    <td class="w-5"><button type="button" class="btn btn-danger" onclick="this.closest('tr').remove();">REM</button></td>
                                </tr>`;
                        $('#medName').val('');
                        $('#medDosage').val('');
                        $('#medDuration').val('');
                        $('#tBody').append(html);

                    })
                    $("#addField").on('click', (e) => {
                        fieldHtml = `<li>
                        <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="diagnosis[]" value='${$('#diagnosisF').val()}'>
                                        <div class="input-group-append">
                                            <button class="btn btn-danger" id="addField" type="button" onclick="this.closest('li').remove();"><i class="fas fa-minus"></i></button>
                                        </div>
                                        </div>
                                        </li>`;
                        $('#diagnosisF').val("");
                        $("#medDiagnosis").append(fieldHtml);
                    })
                })
            </script>