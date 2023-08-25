<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="../public/index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Interface
    </div>
    <!-- Nav Item - Pages Collapse Menu -->

    <?php
    $role = $_SESSION['role'];
    switch ($role) {
        case 'admin':
    ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="../admin/user.php" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-id-card-alt" style="font-size: 20px;"></i>
                    <span style="font-size: 15px;">Users</span>
                </a>
                <a class="nav-link collapsed" href="../admin/docList.php" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-user-md" style="font-size: 20px;"></i>
                    <span style="font-size: 15px;">Doctors List</span>
                </a>
                <a class="nav-link collapsed" href="../public/patientDetails.php" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-search" style="font-size: 20px;"></i>
                    <span style="font-size: 15px;">Search</span>
                </a>
            </li>
        <?php
            break;
        case 'doctor':
        ?>
            <li class="nav-item">

                <a class="nav-link collapsed" href="../doctor/patientWaitingList.php" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users" style="font-size: 20px;"></i>
                    <span style="font-size: 15px;">Patient List</span>
                </a>
                <a class="nav-link collapsed" href="../public/patientDetails.php" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-search" style="font-size: 20px;"></i>
                    <span style="font-size: 15px;">Search</span>
                </a>
                <a class="nav-link collapsed" href="../public/patientList.php" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-file-prescription" style="font-size: 20px;"></i>
                    <span style="font-size: 15px;">Prescription</span>
                </a>
            </li>
        <?php
            break;
        case 'register':
        ?>
            <li class="nav-item">

                <a class="nav-link collapsed" href="registrationPortal.php" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-user-edit" style="font-size: 20px;"></i>
                    <span style="font-size: 15px;">Register</span>
                </a>
                <a class="nav-link collapsed" href="patientDetails.php" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-search" style="font-size: 20px;"></i>
                    <span style="font-size: 15px;">Search</span>
                </a>
                <a class="nav-link collapsed" href="patientList.php" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-file-prescription" style="font-size: 20px;"></i>
                    <span style="font-size: 15px;">Prescription</span>
                </a>
            </li>
    <?php
            break;
    }
    ?>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>