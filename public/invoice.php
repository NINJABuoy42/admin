<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location:login.php');
    die;
}

$user = $_SESSION['user'];
$title = 'Invoice';
include('../includes/header.php');
include('../db_conn/apiRegister.php');
include('../db_conn/apiInvoice.php');
$portal="Patient Detail";

if(isset($_GET['patient_id'])  && isset($_GET['prescription_id'])){
    $patient_id = $_GET['patient_id'];
    $prescription_id=$_GET['prescription_id'];
}
$portal = "Invoice";
if(isset($_POST['save'])){
    if(isset($_POST['serviceType']) && isset($_POST['subtotal'])){
    $name= $_POST['name'];
    $age= $_POST['age'];
    $phone= $_POST['phone'];
    $address= $_POST['address'];
    $gender= $_POST['gender'];
    $reffer= $_POST['reffer'];
    $serviceType= $_POST['serviceType'];
    $fees= $_POST['subtotal'];
    $total= $_POST['total'];
    $discount= $_POST['discount'];
    $net= $_POST['netAmt'];
        newInvoice($name,$age,$phone,$address,$gender,$reffer,$serviceType,$fees, $total,$discount,$net);
    }

}
?>

<body id="page-top">
    <div id="wrapper">
        <?php include('../includes/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('../includes/nav.php') ?>
                <div class="container-fluid">
                    <main id="main" class="main">
                        <div class="card ">
                            <div class="card-body ">
                                <form action="" method="post">
                                    <button type="submit" disabled style="display: none" aria-hidden="true"></button>

                                    <div class="row">
                                        <?php if(isset($patient_id) && isset($prescription_id)): ?>
                                        <div class="col-sm-6">
                                            <label for="prescription_id" class="form-label">Prescription ID</label>
                                            <input autocomplete="off" type="text" class="form-control"
                                                name="prescription_id" id="prescription_id"
                                                value="<?php echo $prescription_id ;?>" readonly>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="patient_id" class="form-label">Patient ID</label>
                                            <input autocomplete="off" type="text" class="form-control" id="patient_id"
                                                value="<?php echo $patient_id ;?>" name="patient_id" readonly>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-sm-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input autocomplete="off" type="text" class="form-control" id="name"
                                                name="name"  required>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="age" class="form-label">Age</label>
                                            <input autocomplete="off" type="text" class="form-control" id="age"
                                                name="age" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="gender" class="form-label">Gender</label>
                                            <input autocomplete="off" type="text" class="form-control" id="gender"
                                                name="gender" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="phone" class="form-label">Phone No.</label>
                                            <input autocomplete="off" type="text" class="form-control" id="phone"
                                                name="phone">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <label for="address" class="form-label">Address</label>
                                            <input autocomplete="off" type="text" class="form-control" id="address"
                                                name="address">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="reffer" class="form-label">Reffered By</label>
                                            <input autocomplete="off" type="text" class="form-control" id="reffer"
                                                name="reffer">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label for="serviceType">Service Type</label>
                                            <select id="serviceType" class="form-control" name="serviceType">
                                                <option value="">Select Service....</option>
                                                <option value="">Other</option>
                                                <?php
                               $services = getStatCatServices('Services');
                                while ($service = mysqli_fetch_assoc($services)) { ?>
                                                <option data-id="<?php echo $service["fees"]; ?>"
                                                    value="<?php echo $service["serviceType"]; ?>">
                                                    <?php echo $service["serviceType"]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <!-- <div class="col-sm-4">

                                        <button class="btn btn-success" id="addService" type="button"><i
                                                class="fas fa-plus"></i></button>
                                    </div> -->

                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-8 text-left">
                                            <h5><strong>Service Description</strong></h5>
                                        </div>
                                        <div class="col-sm-2 text-center">
                                            <h5><strong> Fees</strong></h5>
                                        </div>
                                        <div class="col-sm-1 text-center">#</div>
                                    </div>
                                    <hr>
                                    <div id="invoiceBody">
                                    </div>
                                    <hr>
                                    <div class="row amt mb-1" style="display: none;">
                                        <div class="col-sm-8 text-right">TOTAL:</div>
                                        <div class="col-sm-2 text-center"><input autocomplete="off" type="text"
                                                class="form-control input" name='total' id="total" value="0" readonly>
                                        </div>
                                    </div>
                                    <div class="row amt mb-1" style="display: none;">
                                        <div class="col-sm-8 text-right">DISCOUNT:</div>
                                        <div class="col-sm-2 text-center"><input autocomplete="off" type="text"
                                                class="form-control input" name='discount' id="discount" value="0">
                                        </div>
                                    </div>

                                    <div class="row amt" style="display: none;">
                                        <div class="col-sm-8 text-right">NET AMOUNT:</div>
                                        <div class="col-sm-2 text-center"><input autocomplete="off" type="text"
                                                class="form-control input" name='netAmt' id="netAmt" value="0" readonly>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3 col-md-12">
                                        <!-- <button type="button" class="btn btn-warning" name="getpatienId" id="getpatienId">Generate ID</button> -->
                                        <button type="submit" class="btn btn-success" name="save" id="save">Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </main>
                    <?php
                include('../includes/footer.php'); ?>
                </div>
            </div>
            <script>
            $('#serviceType').select2({
                theme: "bootstrap"
            });
            $("#serviceType").on('change', (e) => {
                if ($('#serviceType').val() != "") {
                    html = `<div class="row mb-2">
                                        <div class="col-sm-8 text-center"><input autocomplete="off" type="text" class="form-control input" name='serviceType[]' value='${$('#serviceType').val()}' readonly></div>
                                        <div class="col-sm-2 text-center"><input autocomplete="off" type="text" class="form-control input" name='subtotal[]' value='${$('#serviceType').find(':selected').data('id')}' readonly></div>
                                        <div class="col-sm-1 text-center"><button type="button" class="btn btn-danger" onclick="this.closest('.row').remove(); total();">X</button></div>
                                    </div> `;

                    $('#invoiceBody').append(html);
                    // console.log(parseInt($('#serviceType').find(':selected').data('id')));
                    // console.log($('#serviceType').val());
                    total();

                }
            })
            $('#discount').on('keyup', () => {
                total();
            });

            function total() {
                let sum = document.getElementsByName('subtotal[]');
                let total = 0;
                for (let i = 0; i < sum.length; i++) {
                    var amt = sum[i].value
                    total = +(total) + +(amt);
                }
                // console.log(total);
                $('#total').val(total);
                $('#netAmt').val(+(total) - +(($('#discount').val() / 100)) * +(total));
                $('.amt').show();
            }
            </script>