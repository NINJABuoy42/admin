<?php
require('../db_conn/dbConn.php');
$query = "SELECT * FROM users where role='doctor'";
$result = mysqli_query($GLOBALS['conn'], $query) or die("SQL query failed");
return $result;

?>
