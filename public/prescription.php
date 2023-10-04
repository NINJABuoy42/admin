<?php
// include("./includes/header.php");
require('../db_conn/dbConn.php');
include('../db_conn/apiDoctor.php');
// include('./db_conn/user.php');

if (!isset($_GET['prescription_id'])) {
    header('location:204.php');
}
$dataPatients = getPrescriptiontDetails($_GET['prescription_id'], $_GET['patient_id']);
$diagnosis = getDiagnosis($_GET['prescription_id'], $_GET['patient_id']);
$medicine = getMedicine($_GET['prescription_id'], $_GET['patient_id']);
$clinicalPresentation = getClinicalPresentation($_GET['prescription_id'], $_GET['patient_id']);
$investigation = getInvestigation($_GET['prescription_id'], $_GET['patient_id']);

?>

<head>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/print.css" rel="stylesheet" media="print">
    <title>Prescription</title>
    <style>
    body {
        padding: 3rem;
        height: 11.5in;


    }
    .docSign {
        width: 100%;
        text-align: end;
        padding-right: 4rem;
        margin-bottom: 1rem;
    }    
    button {
        margin: 1rem auto;
    }

    footer {
        width: 100%;
        text-align: center;
    }
    #rx{
        font-size: 3rem;
    }
    .btn{
        width: 80%;
        position: fixed;
        bottom: 0;
        right: 0;
        left:0;
        /* margin-left: 4rem;
        margin-right: 4rem; */
    }
    </style>
</head>

<body>


    <?php while ($dataPatient = mysqli_fetch_assoc($dataPatients)) {
        $getDoc = fetchDocs($dataPatient['doc_id']); ?>
    <div>
        <table width="100%" height="fit-content">
            <tr>
                <td colspan="6">
                    <div>
                        <?php while($doc = mysqli_fetch_assoc($getDoc)){ ?>
                        <h3><strong><?php echo $doc['Name']; ?> </strong></h3>
                        <h6><?php echo $doc['qualifications']; ?></h6>
                        <h6><?php echo $doc['current']; ?></h6>
                        <h6>Regd No. <?php echo $doc['regNo']; ?></h6>
                        <h6>E-Mail: <?php echo $doc['email']; ?></h6>
                        <?php }?>
                    </div>
                </td>
                <td colspan="6" class="float-right" >
                    <img src="../img/head.jpg" width="500">
                </td>
            </tr>
        </table>
        <hr class="border border-dark">

        <div class="row">
            <div class="col col-sm-4">
                <strong>Prescription ID: </strong><?php echo $dataPatient['prescription_id'] ?>
            </div>
            <div class="col col-sm-4">
                <strong>Patient ID: </strong><?php echo $dataPatient['patient_id'] ?>
            </div>
            <div class="col col-sm-4">
                <strong>Date: </strong> <?php $date=strtotime($dataPatient['visit_date']); echo date('d-M-y',$date);  ?>
            </div>
        </div>
        <hr class="border">
        <div class="row">
            <div class="col col-sm-4">
                <strong>Name: </strong><?php echo $dataPatient['name'] ?>
            </div>
            <div class="col col-sm-4">
                <strong>Age: </strong><?php echo $dataPatient['age'] ?> Y
            </div>
            <div class="col col-sm-4">
                <strong>Gender: </strong><?php echo $dataPatient['gender'] ?>
            </div>
        </div>
        <div class="row">
            <div class="col col-sm-8">
                <strong>Address: </strong><?php echo $dataPatient['address']?></td>
            </div>
            <div class="col col-sm-4">
                <strong>Phone No: </strong><?php echo $dataPatient['phone'] ?>
            </div>
        </div>
        <hr class="border  border-dark">
        <div class="row">
            <div class="col col-sm-2 text-break">
                <strong>Clinical Presentation: </strong>
            </div>
            <div class="col col-sm-6">
                <ul type="number">
                    <?php while ($dataClinicalPresentation = mysqli_fetch_assoc($clinicalPresentation)) { ?>
                    <li>
                        <?php echo $dataClinicalPresentation['clinical_presentation']; ?>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col col-md-4  border-left-dark px-4">
                <?php if($dataPatient['blood_pressure']!=""){ ?>
                <div class="row"><strong class="mr-1">Blood Pressure:</strong><?php echo $dataPatient['blood_pressure'] ?> mmHH</div>
                <?php } ?>
                <?php if($dataPatient['spo2']!=""){ ?>
                <div class="row"><strong class="mr-1">SpO<sub>2</sub>:</strong><?php echo $dataPatient['spo2'] ?> &#37;</div>
                <?php } ?>
                <?php if($dataPatient['pulse']!=""){ ?>
                <div class="row"><strong class="mr-1">Pulse:</strong><?php echo $dataPatient['pulse'] ?> bpm</div>
                <?php } ?>
                <?php if($dataPatient['height']!=""){ ?>
                <div class="row"><strong class="mr-1">Height: </strong><?php echo $dataPatient['height'] ?> cm</div>
                <?php } ?>
                <?php if($dataPatient['weight']!=""){ ?>
                <div class="row"><strong class="mr-1">Weight: </strong><?php echo $dataPatient['weight'] ?> kg</div>
                <?php } ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col col-sm-2">
                <strong>Diagnosis: </strong>
            </div>
            <div class="col col-sm-10">
                <ul type="number">
                    <?php while ($dataDiagnosis = mysqli_fetch_assoc($diagnosis)) { ?>
                    <li>
                        <?php echo $dataDiagnosis['diagnosis']; ?>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <br>
        <!-- <hr class="border"> -->
        <div class="row">
        <span id="rx"><strong>&#8478;</strong></span>
        </div>
        <ol type="number">
            <?php while ($dataMedicine = mysqli_fetch_assoc($medicine)) { ?>
            <li>
                <div class="row mt-1">
                    <div class="col col-sm-5"><?php echo $dataMedicine['medicine_name']; ?></div>
                    <div class="col col-sm-5"><?php echo $dataMedicine['dosage']; ?></div>
                    <?php if($dataMedicine['duration']!=""){ ?>
                    <div class="col col-sm-2">For: <?php echo $dataMedicine['duration']; ?></div>
                    <?php } ?>
                </div>
            </li>
            <?php } ?>
        </ol>
        <hr class="border">
        <?php if($investigation!=""){?>
        <div class="row">
            <div class="col-sm-2"> <strong class="mr-1">Investigations: </strong>
            </div>
            <div class="col-sm-8">
                <ul type="number">
                    <?php while ($dataInvestigation = mysqli_fetch_assoc($investigation)){ ?>
                    <li>
                        <?php echo $dataInvestigation['investigation']; ?>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php } ?>
        <br>
        <?php if($dataPatient['refer_to']!=""){?>
        <div class="row">
            <div class="col-sm-12"> <strong class="mr-1">Refer To: </strong><?php echo $dataPatient['refer_to'];?>
            </div>
        </div>
        <?php } if($dataPatient['advice']!=""){ ?>

        <div class="row">
            <div class="col-sm-12"> <strong class="mr-1">Advice Given: </strong><?php echo $dataPatient['advice'] ?>
            </div>
        </div>
        <?php } if($dataPatient['follow_upD']!="" && $dataPatient['follow_upW']!="" ){?>
        <div class="row">
            <div class="col-sm-12"> <strong class="mr-1">Follow up: </strong>After
                <?php
                 echo $dataPatient['follow_upD']." ".$dataPatient['follow_upW']." ";
                  ?></div>
        </div>
        <?php } 
    } ?>
    <br>
        <div class="docSign">
            <strong><span>Signature/Seal</span></strong>
        </div>
        <footer><strong>**KINDLY BRING THIS PRESCRIPTION ON YOUR NEXT VISIT**</strong></footer>
        <div class="btn">
            <button type="button" onclick="window.print()" id="checkin" class="btn btn-primary">Print</button>
        </div>

</body>
<!-- <script src="../vendor/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        window.print();
    })
</script> -->