<?php
// include("./includes/header.php");
require('db_conn/dbConn.php');
include('./db_conn/apiDoctor.php');
// include('./db_conn/user.php');

if (!isset($_GET['prescription_id'])) {
    header('location:204.php');
}
$dataPatients = getPrescriptiontDetails($_GET['prescription_id'], $_GET['patient_id']);
$diagnosis = getDiagnosis($_GET['prescription_id'], $_GET['patient_id']);
$medicine = getMedicine($_GET['prescription_id'], $_GET['patient_id']);

?>

<head>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/print.css" rel="stylesheet" media="print">
    <title>Prescription</title>
    <style>
        body {
            padding: 2rem;
            

        }

        table,
        tr,
        td {
            /* border: 1px solid black; */
            border-collapse: collapse;
            padding: 10px;
        }

        .ta-center {
            text-align: center;
        }

        .border {
            border: 1px solid black;
        }

        .borderA {
            border: 1px solid black;
        }

        .docSign {
            max-width: 100vw;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-end;
            text-align: center;
            font-size: 20px;
        }

        .docSign img {
            width: 120px;
        }

        .inner {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
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
    </style>
</head>

<body>


    <div>
        <table width="100%" class="border">
            <tr class="border">
                <td colspan="4">
                    <div>
                        <h3>Dr.JOHN DOE</h3>
                        <h5>REG No 0000</h5>
                        <h5>MBBS,MD</h5>
                    </div>
                </td>
                <td colspan="8"><img src="img/logo.svg" style="width: 80vw;"></td>
            </tr>

            <tr class="border">
                <td colspan="4">
                    <?php
                    while ($dataPatient = mysqli_fetch_assoc($dataPatients)) {
                    ?>
                        <strong>Prescription ID:</strong><?php echo $dataPatient['prescription_id'] ?>

                </td>
                <td colspan="4"><strong>Patient ID: </strong><?php echo $dataPatient['patient_id'] ?></td>
                <td colspan="4"><strong>Date: </strong><?php echo $dataPatient['visit_date'] ?></td>
            </tr>

            <tr class="border">
                <td colspan="4"> <strong>Name: </strong><?php echo $dataPatient['name'] ?>
                </td>
                <td colspan="2"> <strong>Gender: </strong><?php echo $dataPatient['gender'] ?>
                </td>
                <td colspan="2"> <strong>Age: </strong> Y
                </td>
                <td colspan="2"> <strong>Phone No: </strong>
                </td>
                <!-- <td colspan="3" rowspan="4" style="margin:0 auto"><img src="img/undraw_profile.svg" alt="" width="150"></td> -->
            </tr>
            <tr>
                <td colspan="12"><strong>Address:</strong> Bongal Pukhuri, Jorhat, Assam</td>

            </tr>
        </table>
        <hr>
        <table width="100%">

            <tr>
                <td colspan="6"><strong>Referrred By: </strong><?php echo strtoupper($dataPatient['referred_by']) ?> </td>
            </tr>
            <tr>
                <td colspan="6"><strong>Past Medical History: </strong><?php echo $dataPatient['past_history'] ?> </td>
            </tr>
            <tr>
                <td colspan="6"><strong>Chief Complaint: </strong><?php echo $dataPatient['cheif_complaint'] ?> </td>
            </tr>
            <tr>
                <td colspan="6"><strong>Diagnosis: </strong>
                </td>
            </tr>

            <?php
                        while ($dataDiagnosis = mysqli_fetch_assoc($diagnosis)) {

            ?>
                <tr>
                    <td>
                        <?php echo $dataDiagnosis['diagnosis']; ?>
                    </td>
                </tr>
            <?php } ?>

            <tr>
                <td colspan="6"><strong>Additional Notes: </strong><?php echo $dataPatient['note'] ?></td>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <td colspan="6">
                    <img src="img/Rx.svg" alt="" width="50px">
                </td>
            </tr>
            <tr class="border">
                <td colspan="2"><strong>Medicine Name</strong></td>
                <td colspan="2"><strong>Dosage</strong></td>
                <td colspan="2"><strong>Duration</strong></td>
            </tr>
            <?php
                        while ($dataMedicine = mysqli_fetch_assoc($medicine)) {
            ?>
                <tr>
                    <td colspan="2"><?php echo $dataMedicine['medicine_name']; ?></td>
                    <td colspan="2"><?php echo $dataMedicine['dosage']; ?></td>
                    <td colspan="2"><?php echo $dataMedicine['duration']; ?></td>
                </tr>
            <?php } ?>


        </table>

        <table width="100%">
            <tr>
                <td>
                    <h5><strong>Refer To: <?php echo $dataPatient['refer_to'] ?></strong></h5>
                </td>
            </tr>
            <tr>
                <td><strong>Advice Given: </strong><?php echo $dataPatient['advice'] ?></td>
            </tr>
            <tr>
                <td><strong>Next Follow up:</strong> <?php echo $dataPatient['follow_up'] ?></td>
            </tr>
            <tr></tr>
        </table>
    <?php } ?>
    <div class="docSign">
        <div class="inner">
            <img src="img/sign.png" alt="">
            <span>Signature</span>
        </div>

    </div>
    <p>Sample prescription Copy | Developed by NINJABuoy | all rights reserved |</p>
    <div class="btn">
        <button type="button" onclick="window.print()" id="checkin" class="btn btn-primary">Print</button>
    </div>

</body>