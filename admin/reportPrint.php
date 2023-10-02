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
$net = $_GET['net'];
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
            text-transform: uppercase;
            
        }
        table,thead,tbody{
            width: 100%;
            text-align: center;
            border: 2px solid black;
            font-size: 12px;

        }
        td,th{
            border: 2px solid black;
        }
        .borderB{
            border-bottom: 2px solid black;
        }
    </style>
</head>

<body>
    <h2 class="text-center borderB">AMKUS - Collection Report</h2>
    
    <div class="row text-center borderB">
        <div class="col-sm-4" ><h5><strong>Report Type: </strong><?php echo $type; ?></h5></div>
        <div class="col-sm-4" ><h5><strong>Duration: </strong><?php echo $duration; ?></h5></div>
        <div class="col-sm-4" ><h5><strong>Service Type: </strong><?php echo $serviceType; ?></h5></div>
    </div>
    <table class="mt-3">
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
                    <td><?php echo date("d-M-Y", strtotime($report['date'])) ?></td>
                    <td><?php echo $report['name'] ?></td>
                    <td><?php echo $report['billType'] ?></td>
                    <td><?php echo $report['receivedBy'] ?></td>
                    <td>&#8377; <?php echo $report['net'] ?></td>

                </tr>
                <?php }?>
                <footer>
                    <td colspan="5" class="text-right"><h5><strong>NET AMOUNT</strong></h5></td>
                    <td colspan="4"><h5><strong>&#8377;<?php echo $net; ?></strong></h5></td>
                </footer>
        </tbody>
    </table>
    <div class="btn text-center mt-3 col-md-12">
        <button type="button" onclick="window.print()" id="checkin" class="btn btn-primary">Print</button>
    </div>
</body>