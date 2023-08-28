<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location:login.php');
    die;
}

// if ($_SESSION['role'] != 'doctor') {
//     header('location:index.php');
//     die;
// }

$user = $_SESSION['user'];
$title = 'Dashboard';
include('./includes/header.php');
include('./db_conn/user.php');
include('./db_conn/dbConn.php');


if(isset($_POST['save'])){
    $medName=$_POST['medName'];
    echo '<pre>';
    print_r($_POST);
    echo "<script>console.log('.$medName.')</script>";
    $medDosage=$_POST['medDosage'];
    $medDuration=$_POST['medDuration'];
    foreach($medName as $key => $value) {
        $query = "INSERT INTO `medicine`(`medicine_name`, `dosage`, `duration`) VALUES ('$value','$medDosage[$key]','$medDuration[$key]')";
        $save=mysqli_query($conn,$query);
    }
}
?>

<body id="page-top">
                            <form class="row g-3 form-group"  method="POST">
                                <h5 class="card-title">Diagnosis/Prescription </h5>
                                <div class="col-md-12">
                                    <label for="referredBy" class="form-label">Referred By</label>
                                    <input autocomplete="off" type="text" class="form-control" id="referredBy" name="referredBy">
                                </div>
                                <div class="col-md-12">
                                    <label for="medicalHistory" class="form-label">Past Medical History</label>
                                    <input autocomplete="off" type="text" class="form-control" id="medicalHistory" name="medicalHistory">
                                </div>
                                <div class="col-md-12">
                                    <label for="clinicalPresentation" class="form-label">Chief Complaint</label>
                                    <input autocomplete="off" type="text" class="form-control" id="clinicalPresentation" name="clinicalPresentation">
                                </div>
                                <div class="col-md-12">
                                    <label for="diagnosis" class="form-label">Diagnosis/Provisional Diagnosis
                                    </label>
                                    <input autocomplete="off" type="text" class="form-control" id="diagnosis" name="diagnosis" >
                                </div>
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="w-15">#</th>
                                                <th class="w-50">Medicine Name</th>
                                                <th class="w-25">Dosage</th>
                                                <th class="w-25">Duration</th>
                                                <th class="w-5">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tBody">
                                            <tr>
                                                <td class="w-15">1</td>
                                                <td class="w-50"><input autocomplete="off" type="text" class="form-control input" id="medName" ></td>
                                                <td class="w-25"><input autocomplete="off" type="text" class="form-control input" id='medDosage'></td>
                                                <td class="w-25"><input autocomplete="off" type="text" class="form-control input" id=medDosage></td>
                                                <th class="w-5"><button type="button" class="btn btn-success" id="add">ADD</button></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- ********** -->


                                <hr>
                                <div class="text-center mt-3 col-md-12">
                                    <!-- <button type="button" class="btn btn-warning" name="getpatienId" id="getpatienId">Generate ID</button> -->
                                    <button type="submit" class="btn btn-success" name="save" id="save">Save & Verify</button>
                                    <button type="reset" class="btn btn-secondary" id="reset">Reset</button>
                                </div>
                            </form><!-- End Multi Columns Form -->
                            <?php
                    include('./includes/footer.php'); ?>
            <script>
                $(document).ready(function() {
                    $("#add").on('click', (e) => {
                        console.log("add");
                        html = `<tr>
                                    <td class="w-15">1</td>
                                    <td class="w-50"><input autocomplete="off" type="text" class="form-control input" name='medName[]' value=${$('#medName').val()}></td>
                                    <td class="w-25"><input autocomplete="off" type="text" class="form-control input" name='medDosage[]' value=${$('#medDosage').val()}></td>
                                    <td class="w-25"><input autocomplete="off" type="text" class="form-control input" name='medDuration[]' value=${$('#medDuration').val()}></td>
                                    <td class="w-5"><button type="button" class="btn btn-danger rem" onclick="this.closest('tr').remove();">REM</button></td>
                                </tr>`;
                                $('#medName').val('');
                                $('#medDosage').val('');
                                $('#medDuration').val('');
                        $('#tBody').append(html);

                    })
                })
            </script>