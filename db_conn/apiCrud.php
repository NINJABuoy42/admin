<?php
require('../db_conn/dbConn.php');

function deleteID($tableName,$id,$returnLocation){
    $sql = "DELETE FROM $tableName WHERE id=$id";
    mysqli_query($GLOBALS['conn'], $sql) or die("SQL query failed");
    header("LOCATION:".$returnLocation);
}

function editService($id,$serviceType,$fees,$status,$category){
    $query = "UPDATE services SET `serviceType`='$serviceType',`fees`='$fees',`status`='$status',`category`='$category' WHERE id=$id";
    mysqli_query($GLOBALS['conn'], $query) or die("SQL query failed") ;
    header("LOCATION:../admin/services.php");
}
?>