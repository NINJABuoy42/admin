<?php
require('../db_conn/dbConn.php');

function getPrescriptiontDetails($prescription_id,$patientId){
    $sql = "SELECT * FROM prescription WHERE prescription_id='$prescription_id' and patient_id='$patientId'";
    $dataPatients = mysqli_query($GLOBALS['conn'], $sql) or die("SQL query failed");
    return $dataPatients;
}
function fetchWaitingPatient(){
    $user=$_SESSION['user'];
    $sql = "SELECT * FROM prescription WHERE status='checked_in' AND `doc_id` = '{$_SESSION['user_id']}'";
    $prescription = mysqli_query($GLOBALS['conn'], $sql);
    return $prescription;
}

function updatePrescription(){
    $pSql="UPDATE `prescription` SET `cheif_complaint`='{$_POST['cheifComplaints']}',`note`='{$_POST['note']}',`refer_to`='{$_POST['referTo']}',`advice`='{$_POST['advice']}',`follow_up`='{$_POST['followUP']}',`height`='{$_POST['height']}',`weight`='{$_POST['weight']}',`blood_pressure`='{$_POST['blood_pressure']}',`status`='prescribed' WHERE `prescription_id`='{$_POST['prescription_id']}' AND `patient_id`='{$_POST['patient_id']}' ";
    mysqli_query($GLOBALS['conn'],$pSql) or die("SQL query failed");
    $prescription_id=$_POST['prescription_id'];
    $patient_id=$_POST['patient_id'];
    $sqlD="DELETE FROM `diagnosis` WHERE prescription_id ='{$prescription_id}' ";
    mysqli_query($GLOBALS['conn'],$sqlD);
    if(isset($_POST['diagnosis'])!=''){
        foreach($_POST['diagnosis'] as $key => $value){
            $sql="INSERT INTO `diagnosis`(`prescription_id`,`patient_id`,`diagnosis`) VALUES ('{$prescription_id}','{$patient_id}','$value')";
            mysqli_query($GLOBALS['conn'],$sql);
        }
    }
    $sqlM="DELETE FROM `medicine` WHERE prescription_id ='{$prescription_id}' ";
    mysqli_query($GLOBALS['conn'],$sqlM);
    if (isset($_POST['medName'])!='') {
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

function fetchDocs($id){
    $query = "SELECT * FROM doctors WHERE `user_id`=$id";
    $docP = mysqli_query($GLOBALS['conn'], $query) or die("SQL query failed");
    return $docP;
}