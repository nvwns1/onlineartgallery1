<?php 
session_start();
if(isset($_SESSION['loggedIn'])){
  header("locatioin:./index.php");
  exit();
}

$exist= false;
$didMatch = false;
$empty = false;

 include "header.php"; 
 
include "partials/db.php";
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $status = 'active';

  $usernameCheck = "SELECT * FROM `users` WHERE `username`='$username'";
  $resOfCheck = mysqli_query($conn, $usernameCheck);
  $numOfUserName = mysqli_num_rows($resOfCheck);
  if($numOfUserName >0){
    $exist = true;
  }else{
    if ($fname==""||$lname=""||$username==""||$password==""||$email=""){
      $empty = true;
    }else if(($password != "") && ($exist == false)) {
      $passwordHash = password_hash($password, PASSWORD_DEFAULT);

      $q= "INSERT INTO `users`(`fname`, `lname`, `username`,
      `email`, `password`, `status`) 
      VALUES ('$fname','$lname','$username',
      '$email','$passwordHash','$status')";
      $result1 = mysqli_query($conn, $q);

      // $serializedArray = serialize(array());
      // $sql = "INSERT INTO `userfollowfollowing` (`username`, `follow`, `following`) VALUES ('$username', '$serializedArray', '$serializedArray')";
      // $result2 = mysqli_query($con, $sql);
      if ($result1 || $result2) {
        header("location:./dashboard.php");
      }
  }}
}
  
?>

  <!-- // $result = mysqli_query($conn, $q);
  // sleep(1);
  // echo "success";
//   if(mysqli_query($conn,$q)){
//     header("Location: dashboard.php");
//     exit();
//   }else{
//     $error = "Error: " .mysqli_error($conn);
//   }
  
 
//  } -->



<!DOCTYPE html>
<html>
<head>
  <title>Signup</title>
</head>
<body>
  <?php if (isset($error)) { ?>
    <div class="error"><?php echo $error; ?></div>
  <?php } ?>
  <form method="post">
   <h2> Sign Up</h2>
    <br>
  <label>First Name:</label>
    <input type="text" name="fname">
    <br>
    <label>Last Name:</label>
    <input type="text" name="lname">
    <br>
    <label>Username:</label>
    <input type="text" name="username">
    <br>
    <label>Email:</label>
    <input type="text" name="email">
    <br>
    <label>Password:</label>
    <input type="text" name="password">
    <br>
    <input type="submit" value="Sign Up">
  </form>
</body>
</html>
