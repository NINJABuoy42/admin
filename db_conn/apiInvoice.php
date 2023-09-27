<?php
require('../db_conn/dbConn.php');

function newInvoice($name,$age,$phone,$address,$gender,$reffer,$serviceType,$fees,$total,$discount,$net,$user){
    $invoice_id=time();
    $sqlI="INSERT INTO `invoice`(`invoice_id`, `name`, `age`, `phoneNumber`, `address`, `gender`, `refferBy`, `total`, `discount`,`billType`, `net`,`receivedBy`) VALUES ('$invoice_id','$name','$age','$phone','$address','$gender','$reffer',$total,$discount,'',$net,'$user')";
    mysqli_query($GLOBALS['conn'], $sqlI);
    if(isset($serviceType)){
        foreach($serviceType as $key => $value){
        $sql="INSERT INTO `invoice_details`(`invoice_id`, `serviceType`, `fees`) VALUES ('$invoice_id','$value','$fees[$key]')";
        mysqli_query($GLOBALS['conn'],$sql);
    }
    }
    
    return $invoice_id;
}

function fetchInovice(){
    $sql = "SELECT * FROM invoice ORDER BY date DESC";
    $result = mysqli_query($GLOBALS['conn'], $sql)  or die("SQL query failed");
    if($result){
        return $result;
    }

}
function fetchSIngleInovice($id){
    $sql = "SELECT * FROM invoice WHERE invoice_id='$id'";
    $result = mysqli_query($GLOBALS['conn'], $sql)  or die("SQL query failed");
    if($result){
        return $result;
    }

}

function fetchInvoiceDetails($id){
    $sql = "SELECT * FROM invoice_details WHERE invoice_id='$id'";
    $result = mysqli_query($GLOBALS['conn'], $sql)  or die("SQL query failed");
    if($result){
        return $result;
    }
}

?>