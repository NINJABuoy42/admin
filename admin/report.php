<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location:../public/login.php');
    die;
}
if ($_SESSION['role'] != 'admin') {
    header('location:../public/index.php');
    die;
}
$user = $_SESSION['user'];
$title = 'Generate Report';
$portal = 'Report';
require '../includes/header.php';
include('../db_conn/apiReport.php');
if (isset($_POST['view'])) {
    $service = $_POST['serviceType'];
    $duration = $_POST['duration'];
    
    $reports = getReport($service, $duration);
    // echo "<pre>";
    // print_r($result);
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
                                        <div class="col-sm-3">
                                            <select id="serviceType" class="form-control" name="serviceType" required>
                                                <option value="">Select Service....</option>
                                                <option value="registration">Registration</option>
                                                <option value="services">Service</option>
                                                <option value="Other">Other</option>
                                                <!-- <option value="">Other</option> -->

                                            </select>
                                            <!-- <input autocomplete="off" type="text" class="form-control" id="gender"
                                                name="gender" required> -->
                                        </div>
                                        <div class="col-sm-3">
                                            <select id="duration" class="form-control" name="duration" required>
                                                <option value="">Select Duration....</option>
                                                <option value="daily">Daily</option>
                                                <option value="monthly">Monthly</option>
                                                <option value="yearly">Yearly</option>
                                                <!-- <option value="">Other</option> -->

                                            </select>
                                            <!-- <input autocomplete="off" type="text" class="form-control" id="gender"
                                                name="gender" required> -->
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="submit" class="btn btn-primary" id="view"
                                                name="view">VIEW</button>
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
                                        <tr class="text-center">
                                            <th class="w-25 text-left">Date/Month</th>
                                            <th class="w-25">Service Type</th>
                                            <th class="w-25">Total Collection</th>
                                            <th class="w-25">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php if (isset($reports)) {
                                            while ($report = mysqli_fetch_assoc($reports)) { ?>
                                                <tr>
                                                    <td class="text-left">
                                                        <?php
                                                        if (isset($report['dateD'])) {
                                                            echo $report['dateD'];
                                                        } elseif (isset($report['monthM'])) {
                                                            echo $report['monthM'];
                                                        } elseif (isset($report['yearY'])) {
                                                            echo " ";
                                                        }
                                                        ?> |
                                                        <?php
                                                        if (isset($report['dateY'])) {
                                                            echo $report['dateY'];
                                                        } elseif (isset($report['year'])) {
                                                            echo $report['year'];
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $report['billType']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $report['total']; ?>
                                                    </td>
                                                    <td><a class="btn btn-secondary"
                                                            href="reportPrint.php?type=<?php if (isset($report['dateD'])) {
                                                                echo "daily";
                                                            } elseif (isset($report['monthM'])) {
                                                                echo "monthly";
                                                            } elseif (isset($report['yearY'])) {
                                                                echo "yearly";
                                                            } ?>&duration=<?php
                                                            if (isset($report['dateD'])) {
                                                                echo $report['dateD'];
                                                            } elseif (isset($report['monthM'])) {
                                                                echo $report['monthM'];
                                                            } elseif (isset($report['yearY'])) {
                                                                echo $report['yearY'];
                                                            }
                                                            ?>&service=<?php echo $report['billType']; ?>&year=<?php echo $report['year']; ?>"
                                                            onclick="window.open(this.href, '_blank', 'width=975,height=700'); return false;"><i
                                                                class="fas fa-print"></i></a></td>
                                                </tr>
                                            <?php }
                                        } ?>
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
        $('#dataTable').DataTable({
            "ordering": false
        });
        $(".del").on("click", function (e) {
            $("#deleteRecord").attr('href', 'services.php?delete=' + $(this).attr('data-id'));
            // console.log($(this).attr('data-id'));
        })
        $(".edit").on("click", function (e) {
            $("#user_id").val($(this).data('id'));
            $("#service_type").val($(this).attr('data-serviceType'));
            $("#fee").val($(this).attr('data-fee'));
        })
    </script>