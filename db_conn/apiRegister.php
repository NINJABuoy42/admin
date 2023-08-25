<?php
require('../db_conn/dbConn.php');
function viewPatientDetail($patienId)
{
    $sql = "SELECT * FROM patient_details WHERE patienId='$patienId'";
    $patientDetails = mysqli_query($GLOBALS['conn'], $sql);
    return $patientDetails;
}

function viewPatientHistory($patienId)
{
    $sql = "SELECT * FROM prescription WHERE patient_id='$patienId' ORDER BY visit_date DESC";
    $patientHistory = mysqli_query($GLOBALS['conn'], $sql);
    return $patientHistory;
}
function fetchPrescription(){
    $sql = "SELECT * FROM prescription WHERE status='prescribed' ORDER BY prescribed_date DESC";
    $prescription = mysqli_query($GLOBALS['conn'], $sql);
    return $prescription;
}

function getPrescription($prescription_id)
{
    $sql = "SELECT * FROM prescription WHERE prescription_id='$prescription_id'";
    $prescription = mysqli_query($GLOBALS['conn'], $sql);
    return $prescription;
}

function getDoctors()
{
    $query = "SELECT user_id,fullName FROM users where role='doctor'";
    $result = mysqli_query($GLOBALS['conn'], $query) or die("SQL query failed");
    return $result;
}

function patientCheckIn($pBP, $pWeight, $pHeight, $pId, $attendingDoc)
{
    $query = "SELECT COUNT(*) FROM prescription";
    $result = mysqli_query($GLOBALS['conn'], $query) or die("SQL query failed");
    while ($row = $result->fetch_assoc()) {
        $newId = $row['COUNT(*)'] + 1;
        $newPID = "PSC-" . date("Y") . "/" . $newId;
    }
    $queryP ="SELECT fullName,age,gender,phoneNumber,address FROM patient_details WHERE patienId LIKE '%{$pId}%'";
    $resultP = mysqli_query($GLOBALS['conn'], $queryP) or die("SQL query failed");
    while ($rowP = $resultP->fetch_assoc()) {
        $pName = $rowP['fullName'];
        $pAge = $rowP['age'];
        $pGender = $rowP['gender'];
        $phone = $rowP['phoneNumber'];
        $pAddress = $rowP['address'];
        
    }
    $sql = "INSERT INTO `prescription`(`prescription_id`, `patient_id`,`name`, `age`, `gender`, `phone`, `address`, `attending_doctor`,`height`, `weight`, `blood_pressure`,`status`,`visit_date`) VALUES ('{$newPID}','{$pId}','{$pName}','{$pAge}','{$pGender}','{$phone}','{$pAddress}','{$attendingDoc}','{$pHeight}','{$pWeight}','{$pBP}','checked_in',NOW())";
    if (mysqli_query($GLOBALS['conn'], $sql)) {
        header("LOCATION:viewDetails.php?patient_id={$pId}");
    }
}
?>