<?php
require('../db_conn/dbConn.php');

function getReport($service,$duration){
    if($service == 'services'){
        switch($duration){
            case 'daily':
                $sqlDaily = "SELECT date(date) as duration, SUM(net) as total, billType from invoice WHERE billType LIKE 'service' GROUP BY date(date) ORDER BY date(date) DESC;";
                $resultDaily = mysqli_query($GLOBALS['conn'], $sqlDaily) or die("SQL query failed");
                return $resultDaily;
            case 'monthly':
                $sqlMonthly = "SELECT monthname(date) as duration, SUM(net) as total, billType from invoice WHERE billType LIKE 'service' GROUP BY monthname(date) ORDER BY date DESC;";
                $resultMonthly = mysqli_query($GLOBALS['conn'], $sqlMonthly) or die("SQL query failed");
                return $resultMonthly;
        }
    }
    elseif($service == 'registration'){
        switch($duration){
            case 'daily':
                $sqlDaily = "SELECT date(date) as duration, SUM(net) as total, billType from invoice WHERE billType LIKE 'registration' GROUP BY date(date) ORDER BY date(date) DESC;";
                $resultDaily = mysqli_query($GLOBALS['conn'], $sqlDaily) or die("SQL query failed");
                return $resultDaily;
            case 'monthly':
                $sqlMonthly = "SELECT monthname(date) as duration, SUM(net) as total, billType from invoice WHERE billType LIKE 'registration' GROUP BY monthname(date) ORDER BY date DESC;";
                $resultMonthly = mysqli_query($GLOBALS['conn'], $sqlMonthly) or die("SQL query failed");
                return $resultMonthly;
        }
    }
    
}

?>