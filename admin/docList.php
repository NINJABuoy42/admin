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
include('../db_conn/user.php');
$doctors = getDoctors();

if (isset($_GET['delete'])) {
    $dels = $_GET['delete'];
    deleteUser($dels);
}
if (isset($_POST['editRecord'])) {
    $status = $_POST['status'];
    $role = $_POST['role'];
    $user_id = $_POST['user_id'];
    updateUser($user_id,$status,$role);}
if (isset($_POST['addDoc'])) {
    $doc_id = $_POST['docName'];
    addDoc($doc_id);

}
if (isset($_POST['editDoc'])) {
    $docID=$_POST['user_id'];
    $docReg=$_POST['regNo'];
    $docQual=$_POST['qualification'];
    $docCurr=$_POST['current'];
    $docMail=$_POST['email'];
    updateDoc($docID,$docReg,$docQual,$docCurr,$docMail);

}
$docList= fetchDocs();
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
                            <div class="col-xl-12">
                                <form action="" method="POST">
                                <label for="diagnosis" class="form-label">Doctor List
                                </label>
                                <div class="input-group mb-3">
                                    <select id="docList" class="form-control" name="docName">
                                    <option value="">SELECT...</option>
                                        <?php while ($doc = mysqli_fetch_assoc($doctors)) { ?>
                                        <option value="<?php echo $doc['user_id'] ?>"><?php echo $doc['fullName'] ?></option>
                                        <?php }?>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-success" name="addDoc" type="submit"><i
                                                class="fas fa-plus"></i></button>

                                    </div>
                                    </form>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>RegNo</th>
                                            <th>Qualification</th>
                                            <th>Current</th>
                                            <th>Email</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($doc = mysqli_fetch_assoc($docList)) {
                                            include('../includes/modals/__deleteModal.php');
                                            include('../includes/modals/__docEdit.php');
                                        ?>
                                        <tr>
                                            <td><?php echo $doc['Name'] ?></td>
                                            <td><?php echo $doc['regNo'] ?></td>
                                            <td><?php echo $doc['qualifications'] ?></td>
                                            <td><?php echo $doc['current'] ?></td>
                                            <td><?php echo $doc['email'] ?></td>
                                            <td class="d-flex justify-content-around">
                                                <button type="click" class="edit btn btn-info"
                                                    data-user_id="<?php echo $doc['user_id'] ?>"
                                                    data-fullName="<?php echo $doc['Name'] ?>" data-toggle="modal"
                                                    data-target="#docEdit">
                                                    <i class="fas fa-edit"></i>
                                                    <button type="click " class="del btn btn-danger"
                                                        data-id="<?php echo $doc['Name'] ?>" data-toggle="modal"
                                                        data-target="#deleteModal">
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
        $("#Name").val($(this).attr('data-fullName'));
        // console.log($(this).attr('data-id'));
    })
</script>