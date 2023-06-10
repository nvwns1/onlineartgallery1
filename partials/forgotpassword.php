<?php
session_start();
if(isset($_SESSION['loggedIn'])){
    header("locatioin: ./index.php");
    exit();
}

$exist= false;
if($_SERVER["REQUEST_METHOD"]="POST"){
    include "db.php";
    $username= $_POST["username"];
    $securitycode= $_POST["securitycode"];
    $newpassword= $_POST["newpassword"];
    $renewpassword= $_POST["renewpassword"];

    $userNameCheck = "SELECT * from `users` WHERE `username`= '$usernaem'";
    $resultofUserNameCheck = mysqli_query($con, $userNameCheck);
    $numOfUserName = mysqli_num_rows($resultofUserNameCheck);
    if($numOfUserName == 1){
        $exist = true;
        $row = mysqli_fetch_assoc($resultOfUserNameCheck);
        if (($newpassword != "") && ($newpassword == $renewpassword) 
        && (password_verify($securitycode, $row['securitycode']))
         && ($exist == true)) {
        $newPasswordHash = password_hash($newpassword, PASSWORD_DEFAULT);
        $sql = "UPDATE `userdetails` SET `password` = '$newPasswordHash' WHERE `userdetails`.`username` = '$username'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            header("location:../login.php");
        }
    }
} else {
    $exist = false;
}
}
?>