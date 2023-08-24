<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location:login.php');
    die;
}

if ($_SESSION['role']!='register') {
    header('location:index.php');
    die;
}

$user = $_SESSION['user'];
$title = 'Registration';
$portal="Patient Registration";
include('./includes/header.php');
include('./db_conn/user.php');
$data = mysqli_fetch_assoc(getUsers());
$portal="Registration Dashboard";
?>


<body id="page-top">
    <div id="wrapper" >
        <?php include('./includes/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('./includes/nav.php') ?>
                <div class="container-fluid">
                <section class="section ">
      <div class="card ">
        <div class="card-body ">
          <!-- Multi Columns Form -->
          <form class="row g-3 form-group" action="db_conn/api/insertPatientRecord.php" method="POST">
            <h5 class="card-title">Patient's Details</h5>
            <div class="col-md-12">
              <label for="fullName" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="fullName" name="fullName" required>
            </div>
            <!-- ********** -->
            <div class="col-md-4">
              <label for="dateOfBirth" class="form-label">Date of Birth</label>
              <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth">
            </div>
            <div class="col-md-4">
              <label for="age" class="form-label">Age</label>
              <input type="number" class="form-control" id="age" name="age" required>
            </div>

            <div class="col-md-4">
              <label for="phoneNumber" class="form-label">Phone no. <span>(without +91)</span></label>
              <input type="number" class="form-control" id="phoneNumber" name="phoneNumber" minlength="10" maxlength="10" required>
            </div>
            <div class="col-md-4">
              <label for="gender" class="form-label">Gender</label>
              <select id="gender" class="form-control" name="gender">
                <option selected>Choose...</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="bloodGroup" class="form-label">Blood Group</label>
              <select id="bloodGroup" class="form-control" name="bloodGroup">
                <option selected>Choose...</option>
                <option value="A+" >A positive (A+)</option>
                <option value="A-">A negative (A-)</option>
                <option value="B+">B positive (B+)</option>
                <option value="B-">B negative (B-)</option>
                <option value="O+">O positive (O+)</option>
                <option value="O-">O negative (O-)</option>
                <option value="AB+">AB positive (AB+)</option>
                <option value="AB-">AB negative (AB-)</option>
              </select>
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
              <input type="text" class="form-control" id="state" name="state" >
            </div>
            <div class="col-md-4">
              <label for="district" class="form-label">District</label>
              <input type="text" class="form-control" id="district" name="district" >
            </div>
            <div class="col-md-4">
              <label for="pinCode" class="form-label">Pincode</label>
              <input type="number" class="form-control" id="pinCode" name="pinCode" maxlength="6" >
            </div>
            <div class="col-12">
              <label for="address" class="form-label">Address/ Village/ Locality</label>
              <input type="text" class="form-control" id="address" name="address">
            </div>
            <div class="col-md-4">
              <label for="policeStation" class="form-label">Police Station</label>
              <input type="text" class="form-control" id="policeStation" name="policeStation" >
            </div>
            <div class="col-md-4">
              <label for="postOffice" class="form-label">Post Office</label>
              <input type="text" class="form-control" id="postOffice" name="postOffice" >
            </div>
            <div class="col-md-4">
              <label for="landMark" class="form-label">Landmark <span>(if any...)</span></label>
              <input type="text" class="form-control" id="landMark" name="landMark">
            </div>
            <hr />
    
            <div class="col-md-12">
              <label for="medicalHistory" class="form-label">Past Medical History <span>(if any...)</span></label>
              <input type="text" class="form-control" id="medicalHistory">
            </div>
            <!-- Emergengy contacts -->
            <hr>
            <h5 class="card-title col-md-12 mt-5">Emergengy Contact and Communication Information </h5>
            <div class="col-md-4">
              <label for="emName" class="form-label"> Name</label>
              <input type="text" class="form-control" id="emName" name="emName" >
            </div>
            <div class="col-md-4">
              <label for="emRelation" class="form-label"> Relation</label>
              <input type="text" class="form-control" id="emRelation" name="emRelation" >
            </div>
            <div class="col-md-4">
              <label for="emNumber" class="form-label"> Phone no. <span>(without +91)</span></label>
              <input type="number" class="form-control" id="emNumber" name="emNumber" minlength="10" maxlength="10" >
            </div>
            <hr />
            <!-- <div class="col-md-4">
              <label for="emstate" class="form-label">State</label>
              <input type="text" class="form-control" id="emstate" name="emstate" >
            </div>
            <div class="col-md-4">
              <label for="emDistrict" class="form-label">District</label>
              <input type="text" class="form-control" id="emDistrict" name="emDistrict" >
            </div>
            <div class="col-md-4">
              <label for="empinCode" class="form-label">Pincode</label>
              <input type="number" class="form-control" id="empinCode" maxlength="6" name="empinCode">
            </div>
            <div class="col-12">
              <label for="emAddress" class="form-label">Address/ Village/ Locality</label>
              <input type="text" class="form-control" id="emAddress" name="emAddress">
            </div>
            <div class="col-md-4">
              <label for="empoliceStation" class="form-label">Police Station</label>
              <input type="text" class="form-control" id="empoliceStation" name="empoliceStation">
            </div>
            <div class="col-md-4">
              <label for="empostOffice" class="form-label">Post Office</label>
              <input type="text" class="form-control" id="empostOffice" name="empostOffice">
            </div>
            <div class="col-md-4">
              <label for="emlandMark" class="form-label">Landmark <span>(if any...)</span></label>
              <input type="text" class="form-control" id="emlandMark" name="emlandMark">
            </div>
            <div class="form-check col-md-12">
              <input class="form-check-input" type="checkbox" id="addressCheck" name="addressCheck">
              <label class="form-check-label" for="addressCheck">
                Same as Patient's Address
              </label>
            </div>
            <hr class="sidebar-divider md-block">
            <div class=" form-check col-md-12">
              <label for="patientPhoto" class="form-label">Patient Photo</label>
              <input type="file" class="form-control-file" id="patientPhoto" name="patientPhoto" accept="image/*">
              <div class="card"  id="imgCard" style="display:none;">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <img src="" alt="Profile" class="rounded" width="250"  id="patientPic">
            </div> -->
          <!-- </div> -->
            <!-- </div> -->
            <!-- <div class="col-md-12 mt-5">
            <label for="patienId" class="form-label">Patient ID</label>
              <input type="text" class="form-control" id="patienId" name="patienId" placeholder="Click Generate ID to generate Patient ID..." readonly>
            </div> -->
              <hr>
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
                    include('./includes/footer.php'); ?>
                </div>
            </div>
            <script>
    let input = document.getElementById("patientPhoto");
    let currYear = new Date();
    $("#dateOfBirth").change(function() {
      let dobDate = new Date($("#dateOfBirth").val());
      let dobYear = parseInt(currYear.getFullYear()) - parseInt(dobDate.getFullYear());
      $("#age").val(dobYear);
    })
    $("#addressCheck").change(function() {
      if (this.checked) {
        $("#emstate").val($("#state").val());
        $("#eminputCity").val($("#inputCity").val());
        $("#empinCode").val($("#pinCode").val());
        $("#emDistrict").val($("#district").val());
        $("#emAddress").val($("#address").val());
        $("#empoliceStation").val($("#policeStation").val());
        $("#empostOffice").val($("#postOffice").val());
        $("#emlandMark").val($("#landMark").val());
      } else {
        $("#emstate").val("");
        $("#eminputCity").val("");
        $("#empinCode").val("");
        $("#emAddress").val("");
        $("#empoliceStation").val("");
        $("#empostOffice").val("");
        $("#emlandMark").val("");
      }
    })
  //   $("#getpatienId").on("click", function (e) {
  //   $.ajax({
  //     url:"db_conn/api/getPatientId.php",
  //     type:'POST',
  //     success: function(data){
  //      let newPid =data;
  //      $("#patienId").val(newPid);
  //      document.getElementById("proceed").disabled=false;
  //      document.getElementById("getpatienId").disabled=true;
       
  //     //  console.log(data);
  //       }
  //   })
  // });
  input.addEventListener("change",function(e){
    let image=document.getElementById("patientPic");
    if (this.files[0].type.indexOf("image/")  > -1) {
      image.src = window.URL.createObjectURL(input.files[0]);
      $("#imgCard").css('display',"block");
    }
    
  })
  </script>