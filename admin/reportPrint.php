<?php
// include("./includes/header.php");
require('../db_conn/dbConn.php');
include('../db_conn/apiReport.php');
// include('./db_conn/user.php');

if (!isset($_GET['type'])) {
    header('location:204.php');
}
$duration =$_GET['duration'];
$serviceType =$_GET['service'];
$year =$_GET['year'];
$type = $_GET['type'];
// echo $duration." ".$serviceType." ".$year;
$reports = reportPrint($type,$duration,$serviceType,$year);
?>

<head>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/print.css" rel="stylesheet" media="print">
    <title>Report- Print</title>
    <style>
        body{
            padding: 2rem;
            color:black;
        }
        table,thead,tbody{
            width: 100%;
            text-align: center;
            border: 2px solid black;
        }
        td,th{
            border: 2px solid black;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <th class="w-15">Bill ID</th>
            <th class="w-15">Date</th>
            <th class="w-25">Name</th>
            <th class="w-15">Bill Type</th>
            <th class="w-15">Collected By</th>
            <th class="w-15">Amount</th>
        </thead>
        <tbody>
            <?php while($report = mysqli_fetch_assoc($reports)){ ?>
                <tr>
                    <td><?php echo $report['invoice_id'] ?></td>
                    <td><?php echo $report['date'] ?></td>
                    <td><?php echo $report['name'] ?></td>
                    <td><?php echo $report['billType'] ?></td>
                    <td><?php echo $report['receivedBy'] ?></td>
                    <td>&#8377; <?php echo $report['net'] ?></td>

                </tr>
                <?php }?>
        </tbody>
    </table>
    <div class="btn text-center mt-3 col-md-12">
        <button type="button" onclick="window.print()" id="checkin" class="btn btn-primary">Print</button>
    </div>
</body>