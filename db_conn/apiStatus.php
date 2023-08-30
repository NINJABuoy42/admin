<?php 
include('../db_conn/dbConn.php');
function getUsers()
{
    $sql = "SELECT count(*) FROM users";
    $result = mysqli_query($GLOBALS['conn'], $sql) or die("SQL query failed");
    while ($row = $result->fetch_assoc()) {
        $count = $row['count(*)'];  
    }
    return $count;
}
function getPatients()
{
    $sql = "SELECT count(*) FROM patient_details";
    $result = mysqli_query($GLOBALS['conn'], $sql) or die("SQL query failed");
    while ($row = $result->fetch_assoc()) {
        $count = $row['count(*)'];  
    }
    return $count;
}
function getPrescribedPatient()
{
    $sql = "SELECT count(*) FROM prescription WHERE status='prescribed'";
    $result = mysqli_query($GLOBALS['conn'], $sql) or die("SQL query failed");
    while ($row = $result->fetch_assoc()) {
        $count = $row['count(*)'];  
    }
    return $count;;
}
function getDocCount(){
    $sql = "SELECT count(*) FROM doctors";
    $result = mysqli_query($GLOBALS['conn'], $sql) or die("SQL query failed");
    while ($row = $result->fetch_assoc()) {
        $count = $row['count(*)'];  
    }
    return $count;
}
function getDocPatient($doc){
    $sql = "SELECT count(*) FROM prescription WHERE doc_id='$doc' AND `status`='prescribed'";
    $result = mysqli_query($GLOBALS['conn'], $sql) or die("SQL query failed");
    while ($row = $result->fetch_assoc()) {
        $count = $row['count(*)'];  
    }
    return $count;
}
function getWaitingPatient($doc){
    $sql = "SELECT count(*) FROM prescription WHERE doc_id='$doc' AND status='checked_in'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    while ($row = $result->fetch_assoc()) {
        $count = $row['count(*)'];  
    }
    return $count;
}
?>