<?php
require('../db_conn/dbConn.php');

function getReport($service, $duration)
{
    if ($service == 'services') {
        switch ($duration) {
            case 'daily':
                $sqlDaily = "SELECT date(date) as dateD, DAYNAME(date) as dateY,year(date) as year, SUM(net) as total, billType from invoice WHERE billType LIKE 'service' GROUP BY date(date) ORDER BY date(date) DESC";
                $resultDaily = mysqli_query($GLOBALS['conn'], $sqlDaily) or die("SQL query failed");
                return $resultDaily;
            case 'monthly':
                $sqlMonthly = "SELECT monthname(date) as monthM, year(date) as year, SUM(net) as total, billType from invoice WHERE billType LIKE 'service' GROUP BY monthname(date),year(date) ORDER BY date(date) DESC";
                $resultMonthly = mysqli_query($GLOBALS['conn'], $sqlMonthly) or die("SQL query failed");
                return $resultMonthly;
            case 'yearly':
                $sqlYearly = "SELECT year(date) as yearY, SUM(net) as total,year(date) as year, billType from invoice WHERE billType LIKE 'service' GROUP BY year(date) ORDER BY year(date) DESC";
                $resultYearly = mysqli_query($GLOBALS['conn'], $sqlYearly) or die("SQL query failed");
                return $resultYearly;
        }
    } elseif ($service == 'registration') {
        switch ($duration) {
            case 'daily':
                $sqlDaily = "SELECT date(date) as dateD, DAYNAME(date) as dateY,year(date) as year, SUM(net) as total, billType from invoice WHERE billType LIKE 'registration' GROUP BY date(date) ORDER BY date(date) DESC";
                $resultDaily = mysqli_query($GLOBALS['conn'], $sqlDaily) or die("SQL query failed");
                return $resultDaily;
            case 'monthly':
                $sqlMonthly = "SELECT monthname(date) as monthM, year(date) as year, SUM(net) as total, billType from invoice WHERE billType LIKE 'registration' GROUP BY monthname(date),year(date) ORDER BY date(date) DESC";
                $resultMonthly = mysqli_query($GLOBALS['conn'], $sqlMonthly) or die("SQL query failed");
                return $resultMonthly;
            case 'yearly':
                $sqlYearly = "SELECT year(date) as yearY, SUM(net) as total,year(date) as year, billType from invoice WHERE billType LIKE 'registration' GROUP BY year(date) ORDER BY year(date) DESC";
                $resultYearly = mysqli_query($GLOBALS['conn'], $sqlYearly) or die("SQL query failed");
                return $resultYearly;
        }
    }

}

function reportPrint($type,$duration, $serviceType, $year)
{
    switch ($type) {
        case 'daily':
            $sql = "SELECT invoice_id, date(date)as date,name,receivedBy,net,billType FROM invoice WHERE date(date)='{$duration}' AND billType LIKE '{$serviceType}' AND year(date) = {$year}";
            $result = mysqli_query($GLOBALS['conn'], $sql) or die("SQL query failed");
            return $result;

        case 'monthly':
            $sql = "SELECT invoice_id, date(date)as date,name,receivedBy,net,billType FROM invoice WHERE monthname(date) LIKE '{$duration}' AND billType LIKE '{$serviceType}' AND year(date) = {$year}";
            $result = mysqli_query($GLOBALS['conn'], $sql) or die("SQL query failed");
            return $result;

        case 'yearly':
            $sql = "SELECT invoice_id, date(date)as date,name,receivedBy,net,billType FROM invoice WHERE year(date) ={$duration} AND billType LIKE '{$serviceType}' AND year(date) = {$year}";
            $result = mysqli_query($GLOBALS['conn'], $sql) or die("SQL query failed");
            return $result;

    }
    // $sql = "SELECT invoice_id, date(date)as date,name,receivedBy,net,billType FROM invoice WHERE monthname(date) LIKE '{$duration}' AND billType LIKE '{$serviceType}' AND year(date) = {$year}";
    // $result = mysqli_query($GLOBALS['conn'], $sql) or die("SQL query failed");
    // return $result;
}