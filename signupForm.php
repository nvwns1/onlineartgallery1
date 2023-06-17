<?php 
  include "header.php"; 

  if(isset($_SESSION['loggedIn'])){
    header("location: index.php");
    exit();
  }

  $exist = false;
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

    if($numOfUserName > 0){
      $exist = true;
    } else {
      if ($fname=="" || $lname=="" || $username=="" || $password=="" || $email==""){
        $empty = true;
      } else if (($password != "") && ($exist == false)) {
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
          $_SESSION['status']= $status;
          header("location: index.php");
          exit();
        }
      }else{
        $error = "An error occured. Please try again later.";
      }
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Signup</title>
  <style>
    footer{
      position: fixed;
      bottom: 0px;
    }
  </style>
</head>
<body>
  <?php if (isset($error)) { ?>
    <div  id="error"><?php echo $error; ?></div>
  <?php } ?>
  <form id="signupForm" method="post">
    <h2> Sign Up</h2>
    <br>
    <label>First Name:</label>
    <input type="text" name="fname" required>
    <br>
    <label>Last Name:</label>
    <input type="text" name="lname" required>
    <br>
    <label>Username:</label>
    <input type="text" name="username" required>
    <br>
    <label>Email:</label>
    <input type="email" name="email" required>
    <br>
    <label>Password:</label>
    <input type="password" name="password" required>
    <br>
    <input type="submit" value="Sign Up">
  </form>

  <?php include "footer.php"; ?>

  <script>
  const signupForm = document.getElementById('signupForm');

signupForm.addEventListener('submit', function(event) {
  const firstNameInput = signupForm.elements.fname;
  const lastNameInput = signupForm.elements.lname;
  const usernameInput = signupForm.elements.username;
  const error = document.getElementById('error');


  if (!isValidName(firstNameInput.value)) {
    event.preventDefault();
   alert('Invalid first name. First name must contain only characters.');
    firstNameInput.focus();
  }

  if (!isValidName(lastNameInput.value)) {
    event.preventDefault();
    alert('Invalid Last name. Last name must contain only characters.');
    lastNameInput.focus();
  }

  if (!isValidUsername(usernameInput.value)) {
    event.preventDefault();
    alert('Invalid Username. Username must start with characters.');
    usernameInput.focus();
  }
});

function isValidName(name) {
  return /^[a-zA-Z]+$/.test(name);
}

function isValidUsername(username) {
  return /^[a-zA-Z][a-zA-Z0-9_]*$/.test(username);
}
</script>
</body>
</html>
