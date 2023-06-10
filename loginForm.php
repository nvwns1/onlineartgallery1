<?php include "header.php"; ?>


<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <?php if (isset($error)) { ?>
    <div class="error"><?php echo $error; ?></div>
  <?php } ?>
  <form method="post" action="login_check.php" id="loginForm">
    <label>Username:</label>
    <input type="text" name="username" id="name1">
    <br>
    <label>Password:</label>
    <input type="text" name="password" id="pass">
    <br>
    <input type="submit" value="Login" name="submit">
  </form>
  

<script>
  // const form = document.getElementById('loginForm');
  // form.addEventListener('submit', (event) => {
  //   event.preventDefault(); // prevent the form from submitting

  //   // perform your validation here
  //   if (!isvalid()) {
  //     // if validation fails, display an error message to the user
  //     // alert('Please correct the form errors.');
  //     return;
  //   }

  //   // if validation succeeds, submit the form to the server
  //   form.submit();
  // });

 /* function isvalid(){
      var username = document.getElementById('name1').value;
      var password = document.getElementById('pass').value;

      if(username.length==""&& password.length==""){
        alert("username and password is empty")
        return false
      }else{
        if(username.length== ""){
          alert("username is empty")
          return false;
        }else if{
          if(password.length==""){
            alert("password is empty")
            return false
          }
        }
      }
    }*/
</script>

</body>
</html>


<?php include "footer.php"; ?>



