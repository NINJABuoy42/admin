<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location:../login.php');
    die;
}
$user = $_SESSION['user'];
$title = 'Doctors List';
$portal = 'Details';
require '../includes/header.php';
include('../db_conn/apiRegister.php');
include('../db_conn/apiCrud.php');
if(isset($_POST['addService'])){
    $serviceType = $_POST['serviceType'];
    $fees = $_POST['fees'];
    addService($serviceType,$fees);
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $tableName='services';
    deleteID($tableName,$id,'../admin/services.php');
}
if(isset($_POST['editService'])){
    $id = $_POST['user_id'];
    echo $id;
    $serviceType=$_POST['service_type'];
    $fees=$_POST['fee'];
    $status=$_POST['stats'];
    editService($id,$serviceType,$fees,$status);
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
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">SERVICES</h6>
                        </div>
                        <div class="card-body">
                            <div class="col-xl-12">
                                <form action="" method="POST">
                                
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="text" name="serviceType" class="form-control" id="serviceType" placeholder="Add New Service..">

                                        </div>
                                        <div class="col-sm-4">
                                            <input type="number" name="fees" class="form-control" id="fees" placeholder="Amount...">

                                        </div>
                                        <div class="col-sm-3">
                                            <button type="submit" class="btn btn-success" id="addService"
                                                name="addService">ADD</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                            <div>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="w-50">Service Description</th>
                                            <th class="25">Fees</th>
                                            <th class="25">Status</th>
                                            <th class="w-5">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $services = getAllServices();
                                         include('../includes/modals/__deleteModal.php');
                                         include('../includes/modals/__editService.php');
                                         while($service = mysqli_fetch_assoc($services)) : ?>
                                        <tr>
                                            <td><?php echo $service['serviceType'];?></td>
                                            <td>&#8377; <?php echo $service['fees'];?>/-</td>
                                            <td><?php echo $service['status'];?></td>
                                            


                                            <td class="d-flex justify-content-around">
                                                <button type="click" class="edit btn btn-info"
                                                     data-toggle="modal"
                                                    data-target="#serviceEdit"
                                                    data-id="<?php echo $service['id'];?>"
                                                    data-serviceType="<?php echo $service['serviceType'];?>"
                                                    data-fee="<?php echo $service['fees'];?>">

                                                    <i class="fas fa-edit"></i>
                                                    <button type="click " class="del btn btn-danger"
                                                         data-toggle="modal"
                                                         data-id="<?php echo $service['id'];?>"
                                                         data-table='services'
                                                        data-target="#deleteModal">
                                                        <i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>



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
    $(".del").on("click", function(e) {
        $("#deleteRecord").attr('href','services.php?delete='+ $(this).attr('data-id'));
        // console.log($(this).attr('data-id'));
    })
    $(".edit").on("click", function(e) {
        $("#user_id").val($(this).data('id'));
        $("#service_type").val($(this).attr('data-serviceType'));
        $("#fee").val($(this).attr('data-fee'));
    })
    </script>