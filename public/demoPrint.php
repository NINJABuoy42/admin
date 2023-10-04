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
        body {
            padding: 2rem;
            color: black;
            text-transform: uppercase;

        }

        table {
            width: 100%;
            /* text-align: center; */
            /* border: 2px solid black; */
            font-size: 1rem;

        }

        td {
            padding: 10px;
        }

        /* td,th{
            border: 2px solid black;
        } */
        .borderB {
            border-bottom: 2px solid black;
            margin-bottom: 1rem;

        }

        .head {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <?php while ($invoice = mysqli_fetch_assoc($invoices)) { ?>
        <div class="row above borderB">
            <div class="col-12 head">
                <img src="../img/receipt.jpg" width="50%">
            </div>
        </div>
        <table>
            <tbody class="p-2 borderB">
                <tr class="text-center borderB">
                    <td colspan="4">
                        <h4><strong>MONEY RECEIPT</strong></h4>
                    </td>
                </tr>
                <tr>
                    <td >
                        <strong>Receipt #: </strong>
                        <?php echo $invoice['invoice_id'] ?>
                    </td>
                    <td >
                    <strong>Date: </strong><?php echo date("d-M-Y", strtotime($invoice['date'])) ?>
                    </td>
                    <td>
                        <strong>Name: </strong>
                        <?php echo $invoice['name'] ?>
                    </td>
                    <td>
                        <strong>Age: </strong>
                        <?php echo $invoice['age'] ?> Y
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Gender: </strong>
                        <?php echo $invoice['gender'] ?>
                    </td>
                    <td>
                        <strong>Phone No: </strong>+91
                        <?php echo $invoice['phoneNumber'] ?>
                    </td>
                    <td colspan="2">
                        <strong>Address: </strong>
                        <?php echo $invoice['address'] ?>
                    </td>
                </tr>
                <tr>
                    
                </tr>
            </tbody>
        </table>
        <br>
        <table>
            <tbody class="p-2 borderB">
                <tr class="borderB">
                    <td class="w-75 text-left"><strong>Service Description</strong></td>
                    <td class="w-25 text-center"><strong>Sub Total</strong></td>
                </tr>
                <?php while ($detail = mysqli_fetch_assoc($details)) { ?>
                    <tr>
                        <td>
                            <?php echo $detail['serviceType'] ?>
                        </td>
                        <td class="w-25 text-center">
                            &#8377;
                            <?php echo $detail['fees'] ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfooter>
                <tr>
                    <td class="text-right"><strong>Net Amount :</strong></td>
                    <td class="text-center">
                        <h5><strong>&#8377;
                                <?php echo $invoice['net'] ?>
                            </strong></h5>
                    </td>
                </tr>
            </tfooter>
        </table>
    <?php } ?>
    <div class="btn text-center mt-3 col-md-12">
        <button type="button" onclick="window.print()" id="checkin" class="btn btn-primary">Print</button>
    </div>
    <footer class="text-center mt-5">
        <strong><span><em>PLEASE BRING THIS RECEIPT ON YOUR NEXT VISIT TO COLLECT THE REPORT</em></span></strong>
    </footer>
</body>
<script src="../vendor/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        window.print();
    })
</script>