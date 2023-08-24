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
        height:842px;


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
        width: 100%;
        text-align:end;
        margin-top:4rem;
        padding-right: 4rem;
        margin-bottom:2rem;
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


    <div>
        <table width="100%" class="border" height="fit-content">
            <tr class="border">
                <td colspan="6">
                    <div>
                        <h3><strong>Dr.Amrit Kumar Saikia</strong></h3>
                        <h6>MBBS,M.S. (General Surgery)</h6>
                        <h6>MCh (Neurosurgery), NIMHANS, Bangalore</h6>
                        <h6>Regd No. AMC: 15410</h6>
                        <h6>E-Mail: amritkumarsaikia@gmail.com</h6>
                    </div>
                </td>
                <td colspan="6">
                    <img src="img/head.jpg" width="500" >
                </td>
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
        <table width="100%" height="200px">
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
            <tbody height="400px">
                 <?php
                        while ($dataMedicine = mysqli_fetch_assoc($medicine)) {
            ?>
            <tr>
                <td colspan="2"><?php echo $dataMedicine['medicine_name']; ?></td>
                <td colspan="2"><?php echo $dataMedicine['dosage']; ?></td>
                <td colspan="2"><?php echo $dataMedicine['duration']; ?></td>
            </tr>
            <?php } ?>
            </tbody>
           


        </table>

        <table width="100%">
            <?php if($dataPatient['refer_to']!=""){?>
            <tr>
                <td>
                    <h5><strong>Refer To:<?php echo $dataPatient['refer_to'];?></strong></h5>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td><strong>Advice Given: </strong><?php echo $dataPatient['advice'] ?></td>
            </tr>
            <?php if($dataPatient['follow_up']!="0000-00-00"){?>
            <tr>
                <td><strong>Next Follow up:</strong> <?php echo $dataPatient['follow_up'] ?></td>
            </tr>
            <?php  } ?>
            <tr></tr>
        </table>
        <?php } ?>
        <div class="docSign">
            <strong><span>Signature/Seal</span></strong>
        </div>
        <footer><strong>**KINDLY BRING THIS PRESCRIPTION ON YOUR NEXT VISIT**</strong></footer>
        <div class="btn">
            <button type="button" onclick="window.print()" id="checkin" class="btn btn-primary">Print</button>
        </div>

</body>