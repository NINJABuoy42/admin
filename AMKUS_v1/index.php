<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location:login.php');
    die;
}
$user = $_SESSION['status'];
$role = $_SESSION['role'];
if ($user == 'verified') {
    switch ($role) {
        case 'doctor':
            header('location:doctorDashboard.php');
            break;
        case 'register':
            header('location:registerDashboard.php');
            break;
        case 'admin':
            header('location:admin.php');
            break;
    }
} else {
    header('location:unknown.html');
}
?>
