<?php
// include("./includes/header.php");
require('../db_conn/dbConn.php');
include('../db_conn/apiInvoice.php');
// include('./db_conn/user.php');

if (!isset($_GET['invoice_id'])) {
    header('location:204.php');
}
$invoices = fetchSIngleInovice($_GET['invoice_id']);
$details = fetchInvoiceDetails($_GET['invoice_id'])
?>

<head>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/print.css" rel="stylesheet" media="print">
    <title>Invoice- Print</title>
    <style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-size: large;
    }

    body {
        padding: 2rem;
        width: 100vw;
        height: 100vh;
        color: black;
    }

    .above {
        z-index: 100;
    }

    body::after {
        content: " ";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: .2;
        z-index: -1;
        background: url('../img/amkus.png');
        background-repeat: no-repeat;
        background-position: center;
    }

    .line {
        border: 2px solid black;
    }

    .head {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .row{
        font-size: large;
    }
    footer{
        bottom: 0;
    }
    </style>
</head>

<body>

    <div class="row above">
        <div class="col-12 head">
            <img src="../img/receipt.jpg" width="50%">
        </div>
    </div>
    <hr class="border">
    <div class="text-center">
        <h2><strong>INVOICE</strong></h2>
    </div>
    <?php while ($invoice = mysqli_fetch_assoc($invoices)) { ?>
    <hr class="border ">
    <div class="row text-left ">
        <div class="col-sm-9 ">
            <strong>Invocie #: </strong><?php echo $invoice['invoice_id'] ?>
        </div>
        <div class="col-sm-3">
            <strong>Date: </strong><?php echo date("d-M-Y", strtotime($invoice['date'])) ?>
        </div>
    </div>
    <hr>

    <br>
    <div class="row">
        <div class="col-sm-4">
            <strong>Name: </strong><?php echo $invoice['name'] ?> | <?php echo $invoice['age'] ?> | <?php echo $invoice['gender'] ?>
        </div>
        <div class="col-sm-4">
            <strong>Phone No: </strong><?php echo $invoice['phoneNumber'] ?>
        </div>
        <div class="col-sm-4">
            <strong>Reffered By: </strong><?php echo $invoice['refferBy'] ?>
        </div>
        <div class="col-sm-8">
            <strong>Address: </strong><?php echo $invoice['address'] ?>
        </div>

    </div>
    <hr class="border">
    <br>
    <div class="row ml-2">
        <div class="col-sm-9 "><strong>Service Description</strong></div>
        <div class="col-sm-3 text-left"><strong>Sub Total</strong></div>
    </div>
    <hr>
    <ol type="1" class="ml-3">
    <?php while ($detail = mysqli_fetch_assoc($details)) { ?>
        <li class="mb-1">
            <div class="row ">
                <div class="col-sm-9 "><?php echo $detail['serviceType'] ?></div>
                <div class="col-sm-3 text-left">&#8377;  <?php echo $detail['fees'] ?></div>
            </div>
        </li>
        <?php } ?>
    </ol>
    <hr class="border">
    <div class="footer">
        <div class="row">
            <div class="col-sm-9 text-right "><strong>Total :</strong></div>
            <div class="col-sm-3 text-left"><strong>&#8377; <?php echo $invoice['total'] ?></strong></div>
        </div>
        <div class="row">
            <div class="col-sm-9 text-right "><strong>Discount(%):</strong></div>
            <div class="col-sm-3 text-left"><strong> <?php echo $invoice['discount'] ?>%</strong></div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-9 text-right "><strong>Net Amount :</strong></div>
            <div class="col-sm-3 text-left"><h5><strong>&#8377;  <?php echo $invoice['net'] ?></strong></h5></div>
        </div>
    </div>
    <?php } ?>
    <footer class="text-center mt-5">
        <strong><span><em>PLEASE BRING THIS RECEIPT ON YOUR NEXT VISIT TO COLLECT THE REPORT</em></span></strong>
    </footer>


    <div class="btn text-center mt-3 col-md-12">
        <button type="button" onclick="window.print()" id="checkin" class="btn btn-primary">Print</button>
    </div>
</body>