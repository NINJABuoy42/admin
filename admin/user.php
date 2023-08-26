<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location:../public/login.php');
    die;
}
$user = $_SESSION['user'];
$title = 'Users';
$portal = 'Users Detail';
require '../includes/header.php';
include('../db_conn/user.php');
$result = getUser();

if (isset($_GET['delete'])) {
    $dels = $_GET['delete'];
    deleteUser($dels);
}
if (isset($_POST['editRecord'])) {
    $status = $_POST['status'];
    $role = $_POST['role'];
    $user_id = $_POST['user_id'];
    // $name = $_POST['fullName'];
    updateUser($user_id,$status,$role);}
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
                            <h6 class="m-0 font-weight-bold text-primary">USERS</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Status</th>
                                            <th>Role</th>
                                            <th>Reg_date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($rows = mysqli_fetch_assoc($result)) {
                                            include('../includes/modals/__deleteModal.php');
                                            include('../includes/modals/__editModal.php');
                                        ?>
                                            <tr>
                                                <td><?php echo $rows['fullName'] ?></td>
                                                <td><?php echo $rows['userName'] ?></td>
                                                <td><?php echo $rows['status'] ?></td>
                                                <td><?php echo $rows['role'] ?></td>
                                                <td><?php echo $rows['reg_date'] ?></td>
                                                <td class="d-flex justify-content-around">
                                                    <button type="click" class="edit btn btn-info" data-user_id="<?php echo $rows['user_id'] ?>" data-fullName="<?php echo $rows['fullName'] ?>" data-toggle="modal" data-target="#editModal">
                                                    <i class="fas fa-edit"></i>
                                                    <button type="click " class="del btn btn-danger" data-id="<?php echo $rows['userName'] ?>" data-toggle="modal" data-target="#deleteModal">
                                                        <i class="fas fa-trash"></i></button>
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
    $(".del").on("click",function(e){
        $("#deleteRecord").attr('href','user.php?delete='+$(this).attr('data-id'));
        // console.log($(this).attr('data-id'));
    })
    $(".edit").on("click",function(e){
        $("#user_id").val($(this).attr('data-user_id'));
        $("#fullName").val($(this).attr('data-fullName'));
        // console.log($(this).attr('data-id'));
    })
</script>

