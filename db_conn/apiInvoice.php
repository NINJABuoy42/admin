<?php
require('../db_conn/dbConn.php');

function newInvoice($name,$age,$phone,$address,$gender,$reffer,$serviceType,$fees,$total,$discount,$net,$user ){
    $invoice_id=time();
    $sqlI="INSERT INTO `invoice`(`invoice_id`, `name`, `age`, `phoneNumber`, `address`, `gender`, `refferBy`, `total`, `discount`, `net`,`receivedBy`) VALUES ('$invoice_id','$name','$age','$phone','$address','$gender','$reffer',$total,$discount,$net,'$user')";
    mysqli_query($GLOBALS['conn'], $sqlI);
    foreach($serviceType as $key => $value){
        $sql="INSERT INTO `invoice_details`(`invoice_id`, `serviceType`, `fees`) VALUES ('$invoice_id','$value','$fees[$key]')";
        mysqli_query($GLOBALS['conn'],$sql);
    }
}

function fetchInovice(){
    $sql = "SELECT * FROM invoice ORDER BY date DESC";
    $result = mysqli_query($GLOBALS['conn'], $sql)  or die("SQL query failed");
    if($result){
        return $result;
    }

}

?>