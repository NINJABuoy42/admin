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
$portal="Patient Detail";

if(isset($_GET['patient_id'])  && isset($_GET['prescription_id'])){
    $patient_id = $_GET['patient_id'];
    $prescription_id=$_GET['prescription_id'];
}
$portal = "Invoice";
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
                                <div class="row">
                                    <?php if(isset($patient_id) && isset($prescription_id)): ?>
                                    <div class="col-sm-6">
                                        <label for="prescription_id" class="form-label">Prescription ID</label>
                                        <input autocomplete="off" type="text" class="form-control" id="prescription_id"
                                            value="<?php echo $prescription_id ;?>" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="patient_id" class="form-label">Patient ID</label>
                                        <input autocomplete="off" type="text" class="form-control" id="patient_id"
                                            value="<?php echo $patient_id ;?>" readonly>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-sm-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input autocomplete="off" type="text" class="form-control" id="name">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="age" class="form-label">Age</label>
                                        <input autocomplete="off" type="text" class="form-control" id="age">
                                    </div>
                                    <div class="col-xl-6">

                                        <label for="service" class="form-label">Service</label>
                                        <div class="input-group mb-3">
                                            <select id="serviceType" class="form-control" name="serviceType">
                                                <?php
                               $services = getServices();
                                while ($service = mysqli_fetch_assoc($services)) { ?>
                                                <option data-id="<?php echo $service["fees"]; ?>" value="<?php echo $service["serviceType"]; ?>">
                                                    <?php echo $service["serviceType"]; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-success" id="addService" type="button"><i
                                                        class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <th class='w-75'>Service Description</th>
                                            <th class='w-25'>Sub Total</th>
                                            <th class='w-15'></th>
                                        </thead>
                                        <tbody id="invoiceBody">
                                        </tbody>
                                        <footer>
                                            <tr>
                                                <td class="text-right">Total: </td>
                                                <td><input type="text" name="total" id="total" class="form-control"></td>
                                            </tr>
                                        </footer>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <?php
                include('../includes/footer.php'); ?>
                </div>
            </div>
            <script>
                $("#addService").on('click', (e) => {
                html = `<tr>
                                    <td class="w-50"><input autocomplete="off" type="text" class="form-control input" name='serviceType[]' value='${$('#serviceType').val()}'></td>
                                    <td class="w-15"><input autocomplete="off" type="text" class="form-control input" name='subtotal[]' value='${$('#serviceType').find(':selected').data('id')}'></td>
                                    <td class="w-5"><button type="button" class="btn btn-danger" onclick="this.closest('tr').remove(); total();">X</button></td>
                                </tr>`;

                $('#invoiceBody').append(html);
                // console.log(parseInt($('#serviceType').find(':selected').data('id')));
                // console.log($('#serviceType').val());
                total();
            })

            function total(){
                let sum = document.getElementsByName('subtotal[]');
            let total=0;
            for(let i = 0;i< sum.length;i++){
                var amt = sum[i].value
                total = +(total) + +(amt) ;
            }
            console.log(total);
            $('#total').val(total);
        }
            </script>