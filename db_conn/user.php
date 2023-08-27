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
        return 'Username already exists';
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
// *****************************************************

// ***********************************************
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
    header("LOCATION:../admin/user.php");
}
function deleteDoc($del)
{
    $query = "DELETE FROM doctors WHERE user_id ='$del'";
    mysqli_query($GLOBALS['conn'], $query);
    header("location:../admin/docList.php");
}
function updateUser($user_id, $status, $role)
{
    $query = "UPDATE users SET status='$status',role='$role' WHERE user_id=$user_id";
    mysqli_query($GLOBALS['conn'], $query);
    header("LOCATION:user.php");
}
// function viewPatientDetail($patienId)
// {
//     $sql = "SELECT * FROM patient_details WHERE patienId='$patienId'";
//     $result = mysqli_query($GLOBALS['conn'], $sql);
//     return $result;
// }
// function viewPatientHistory($patienId)
// {
//     $sql = "SELECT * FROM prescription WHERE patient_id='$patienId' ORDER BY visit_date DESC";
//     $result = mysqli_query($GLOBALS['conn'], $sql);
//     return $result;
// }
// function getPrescription($prescription_id)
// {
//     $sql = "SELECT * FROM prescription WHERE prescription_id='$prescription_id'";
//     $result = mysqli_query($GLOBALS['conn'], $sql);
//     return $result;
// }

// function getDoctors()
// {
//     $query = "SELECT * FROM doctors";
//     $doc = mysqli_query($GLOBALS['conn'], $query) or die("SQL query failed");
//     return $doc;
// }
function addDoc($docId){
    $sql = "SELECT * FROM doctors WHERE  user_id='$docId'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if (mysqli_num_rows($result) == 0) {
        $query = "SELECT * FROM users where user_id='{$docId}'";
        $docP = mysqli_query($GLOBALS['conn'], $query) or die("SQL query failed");
        while ($rowP = $docP->fetch_assoc()) {
            $pName = $rowP['fullName'];  
        }
        $sql = "INSERT INTO `doctors`(`user_id`, `Name`) VALUES ('{$docId}','{$pName}')";
        mysqli_query($GLOBALS['conn'], $sql) or die("SQL query failed");
        header('location:../admin/docList.php');
    } else {
        header('location:../admin/docList.php');
    }
}

function fetchDocs(){
    $query = "SELECT * FROM doctors";
    $docP = mysqli_query($GLOBALS['conn'], $query) or die("SQL query failed");
    return $docP;
}

function updateDoc($docID,$docName,$docReg,$docQual,$docCurr,$docMail){
    $sql="UPDATE `doctors` SET `Name`='$docName',`regNo`='$docReg',`qualifications`='$docQual',`email`='$docMail',`current`='$docCurr' WHERE user_id='$docID'";
    $docP = mysqli_query($GLOBALS['conn'], $sql) or die("SQL query failed");
    header('location:../admin/docList.php');
}
function getDoctors(){
    $query = "SELECT * FROM users WHERE role='doctor'";
    $docP = mysqli_query($GLOBALS['conn'], $query) or die("SQL query failed");
    return $docP;
}
?>