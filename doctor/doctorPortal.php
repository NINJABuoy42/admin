<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location:login.php');
    die;
}

if ($_SESSION['role'] != 'doctor') {
    header('location:../public/index.php');
    die;
}

$user = $_SESSION['user'];
$title = 'Dashboard';
include('../includes/header.php');
// include('./db_conn/user.php');
include('../db_conn/apiDoctor.php');
// include('./db_conn/dbConn.php');

if(!isset($_GET['prescription_id'])){
    header('location:../public/204.php');
}
$dataPatients = getPrescriptiontDetails($_GET['prescription_id'], $_GET['patient_id']);

// $data = mysqli_fetch_assoc(getUsers());
$portal = "Doctors Dashboard";

if (isset($_POST['save'])) {
    $result = updatePrescription();
}
$diagnosis = getDiagnosis($_GET['prescription_id'], $_GET['patient_id']);
$medicine = getMedicine($_GET['prescription_id'], $_GET['patient_id']);
$clinicalPresentation = getClinicalPresentation($_GET['prescription_id'], $_GET['patient_id']);
$investigation = getInvestigation($_GET['prescription_id'], $_GET['patient_id']);
?>

<body id="page-top">
    <div id="wrapper">
        <?php include('../includes/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('../includes/nav.php'); ?>
                <div class="container-fluid">

                    <div class="card ">
                        <div class="card-body ">
                            <!-- Multi Columns Form -->
                            <?php while ($dataPatient = mysqli_fetch_assoc($dataPatients)) { ?>
                            <form class="row g-3 form-group"
                                method="<?php if($dataPatient['doc_id']==$_SESSION['user_id']){echo 'POST';} ?>">
                                <h5 class="card-title col-md-12">Diagnosis/Prescription </h5>
                                <div class="col-md-4">
                                    <label for="prescription_id" class="form-label">Prescription ID</label>
                                    <input autocomplete="off" type="text" class="form-control" id="prescription_id"
                                        value="<?php echo $dataPatient['prescription_id'] ?>" name="prescription_id"
                                        readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="patient_id" class="form-label">Patient ID</label>
                                    <input autocomplete="off" type="text" class="form-control" id="patient_id"
                                        value="<?php echo $dataPatient['patient_id'] ?>" name="patient_id" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input autocomplete="off" type="text" class="form-control" id="name"
                                        value="<?php echo $dataPatient['name'] ?>" name="name" readonly>
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="blood_pressure" class="form-label">B/P(in mmHH)</label>
                                    <input autocomplete="off" type="text" class="form-control" id="blood_pressure"
                                        value="<?php echo $dataPatient['blood_pressure'] ?>" name="blood_pressure">
                                </div>
                                <div class="col-md-3">
                                    <label for="pulse" class="form-label">Pulse(in bpm)</label>
                                    <input autocomplete="off" type="text" class="form-control" 
                                        value="<?php echo $dataPatient['pulse'] ?>" name="pulse">
                                </div>
                                <div class="col-md-2">
                                    <label for="spo2" class="form-label">SpO<sub>2</sub>(in %)</label>
                                    <input autocomplete="off" type="text" class="form-control" 
                                        value="<?php echo $dataPatient['spo2'] ?>" name="spo2">
                                </div>
                                <div class="col-md-2">
                                    <label for="height" class="form-label">Height(in cms)</label>
                                    <input autocomplete="off" type="text" class="form-control" 
                                        value="<?php echo $dataPatient['height'] ?>" name="height">
                                </div>
                                <div class="col-md-2">
                                    <label for="weight" class="form-label">Weight(in kgs)</label>
                                    <input autocomplete="off" type="text" class="form-control" id="weight"
                                        value="<?php echo $dataPatient['weight'] ?>" name="weight">
                                </div>
                                <!-- clinical presentations starts here -->
                                <div class="col-xl-12">
                                    <label for="clinicalPresentation" class="form-label">Clinical Presentation
                                    </label>
                                    <div class="input-group mb-3">
                                        <input autocomplete="off" type="text" class="form-control"
                                            id="clinicalPresentation" placeholder="Clinical Presentation here...">
                                        <div class="input-group-append">
                                            <button class="btn btn-success" id="addClinicalPresentation"
                                                type="button"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <ul type="number_format" id="clinicalRep">
                                        <!-- clinical presentations fields adds here -->
                                        <!-- php server data adds here  -->
                                        <?php while ($dataClinicalPresentation = mysqli_fetch_assoc($clinicalPresentation)) { ?>
                                        <li>
                                            <div class="input-group mb-3">
                                                <input autocomplete="off" type="text" class="form-control"
                                                    name="clinicalRep[]"
                                                    value='<?php echo $dataClinicalPresentation['clinical_presentation']; ?>'>
                                                <div class="input-group-append">
                                                    <button class="btn btn-danger"  type="button"
                                                        onclick="this.closest('li').remove();"><i
                                                            class="fas fa-minus"></i></button>
                                                </div>
                                            </div>
                                        </li>
                                        <?php } ?>
                                        <!-- php server data closes here  -->
                                    </ul>
                                </div>
                                <!-- clinial presentation ends here -->

                                <!-- diagnosis/provisonal diagnosis starts here -->
                                <div class="col-xl-12">
                                    <label for="diagnosis" class="form-label">Diagnosis/Provisional Diagnosis
                                    </label>
                                    <div class="input-group mb-3">
                                        <input autocomplete="off" type="text" class="form-control" id="diagnosisF"
                                            placeholder="Diagnosis/Provisional Diagnosis here...">
                                        <div class="input-group-append">
                                            <button class="btn btn-success" id="addField" type="button"><i
                                                    class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <ul type="number_format" id="medDiagnosis">
                                        <!-- diagnosis/provisional diagnosis adds here -->
                                        <!-- php server data adds here  -->
                                        <?php while ($dataDiagnosis = mysqli_fetch_assoc($diagnosis)) { ?>
                                        <li>
                                            <div class="input-group mb-3">
                                                <input autocomplete="off" type="text" class="form-control"
                                                    name="diagnosis[]"
                                                    value='<?php echo $dataDiagnosis['diagnosis']; ?>'>
                                                <div class="input-group-append">
                                                    <button class="btn btn-danger" id="addField" type="button"
                                                        onclick="this.closest('li').remove();"><i
                                                            class="fas fa-minus"></i></button>
                                                </div>
                                            </div>
                                        </li>
                                        <?php } ?>
                                        <!-- php server data closes here  -->
                                    </ul>
                                </div>
                                <!-- dianosis/provisional diagnosis ends here  -->

                                <!-- medicine starts here  -->
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="w-25">Medicine Name</th>
                                                <th class="w-25">Dosage</th>
                                                <th class="w-25">Duration</th>
                                                <th class="w-5">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tBody">
                                            <tr>
                                                <td class="w-50"><input autocomplete="off" type="text"
                                                        class="form-control input" id="medName"
                                                        placeholder="Medicine name here..."></td>

                                                <td class="w-25">
                                                    <div class="input-group mb-3">
                                                        <input autocomplete="off" type="text" class="form-control input"
                                                            id='medDosage'>
                                                        <div class="input-group-append">
                                                            <select id="insDosage" class="form-control"
                                                                name="insDosage">
                                                                <option value="">Choose</option>
                                                                <option value="SOS">SOS</option>
                                                                <option value="Daily">Daily</option>
                                                                <option value="Weekly">Weekly</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <select id="insType" class="form-control" name="insType">
                                                        <option value="">Choose</option>
                                                        <option value="SOS">SOS</option>
                                                        <option value="Anytime">Anytime</option>
                                                        <option value="Before Meal">Before Meal</option>
                                                        <option value="After Meal">After Meal</option>
                                                        <option value="Morning">Morning</option>
                                                        <option value="Morning Before Meal">Morning Before Meal</option>
                                                        <option value="Morning After Meal">Morning After Meal</option>
                                                        <option value="Afternoon">Afternoon</option>
                                                        <option value="Afternoon Before Meal">Afternoon Before Meal
                                                        </option>
                                                        <option value="Afternoon After Meal">Afternoon After Meal
                                                        </option>
                                                        <option value="Night">Night</option>
                                                        <option value="Night Before Meal">Night Before Meal</option>
                                                        <option value="Night After Meal">Night After Meal</option>
                                                    </select>
                                                </td>
                                                <td class="w-25">
                                                    <div class="input-group mb-3">
                                                        <input autocomplete="off" type="text" class="form-control input"
                                                            id='medDuration'>
                                                        <div class="input-group-append">
                                                            <select id="insDuration" class="form-control"
                                                                name="insDuration">
                                                                <option value="Days">Days</option>
                                                                <option value="Weeks">Weeks</option>
                                                                <option value="Months">Months</option>
                                                            </select>

                                                        </div>
                                                    </div>
                                                </td>
                                </div>
                                <th class="w-5"><button type="button" class="btn btn-success" id="add">ADD</button></th>
                                </tr>
                                <!-- php server data adds here  -->
                                <?php while ($dataMedicine = mysqli_fetch_assoc($medicine)) {?>
                                <td class="w-50">
                                    <input autocomplete="off" type="text" class="form-control input" name='medName[]'
                                        value='<?php echo $dataMedicine['medicine_name']; ?>'>
                                </td>
                                <td class="w-25">
                                    <input autocomplete="off" type="text" class="form-control input" name='medDosage[]'
                                        value='<?php echo $dataMedicine['dosage']; ?>'>
                                </td>
                                <td class="w-25"><input autocomplete="off" type="text" class="form-control input"
                                        name='medDuration[]' value='<?php echo $dataMedicine['duration']; ?>'>
                                </td>
                                <td class="w-5"><button type="button" class="btn btn-danger"
                                        onclick="this.closest('tr').remove();">REM</button></td>
                                </tr>
                                </tr>
                                <?php } ?>
                                <!-- php server data closes here  -->

                                </tbody>
                                </table>
                        </div>
                        <!-- medicine ends here  --> 

                        <!-- investigation starts here  -->
                        <div class="col-xl-12">
                            <label for="investigation" class="form-label">Investigations
                            </label>
                            <div class="input-group mb-3">
                                <input autocomplete="off" type="text" class="form-control" id="investigation"
                                    placeholder="Investigation here...">
                                <div class="input-group-append">
                                    <button class="btn btn-success" id="addInvestigation" type="button"><i
                                            class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <ul id="investigations">
                                <!-- investigations adds here -->
                                <!-- php server data adds here  -->
                                <?php while ($dataInvestigation = mysqli_fetch_assoc($investigation)) { ?>
                                        <li>
                                            <div class="input-group mb-3">
                                                <input autocomplete="off" type="text" class="form-control"
                                                    name="investigations[]"
                                                    value='<?php echo $dataInvestigation['investigation']; ?>'>
                                                <div class="input-group-append">
                                                    <button class="btn btn-danger" id="addField" type="button"
                                                        onclick="this.closest('li').remove();"><i
                                                            class="fas fa-minus"></i></button>
                                                </div>
                                            </div>
                                        </li>
                                        <?php } ?>
                                <!-- php server data closes here  -->
                            </ul>
                        </div>
                        <!-- investigation ends here  -->

                        <!-- refer to starts here  -->
                        <div class="col-md-12">
                            <label for="referTo" class="form-label">Refer To:</label>
                            <input autocomplete="off" type="text" class="form-control" id="referTo" name="referTo"
                                value="<?php echo $dataPatient['refer_to'] ?>">
                        </div>
                        <!-- refer to ends here  -->

                        <!-- advice starts here  -->
                        <div class="col-md-9">
                            <label for="advice" class="form-label">Advice Given</label>
                            <input autocomplete="off" type="text" class="form-control" id="referTo" name="advice"
                                value="<?php echo $dataPatient['advice'] ?>">
                        </div>
                        <!-- advice ends here  -->

                        <!-- follow up starts here  -->
                        <div class="col-md-3">
                            <label for="followUP" class="form-label">Next Follow-up</label>
                            <div class="input-group-append">
                                <input autocomplete="off" type="text" class="form-control" id="follow_upD"
                                    name="follow_upD" value="<?php echo $dataPatient['follow_upD'] ?>">
                                <select id="follow_upW" class="form-control" name="follow_upW">
                                    <option selected value="">Select</option>
                                    <option value="Day"
                                        <?php if($dataPatient['follow_upW']=="Day"){echo "selected";} ?>>Day</option>
                                    <option value="Week"
                                        <?php if($dataPatient['follow_upW']=="Week"){echo "selected";} ?>>Week</option>
                                    <option value="Month"
                                        <?php if($dataPatient['follow_upW']=="Month"){echo "selected";} ?>>Month
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!-- follow up ends here  -->
                        
                        <!-- ********** -->
                        <?php } ?>
                        <hr>
                        <div class="text-center mt-3 col-md-12">
                            <!-- <button type="button" class="btn btn-warning" name="getpatienId" id="getpatienId">Generate ID</button> -->
                            <button type="submit" class="btn btn-success" name="save" id="save">Save &
                                Verify</button>
                        </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>


                <?php
                    include('../includes/footer.php'); ?>
            </div>
        </div>
        <script>
        $(document).ready(function() {
            $("#add").on('click', (e) => {
                let dosage = "";
                if ($('#medDuration').val() != "") {
                    dosage = $('#medDuration').val() + "x" + $('#insDuration').val();
                }
                // console.log("add");
                html = `<tr>
                                    <td class="w-50"><input autocomplete="off" type="text" class="form-control input" name='medName[]' value='${$('#medName').val()}'></td>
                                    <td class="w-25"><input autocomplete="off" type="text" class="form-control input" name='medDosage[]' value='${$('#medDosage').val()} x ${$('#insDosage').val()} | ${$('#insType').val()}'></td>
                                    <td class="w-25"><input autocomplete="off" type="text" class="form-control input" name='medDuration[]' value='${dosage}'></td>
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
                                    <input autocomplete="off" type="text" class="form-control" name="diagnosis[]" value='${$('#diagnosisF').val()}'>
                                        <div class="input-group-append">
                                            <button class="btn btn-danger" id="addField" type="button" onclick="this.closest('li').remove();"><i class="fas fa-minus"></i></button>
                                        </div>
                                        </div>
                                        </li>`;
                $('#diagnosisF').val("");
                $("#medDiagnosis").append(fieldHtml);
            })
            $("#addClinicalPresentation").on('click', (e) => {
                fieldHtml = `<li>
                        <div class="input-group mb-3">
                                    <input autocomplete="off" type="text" class="form-control" name="clinicalRep[]" value='${$('#clinicalPresentation').val()}'>
                                        <div class="input-group-append">
                                            <button class="btn btn-danger" id="addField" type="button" onclick="this.closest('li').remove();"><i class="fas fa-minus"></i></button>
                                        </div>
                                        </div>
                                        </li>`;
                $('#clinicalPresentation').val("");
                $("#clinicalRep").append(fieldHtml);
            })
            $("#addInvestigation").on('click', (e) => {
                fieldHtml = `<li>
                        <div class="input-group mb-3">
                                    <input autocomplete="off" type="text" class="form-control" name="investigations[]" value='${$('#investigation').val()}'>
                                        <div class="input-group-append">
                                            <button class="btn btn-danger" id="addField" type="button" onclick="this.closest('li').remove();"><i class="fas fa-minus"></i></button>
                                        </div>
                                        </div>
                                        </li>`;
                $('#investigation').val("");
                $("#investigations").append(fieldHtml);
            })

        })
        </script>