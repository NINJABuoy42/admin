<?php
require('db_conn/dbConn.php');

function getPrescriptiontDetails($prescription_id,$patientId){
    $sql = "SELECT * FROM prescription WHERE prescription_id='$prescription_id' and patient_id='$patientId'";
    $dataPatients = mysqli_query($GLOBALS['conn'], $sql) or die("SQL query failed");
    return $dataPatients;
}
function fetchWaitingPatient(){
    $sql = "SELECT * FROM prescription WHERE status='checked_in'";
    $prescription = mysqli_query($GLOBALS['conn'], $sql);
    return $prescription;
}

function updatePrescription(){
    $pSql="UPDATE `prescription` SET `cheif_complaint`='{$_POST['cheifComplaints']}',`note`='{$_POST['note']}',`refer_to`='{$_POST['referTo']}',`advice`='{$_POST['advice']}',`follow_up`='{$_POST['followUP']}',`status`='prescribed' WHERE `prescription_id`='{$_POST['prescription_id']}' AND `patient_id`='{$_POST['patient_id']}' ";
    mysqli_query($GLOBALS['conn'],$pSql) or die("SQL query failed");
    $prescription_id=$_POST['prescription_id'];
    $patient_id=$_POST['patient_id'];
    if(isset($_POST['diagnosis'])!=''){
        foreach($_POST['diagnosis'] as $key => $value){
            $sql="INSERT INTO `diagnosis`(`prescription_id`,`patient_id`,`diagnosis`) VALUES ('{$prescription_id}','{$patient_id}','$value')";
            mysqli_query($GLOBALS['conn'],$sql);
        }
    }
    
    if (isset($_POST['medName'])!='') {
        $queryMed = "DELETE FROM `medicine` WHERE `prescription_id`={$prescription_id}";
        mysqli_query($GLOBALS['conn'], $queryMed);
        $medDosage = $_POST['medDosage'];
        $medDuration = $_POST['medDuration'];
        foreach ($_POST['medName'] as $key => $value) {
            $query = "INSERT INTO `medicine`(`prescription_id`,`patient_id`,`medicine_name`,`dosage`, `duration`) VALUES ('{$_POST['prescription_id']}','{$_POST['patient_id']}','$value','$medDosage[$key]','$medDuration[$key]')";
            mysqli_query($GLOBALS['conn'], $query);
        }
    }
    header('location:patientWaitingList.php');
}

function getDiagnosis($prescription_id,$patient_id){
    $sql = "SELECT * FROM diagnosis WHERE prescription_id='$prescription_id' and patient_id='$patient_id'";
    $diagnosis = mysqli_query($GLOBALS['conn'], $sql) or die("SQL query failed");
    return $diagnosis;
}

function getMedicine($prescription_id,$patient_id){
    $sql = "SELECT * FROM medicine WHERE prescription_id='$prescription_id' and patient_id='$patient_id'";
    $medicine = mysqli_query($GLOBALS['conn'], $sql) or die("SQL query failed");
    return $medicine;
}