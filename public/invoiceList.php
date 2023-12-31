<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location:login.php');
    die;
}
$user = $_SESSION['user'];
$title = 'Invoice List';
$portal = "Invoice Details";
include('../includes/header.php');
// include('./db_conn/user.php');
include('../db_conn/apiInvoice.php');
$invoices = fetchInovice();
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    receiptDelete($id);
}
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('../includes/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('../includes/nav.php') ?>



                <div class="container-fluid">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Invoice List : Generated</h6>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="w-15">Invoice ID</th>
                                            <th class="w-15">Date</th>
                                            <th class="w-15">Name</th>
                                            <th class="w-15">Received By</th>
                                            <th class="w-15">Amount Paid</th>
                                            <th class="w-15">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($invoice = mysqli_fetch_assoc($invoices)) {
                                            include('../includes/modals/__deleteModal.php');
                                         include('../includes/modals/__editReceipt.php');


                                            
                                        ?>
                                        <tr>
                                            <td><?php echo $invoice['invoice_id'] ?></td>
                                            <td><?php echo date("d-M-Y", strtotime($invoice['date'])) ?></td>
                                            <td><?php echo $invoice['name'] ?></td>
                                            <td><?php echo $invoice['receivedBy'] ?></td>
                                            <td>&#8377;  <?php echo $invoice['net'] ?></td>
                                            <td class="d-flex justify-content-around">
                                                <?php if($_SESSION['role']=='admin'){?>
                                            <button type="click " class="del btn btn-danger"
                                                         data-toggle="modal"
                                                         data-id="<?php echo $invoice['invoice_id'] ?>"
                                                         data-table='services'
                                                        data-target="#deleteModal">
                                                        <i class="fas fa-trash"></i></button>
                                                    <?php } ?>
                                                <a class="btn btn-secondary"
                                                    href="demoPrint.php?invoice_id=<?php echo $invoice['invoice_id'] ?> "
                                                    onclick="window.open(this.href,'_blank','width=800,height=700'); return false;"><i
                                                        class="fas fa-print"></i></a>
                                                <a class="btn btn-success"
                                                    href="tPrint.php?invoice_id=<?php echo $invoice['invoice_id'] ?> "
                                                    onclick="window.open(this.href,'_blank','width=800,height=700'); return false;">
                                                    <i class="fas fa-file-powerpoint"></i></a>
                                            </td>
                                        </tr>

                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <?php
                    include('../includes/footer.php');
                    ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
    </div>
    <script>
    $('#dataTable').dataTable({
        "ordering": false
    });
    $(".del").on("click", function(e) {
        $("#deleteRecord").attr('href','invoiceList.php?delete='+ $(this).attr('data-id'));
        // console.log($(this).attr('data-id'));
    })
    $(".edit").on("click", function(e) {
        $("#receiptId").val($(this).data('id'));
        $("#name").val($(this).attr('data-name'));
        $("#amount").val($(this).attr('data-amount'));
    })
    </script>

    <!-- End of Content Wrapper -->

    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->