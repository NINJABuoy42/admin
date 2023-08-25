<?php
require('../db_conn/dbConn.php');

// function to register user in the database
function register($fullName, $userName, $password)
{
    $pass = password_hash($password, PASSWORD_BCRYPT);
    $sql = "SELECT * FROM users WHERE userName='$userName'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO users (fullName,userName,password,status) VALUES('$fullName','$userName','$pass','uverified')";
        if (mysqli_query($GLOBALS['conn'], $query)) {
            header('location:login.php');
        }
        // die;
    } else {
        return 'Email already exists';
    }

    // print_r('Data inserted successfully');
}
// function to verify and log user
function login($userName, $password)
{
    $sql = "SELECT user_id,userName,password,fullName,role,status FROM users where userName='$userName'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hash = $row['password'];
        if (password_verify($password, $hash)) {
            session_start();
            $_SESSION["status"] = $row['status'];
            $_SESSION["user_id"] = $row['user_id'];
            $_SESSION["user"] = $row['fullName'];
            $_SESSION["userName"] = $row['userName'];
            $_SESSION["role"] = $row['role'];
            header('location:../public/index.php');
        } else {
            return "password incorrect";
        }
    } else {
        return "invalid user";
    }
}

// function to get users
function getUser()
{
    $sql = "SELECT user_id,fullName,userName,status,role,reg_date FROM users";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    return $result;
}
function getPatientDetail()
{
    $sql = "SELECT patienId,fullName,age,phoneNumber,regDate FROM patient_details";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    return $result;
}
function getUsers()
{
    $sql = "SELECT count(*) FROM users";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    return $result;
}
function getPatients()
{
    $sql = "SELECT count(*) FROM patient_details";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    return $result;
}
function getPrescribedPatient()
{
    $sql = "SELECT count(*) FROM prescription WHERE status='prescribed'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    return $result;
}

function delete($del)
{
    $query = "DELETE FROM patient_details WHERE patienId ='$del'";
    mysqli_query($GLOBALS['conn'], $query);
    header("LOCATION:patientDetails.php");
}
function deleteUser($del)
{
    $query = "DELETE FROM users WHERE userName ='$del'";
    mysqli_query($GLOBALS['conn'], $query);
    header("LOCATION:user.php");
}
function updateUser($user_id, $status, $role)
{
    $query = "UPDATE users SET status='$status',role='$role' WHERE user_id=$user_id";
    mysqli_query($GLOBALS['conn'], $query);
    header("LOCATION:user.php");
}
function viewPatientDetail($patienId)
{
    $sql = "SELECT * FROM patient_details WHERE patienId='$patienId'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    return $result;
}
function viewPatientHistory($patienId)
{
    $sql = "SELECT * FROM prescription WHERE patient_id='$patienId' ORDER BY visit_date DESC";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    return $result;
}
function getPrescription($prescription_id)
{
    $sql = "SELECT * FROM prescription WHERE prescription_id='$prescription_id'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    return $result;
}

function getDoctors()
{
    $query = "SELECT user_id,fullName FROM users where role='doctor'";
    $result = mysqli_query($GLOBALS['conn'], $query) or die("SQL query failed");
    return $result;
}
// function patientCheckIn($referredBy, $pTemp, $pBP, $pWeight, $pHeight, $pId, $attendingDoc)
// {
//     $query = "SELECT COUNT(*) FROM prescription";
//     $queryP ="SELECT fullName,age,gender,phoneNumber,address FROM patient_details";
//     $result = mysqli_query($GLOBALS['conn'], $query) or die("SQL query failed");
//     while ($row = $result->fetch_assoc()) {
//         $newId = $row['COUNT(*)'] + 1;
//         $newPID = "PSC-" . date("Y") . "/" . $newId;
//     }
//     $queryP ="SELECT fullName,age,gender,phoneNumber,address FROM patient_details";
//     $resultP = mysqli_query($GLOBALS['conn'], $queryP) or die("SQL query failed");
//     while ($rowP = $resultP->fetch_assoc()) {
//         $pName = $rowP['fullName'];
//         $pAge = $rowP['age'];
//         $pGender = $rowP['gender'];
//         $phone = $rowP['phoneNumber'];
//         $pAddress = $rowP['address'];
        
//     }
//     $sql = "INSERT INTO `prescription`(`prescription_id`, `patient_id`,`name`, `age`, `gender`, `phone`, `address`, `attending_doctor`, `referred_by`, `height`, `weight`, `blood_pressure`, `temperature`, `status`) VALUES ('{$newPID}','{$pId}','{$pName}','{$pAge}','{$pGender}','{$phone}','{$pAddress}','{$attendingDoc}','{$referredBy}','{$pHeight}','{$pWeight}','{$pBP}','{$pTemp}','checked_in')";
//     if (mysqli_query($GLOBALS['conn'], $sql)) {
//         header("LOCATION:viewDetails.php?patienId={$pId}");
//     }
// }
?>