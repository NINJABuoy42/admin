<?php include('../db_conn/apiStatus.php'); ?>
<div class="row mb-2">
<!-- Earnings (Monthly) Card Example -->
<?php if($_SESSION['role']=='admin'){
    ?>

<div class="col-sm-3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Users</div>
                        <div class="h6 mb-0 font-weight-bold text-gray-800"><?php echo $user = getUsers(); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-id-card-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-sm-3">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Doctors</div>
                    <div class="h6 mb-0 font-weight-bold text-gray-800"><?php echo $docCount = getDocCount(); ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-user-md fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
} ?>
<?php if($_SESSION['role']=='doctor'){
    ?>

<div class="col-sm-3">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Waiting Patients</div>
                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                    <?php if($_SESSION['role']=='doctor'){
                            echo $prescriptionCount =  getWaitingPatient($_SESSION['user_id']);
                    } 
                     ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
} ?>

<!-- Pending Requests Card Example -->
<div class="col-sm-3">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Prescribed </div>
                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php if($_SESSION['role']=='doctor'){
                           echo $prescriptionCount = getDocPatient($_SESSION['user_id']);
                    }
                    else{
                        echo $prescriptionCount = getPrescribedPatient();
                    }  
                     ?>
                     </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-file-prescription fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Content Row -->