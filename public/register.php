<?php
$title = 'Register';
include('../includes/header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $userName = $_POST['userName'];
    $pass = $_POST['password'];
    $confirm_pass = $_POST['cPassword'];
    $err="";
    if (!empty(trim($fullName)) &&!empty(trim($userName)) && !empty(trim($pass)) && !empty(trim($confirm_pass))) {
        if ($pass != $confirm_pass) {
            $err =
            '<div class="alert alert-danger" role="alert">Password Mismatch!! Enter the same password</div>';
        } 
        else {
            include('../db_conn/user.php');
            $msg=register($fullName,$userName,$pass);
            $err= '<div class="alert alert-danger" role="alert">'.$msg.'</div>';
            
        }
    } 
}
?>

<body class="bg-gradient-success">

    <div class="container">
        <div class="row justify-content-center">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <!-- <div class = "col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                        <div class="col-lg-6 p-2 d-flex justify-content-center align-items-center">
                            <img src="../img/amkus1.png" style="width:300px;" alt="">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                    <?php if (isset($err)) {
                                        echo $err;
                                    } ?>
                                </div>
                                <form class="user" method="POST" action="register.php">
                                    <div class="form-group">
                                        <input autocomplete="off" type="text" class="form-control form-control-user" name="fullName"
                                            id="fullName" placeholder="Full Name" required>
                                    </div>
                                    <div class="form-group">
                                        <input autocomplete="off" type="text" class="form-control form-control-user" name="userName"
                                            id="userName" placeholder="Username" required>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input autocomplete="off" type="password" class="form-control form-control-user"
                                                name="password" id="password" placeholder="Password" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input autocomplete="off" type="password" class="form-control form-control-user"
                                                name="cPassword" id="cPassword" placeholder="Repeat Password" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-user btn-block">
                                        Register Account
                                    </button>
                                    <hr>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="login.php">Already have an account? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="../js/sb-admin-2.min.js"></script>
</body>

</html>