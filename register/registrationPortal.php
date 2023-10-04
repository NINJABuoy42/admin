<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location:../public/login.php');
    die;
}

if ($_SESSION['role']!='register') {
    header('location:../public/index.php');
    die;
}

$user = $_SESSION['user'];
$title = 'Registration';
$portal="Patient Registration";
include('../includes/header.php');
include('../db_conn/user.php');
$portal="Registration Dashboard";
?>


<body id="page-top">
    <div id="wrapper" >
        <?php include('../includes/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('../includes/nav.php') ?>
                <div class="container-fluid">
                <section class="section ">
      <div class="card ">
        <div class="card-body ">
          <!-- Multi Columns Form -->
          <form class="row g-3 form-group" action="../db_conn/api/insertPatientRecord.php" method="POST">
          <button type="submit" disabled style="display: none" aria-hidden="true"></button>

            <h5 class="card-title col-md-12">Patient's Details</h5>
            <div class="col-md-4">
              <label for="fullName" class="form-label">Full Name</label>
              <input autocomplete="off" type="text" class="form-control" id="fullName" name="fullName" required>
            </div>
            <!-- ********** -->
            <div class="col-md-2">
              <label for="age" class="form-label">Age</label>
              <input autocomplete="off" type="number" class="form-control" id="age" name="age" required>
            </div>
            <div class="col-md-2">
              <label for="gender" class="form-label">Gender</label>
              <select id="gender" class="form-control" name="gender">
                <option selected>SELECT</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>
            </div>

            <div class="col-md-4">
              <label for="phoneNumber" class="form-label">Phone no. <span>(without +91)</span></label>
              <input autocomplete="off" type="number" class="form-control" id="phoneNumber" name="phoneNumber"  required>
            </div>
            <div class="col-md-4">
              <label for="maritialStatus" class="form-label">Maritial Status</label>
              <select id="maritialStatus" class="form-control" name="maritialStatus">
                <option selected>Choose...</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Other">Other</option>
              </select>
            </div>


            <hr />
            <h5 class="card-title col-md-12 mt-3">Patient's Communication Information</h5>

            <div class="col-md-4">
              <label for="state" class="form-label">State</label>
              <input autocomplete="off" type="text" class="form-control" id="state" name="state" >
            </div>
            <div class="col-md-4">
              <label for="district" class="form-label">District</label>
              <input autocomplete="off" type="text" class="form-control" id="district" name="district" >
            </div>
            <div class="col-md-4">
              <label for="pinCode" class="form-label">Pincode</label>
              <input autocomplete="off" type="number" class="form-control" id="pinCode" name="pinCode" maxlength="6" >
            </div>
            <div class="col-12">
              <label for="address" class="form-label">Address/ Village/ Locality</label>
              <input autocomplete="off" type="text" class="form-control" id="address" name="address">
            </div>
            <hr>
            <h5 class="card-title col-md-12 mt-5">Emergengy Contact and Communication Information </h5>
            <div class="col-md-4">
              <label for="emName" class="form-label"> Name</label>
              <input autocomplete="off" type="text" class="form-control" id="emName" name="emName" >
            </div>
            <div class="col-md-4">
              <label for="emRelation" class="form-label"> Relation</label>
              <input autocomplete="off" type="text" class="form-control" id="emRelation" name="emRelation" >
            </div>
            <div class="col-md-4">
              <label for="emNumber" class="form-label"> Phone no. <span>(without +91)</span></label>
              <input autocomplete="off" type="number" class="form-control" id="emNumber" name="emNumber">
            </div>
            <hr />
              <div class="text-center mt-3 col-md-12">
              <!-- <button type="button" class="btn btn-warning" name="getpatienId" id="getpatienId">Generate ID</button> -->
              <button type="submit" class="btn btn-success" name="proceed" id="proceed">Proceed</button>
              <button type="reset" class="btn btn-secondary" id="reset">Reset</button>
            </div>
          </form><!-- End Multi Columns Form -->

        </div>
      </div>
    </section>

<?php
                    include('../includes/footer.php'); ?>
                </div>
            </div>