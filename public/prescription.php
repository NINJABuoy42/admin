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

?>

<head>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/print.css" rel="stylesheet" media="print">
    <title>Prescription</title>
    <style>
    body {
        padding: 3rem;
        height: 842px;


    }




    .docSign {
        width: 100%;
        text-align: end;
        margin-top: 200px;
        padding-right: 4rem;
        margin-bottom: 2rem;
    }

    .btn {
        width: 80vw;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    button {
        margin: 1rem auto;
    }

    footer {
        width: 100%;
        text-align: center;
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
                        <h6>Regd No.    <?php echo $doc['regNo']; ?></h6>
                        <h6>E-Mail: <?php echo $doc['email']; ?></h6>
                        <?php }?>
                    </div>
                </td>
                <td colspan="6">
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
                <strong>Date: </strong> <?php echo $dataPatient['visit_date'] ?>
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
            <div class="col col-sm-8 text-break">
                <strong>Chief Complaint: </strong><?php echo $dataPatient['cheif_complaint'] ?>
            </div>
            <div class="col col-md-4">
                <div class="row"><strong class="mr-1">Blood Pressure:
                    </strong><?php echo $dataPatient['blood_pressure'] ?>mmHH</div>
                <div class="row"><strong class="mr-1">Height: </strong><?php echo $dataPatient['height'] ?>cm</div>
                <div class="row"><strong class="mr-1">Weight: </strong><?php echo $dataPatient['weight'] ?>kg</div>
            </div>
        </div>
        <div class="row">
            <div class="col col-sm-2">
                <strong>Diagnosis: </strong>
            </div>
            <div class="col col-sm-10">
                <ol type="number">
                    <?php while ($dataDiagnosis = mysqli_fetch_assoc($diagnosis)) { ?>
                    <li>
                        <?php echo $dataDiagnosis['diagnosis']; ?>
                    </li>
                    <?php } ?>
                </ol>
            </div>
        </div>
        <hr class="border">
        <div class="row">
            <img src="../img/Rx.svg" alt="" width="50px">
        </div>
        <ol type="number">
            <?php while ($dataMedicine = mysqli_fetch_assoc($medicine)) { ?>
            <li>
                <div class="row mt-4">
                    <div class="col col-sm-6"><?php echo $dataMedicine['medicine_name']; ?></div>
                    <div class="col col-sm-3"><?php echo $dataMedicine['dosage']; ?></div>
                    <div class="col col-sm-3"><?php echo $dataMedicine['duration']; ?></div>
                </div>
            </li>
            <?php } ?>
        </ol>
        <hr class="border">
        <?php if($dataPatient['refer_to']!=""){?>
        <div class="row">
            <div class="col-col-sm-12"> <strong class="mr-1">Refer To: </strong><?php echo $dataPatient['refer_to'];?></div>
        </div>
        <?php }
        if($dataPatient['advice']!=""){?>

        <div class="row">
            <div class="col-col-sm-12"> <strong class="mr-1">Advice Given: </strong><?php echo $dataPatient['advice'] ?></div>
        </div>
        <?php } if($dataPatient['follow_up']!="0000-00-00"){?>
        <div class="row">
            <div class="col-col-sm-12"> <strong class="mr-1">Follow up: </strong> <?php echo $dataPatient['follow_up'] ?></div>
        </div>
        <?php } 
    } ?>




        <div class="docSign">
            <strong><span>Signature/Seal</span></strong>
        </div>
        <footer><strong>**KINDLY BRING THIS PRESCRIPTION ON YOUR NEXT VISIT**</strong></footer>
        <div class="btn">
            <button type="button" onclick="window.print()" id="checkin" class="btn btn-primary">Print</button>
        </div>

</body>