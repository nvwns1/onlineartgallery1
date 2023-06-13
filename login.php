<?php
session_start();
$empty = false;
$login = true;

if (isset($_SESSION['loggedIn'])) {
  header("location: index.php");
  exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include './partials/db.php';
  $username = $_POST["username"];
  $password = $_POST["password"];
  $userCheck = "SELECT * from users WHERE `username` = '$username'";
  $resultOfUserCheck = mysqli_query($conn, $userCheck);
  $numOfUser = mysqli_num_rows($resultOfUserCheck);

  if ($username == "" || $password == "") {
    $empty = true;
  } else if ($numOfUser == 1) {
    while ($row = mysqli_fetch_assoc($resultOfUserCheck)) {

      if (password_verify($password, $row['password'])) {
        $login = true;
        $_SESSION['loggedIn'] = true;

        $_SESSION['id'] = $row["id"];
        $_SESSION['fname'] = $row["fname"];
        $_SESSION['lname'] = $row["lname"];

        $_SESSION['username'] = $row["username"];
        $_SESSION['email'] = $row["email"];
        $_SESSION['status'] = $row["status"];
        $_SESSION['pp'] = $row['pp'];

        if ($username == "admin") {
          header("location: allArtist.php");
          exit();
        } else {
          header("location: index.php");
        }
      } else {
        $login = false;
      }
    }
  } else {
    $login = false;
  }
}
include "header.php";

?>
<head>
  <style>
    footer{
      position: fixed;
      bottom: 0px;
    }
  </style>
</head>
<body>


  <?php if ($empty) {
    echo "<div></div>";
  } ?>
  <?php if (!$login) {
    echo "<div>Username and Password doesnot match.</div>";
  }
  ?>
  <div class= "menu">
  <form method="post" action="#" id="loginForm">
    <label>Username:</label>
    <input type="text" name="username" id="name1" required>
    <br>
    <label>Password:</label>
    <input type="password" name="password" id="pass" required>
    <br>
    <input type="submit" value="Login" name="submit">
  </form>
<?php include "footer.php"; ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>
</body>


</html>