<?php
require('../dbConn.php');
session_start();
$user_id=$_SESSION["user_id"];
if (isset($_POST['proceed'])) {
    $query = "SELECT COUNT(*) FROM patient_details where `user_id`='$user_id'";
    $result = mysqli_query($GLOBALS['conn'], $query) or die("SQL query failed");
    while ($row = $result->fetch_assoc()) {
        $newId = $row['COUNT(*)'] + 1;
        $newPID = "AMPO-" . $user_id . "/" . $newId . "/" . date("Y");
    }
    $sql = "INSERT INTO `patient_details`(
    `patienId`,
    `user_id`,
    `fullName`,
    `dateOfBirth`, 
    `age`, 
    `gender`, 
    `phoneNumber`, 
    `bloodGroup`, 
    `maritialStatus`, 
    `state`, 
    `district`, 
    `pinCode`, 
    `address`, 
    `policeStation`, 
    `postOffice`, 
    `landMark`,
    `emName`, 
    `emRelation`, 
    `emNumber`, 
    `emstate`, 
    `emDistrict`, 
    `empinCode`, 
    `emAddress`, 
    `empoliceStation`, 
    `empostOffice`, 
    `emlandMark`, 
    `medicalHistory`, 
    -- `referredBy`, 
    `status`, 
    `patientPhoto`
    ) VALUES (
    '{$newPID}',
    '{$user_id}',
    -- user id change
    '{$_POST['fullName']}',
    '{$_POST['dateOfBirth']}',
    '{$_POST['age']}',
    '{$_POST['gender']}',
    '{$_POST['phoneNumber']}',
    '{$_POST['bloodGroup']}',
    '{$_POST['maritialStatus']}',
    '{$_POST['state']}',
    '{$_POST['district']}',
    '{$_POST['pinCode']}',
    '{$_POST['address']}',
    '{$_POST['policeStation']}',
    '{$_POST['postOffice']}',
    '{$_POST['landMark']}',
    '{$_POST['emName']}',
    '{$_POST['emRelation']}',
    '{$_POST['emNumber']}',
    '{$_POST['emstate']}',
    '{$_POST['emDistrict']}',
    '{$_POST['empinCode']}',
    '{$_POST['emAddress']}',
    '{$_POST['empoliceStation']}',
    '{$_POST['empostOffice']}',
    '{$_POST['emlandMark']}',
    '{$_POST['medicalHistory']}',
    -- '{$_POST['referredBy']}',
    '{$_POST['status']}',
    '{$_POST['patientPhoto']}')";
    if (mysqli_query($conn, $sql)) {
        echo "success";
        header("location:../../viewDetails.php?patient_id={$newPID}");
    } else {
        echo json_encode(array('message' => 'No record found. ', 'status' => false));
    }
}
