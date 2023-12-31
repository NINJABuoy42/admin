<?php
session_start();
if (isset($_SESSION['status'])) {
    header('location:index.php');
}
$title = 'Login';
include('../includes/header.php');
include('../db_conn/user.php');

if (isset($_POST['login'])) {
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    // echo "<script>alert('hello');</script>";/
    $result = login($userName, $password);
    
    $msg = '<div class="alert alert-danger" role="alert">'. $result .'</div>';

    // echo $result;
}
?>

<body class="bg-gradient-success" >
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row ">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body px-5">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-md-6 p-5 d-flex justify-content-center align-items-center">
                            <img src="../img/amkus.png" style="width:300px;" alt="">
                        </div>
                        <div class="col-md-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    <?php if (isset($result)) {
                                            echo $msg;
                                        } ?>

                                </div>
                                <form class="user" method="POST">
                                    <div class="form-group">
                                        <input autocomplete="off" type="text" class="form-control form-control-user" id="userName"
                                            name="userName" aria-describedby="email" placeholder="Enter Username..."
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <input autocomplete="off" type="password" class="form-control form-control-user" id="password"
                                            name="password" placeholder="Password" required>
                                    </div>


                                    <button name="login" type="submit" class="btn btn-success btn-user btn-block">
                                        Login
                                    </button>
                                    <hr>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="register.php">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>