<?php 
 include "header.php"; 

if(isset($_SESSION['loggedIn'])){
  header("location: index.php");
  exit();
}

$exist= false;
$didMatch = false;
$empty = false;

include "./partials/db.php";
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $username = $_POST['username'];

  $email = $_POST['email'];
  $password = $_POST['password'];
  $status = 'active';
  $pp = 'profile.png';

  $usernameCheck = "SELECT * FROM `users` WHERE `username`='$username'";
  $resOfCheck = mysqli_query($conn, $usernameCheck);
  $numOfUserName = mysqli_num_rows($resOfCheck);
  if($numOfUserName >0){
    $exist = true;
  }else{
    if ($fname==""||$lname==""||$username==""||$password==""||$email==""){
      $empty = true;
    }else if(($password != "") && ($exist == false)) {
      $passwordHash = password_hash($password, PASSWORD_DEFAULT);

      $q = "INSERT INTO `users`(`fname`, `lname`, `username`, `email`, `password`, `status`,`pp`)
       VALUES ('$fname', '$lname', '$username', '$email', '$passwordHash', '$status','$pp')";

      $result1 = mysqli_query($conn, $q);
      
      if ($result1 || $result2) {
        $_SESSION['loggedIn'] = true;

        $_SESSION['fname']=$fname;
        $_SESSION['lname']=$lname;

        $_SESSION['username']=$username;
        $_SESSION['email']=$email;
        $_SESSION['pp'] = $pp;
        header("location: index.php");
        exit();
      }
  }}
}
  
?>



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
    <input type="email" name="email">
    <br>
    <label>Password:</label>
    <input type="text" name="password">
    <br>
    <input type="submit" value="Sign Up">
  </form>
<?php include "footer.php"; ?>

</body>
</html>
