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
    `age`, 
    `gender`, 
    `phoneNumber`, 
    `maritialStatus`, 
    `state`, 
    `district`, 
    `pinCode`, 
    `address`, 
    `emName`, 
    `emRelation`, 
    `emNumber`
    -- `status`, 
    ) VALUES (
    '{$newPID}',
    '{$user_id}',
    '{$_POST['fullName']}',
    '{$_POST['age']}',
    '{$_POST['gender']}',
    '{$_POST['phoneNumber']}',
    '{$_POST['maritialStatus']}',
    '{$_POST['state']}',
    '{$_POST['district']}',
    '{$_POST['pinCode']}',
    '{$_POST['address']}',
    '{$_POST['emName']}',
    '{$_POST['emRelation']}',
    '{$_POST['emNumber']}'
    -- '{$_POST['status']}',
   )";
    if (mysqli_query($conn, $sql)) {
        echo "success";
        header("location:../../public/viewDetails.php?patient_id={$newPID}");
    } else {
        echo json_encode(array('message' => 'No record found. ', 'status' => false));
    }
}
