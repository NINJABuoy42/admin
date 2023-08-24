<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location:login.php');
    die;
}

$user = $_SESSION['status'];
$role = $_SESSION['role'];
$title = 'Dashboard';
if ($user == 'verified') {
    switch ($role) {
        case 'doctor':
            header('location:doctorPortal.php');
            break;
        case 'register':
            header('location:registrationPortal.php');
            break;
    }
} else {
    header('location:unknown.html');
}

include('./includes/header.php');
include('./db_conn/user.php');
// $data= mysqli_fetch_assoc(getUsers());

?>
<?php include('./includes/sidebar.php'); ?>
<?php include('./includes/nav.php') ?>
<?php echo $role; ?>

<script>
    console.log("<?php echo $role; ?>");
</script>;
<?php include('./includes/footer.php'); ?>