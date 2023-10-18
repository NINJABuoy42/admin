<?php
require('fpdf/fpdf.php');
require('../db_conn/dbConn.php');
include('../db_conn/apiInvoice.php');
// include('./db_conn/user.php');

if (!isset($_GET['invoice_id'])) {
    header('location:204.php');
}

$invoices = fetchSIngleInovice($_GET['invoice_id']);
$details = fetchInvoiceDetails($_GET['invoice_id']);

$pdf = new FPDF('P', 'mm', array(58, 150));
$pdf->SetMargins(2, 2, 2);
$pdf->AddPage();
$pdf->Image('../img/receipt.jpg', 9, 3, -400);
$width = 3.5;
$pdf->SetY(20);
$pdf->SetFont('Courier', 'B', 9);
$pdf->MultiCell(54, 5, 'MONEY RECEIPT', 'TB', 'C', false);
$pdf->SetFont('Courier', 'B',7);

while ($invoice = mysqli_fetch_assoc($invoices)) {
    $pdf->Cell(30, 4, '#:' . $invoice['invoice_id'], 0, 0, 'L');
    $pdf->Cell(24, 4, 'Date:' . date("d-m-Y", strtotime($invoice['date'])), 0, 1, 'R');
    $xIv = $pdf->GetX();
    $yIv = $pdf->GetY();
    $pdf->Line(2, $yIv, 56, $yIv);
    // $pdf->Line(2, 29, 56, 29);
    $pdf->Ln(1);
    $pdf->Cell(54, $width, 'NAME: ' . $invoice['name'], 0, 1, 'L');
    $pdf->Cell(20, $width, 'AGE: ' . $invoice['age'] . '|' . $invoice['gender'], 0, 0, 'L');
    $pdf->Cell(34, $width, 'Ph No.:+91' . $invoice['phoneNumber'], 0, 1, 'R');
    $pdf->MultiCell(54, $width, 'ADDRESS: ' . $invoice['address'], '', 'L', false);
    $pdf->MultiCell(54, $width, 'REFERRED BY: ' . $invoice['refferBy'], '', 'L', false);

    $xIvs = $pdf->GetX();
    $yIvs = $pdf->GetY();
    $pdf->Line(2, $yIvs, 56, $yIvs);
    // $pdf->Line(2, 46.5, 56, 46.5);
    $pdf->Ln(1);
    // $pdf->SetFont('Arial','B',7);
    $pdf->Cell(44, $width, 'SERVICE DESCRIPTION', 0, 0, 'L');
    $pdf->Cell(10, $width, 'AMOUNT', 0, 1, 'R');
    $xSer = $pdf->GetX();
    $ySer = $pdf->GetY();
    $pdf->Line(2, $ySer, 56, $ySer);
    $pdf->Ln(1);

    while ($detail = mysqli_fetch_assoc($details)) {
        $pdf->Cell(44, $width, $detail['serviceType'], 0, 0, 'L');
        $pdf->Cell(10, $width, 'Rs. ' . $detail['fees'], 0, 1, 'R');
    }
    $xAmt = $pdf->GetX();
    $yAmt = $pdf->GetY();
    $pdf->Line(2, $yAmt, 56, $yAmt);
    if ($invoice['discount'] != 0) {
        $pdf->Cell(44, $width, 'SUB TOTAL : ', 0, 0, 'R');
        $pdf->Cell(10, $width, 'Rs. ' . $invoice['total'], 0, 1, 'R');
        $pdf->Cell(44, $width, '(-)DISCOUNT : ', 0, 0, 'R');
        $pdf->Cell(10, $width, $invoice['discount'] . '%', 0, 1, 'R');
        $xDis = $pdf->GetX();
        $yDis = $pdf->GetY();
        $pdf->Line(2, $yDis, 56, $yDis);
    }
    $pdf->SetFont('Courier', 'B', 10);
    $pdf->Cell(40, $width, 'NET AMOUNT: ', 0, 0, 'R');
    $pdf->Cell(14, $width, 'Rs.' . $invoice['net'], 0, 1, 'R');
    
    $xNet = $pdf->GetX();
    $yNet = $pdf->GetY();
    $pdf->Line(2, $yNet, 56, $yNet);
    $pdf->Ln(2);
    $pdf->SetFont('Courier', 'BI', 6);
    $pdf->MultiCell(54, $width,'KINDLY BRING THIS RECEIPT ALONG WITH YOU ON YOUR NEXT VISIT..', '', 'C', false);
    $pdf->Cell(54, $width, 'THANK YOU!!', 1, 1, 'C');



}
// $pdf->Cell(54,5,'Hello World!',1,1,'C');
$pdf->Output();
?>
<script src="../vendor/jquery/jquery.min.js"></script>
