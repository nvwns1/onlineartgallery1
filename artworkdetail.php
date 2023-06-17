<?php
include 'header.php';
include 'partials/db.php';


$artworkId = $_GET['id'];


$q= "Select users.fname, users.lname,users.username, artworks.title, artworks.description,
 artworks.image_path , artworks.price, artworks.units_available
from artworks inner join users on users.id = artworks.artist_id 
WHERE artworks.artwork_id = $artworkId;
";

$result = mysqli_query($conn, $q);
$row = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artwork</title>
    <style>
      footer{
        position: fixed;
        bottom: 0px;
      }
      .small{
        /* display: block; */
    margin-bottom: 20px;
    width: 20%;
    padding: 10px;
    border-radius: 3px;
    font-size: 16px;
    /* box-sizing: border-box; */
      }

      #login-form-container {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 20px;
    background-color: #f5f5f5;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    z-index: 9999;
  }

  #close-login-form {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    cursor: pointer;
  }
    </style>
</head>
<body>
<section class="hero">
        <div class="hero-text">
          <h2><?php echo $row['title'] ?></h2>
          <p><?php echo $row['description'] ?></p>

          <h3>Desined by: <?php echo $row['fname'] .' ' . $row['lname'] ?></h3>
          <h4>Price [in Rs]: <?php echo $row['price'] ?></h4>

          <br>
          <br>
          <?php if (isset($_SESSION['loggedIn']) && isset($row['username']) && $_SESSION['username'] == $row['username']) { ?>

<h5>This is yours design.</h5>

  
<?php } else { ?>
  <label for="quantity">Quantity (between 1 and <?php echo $row['units_available']; ?>):</label>
  <div class="small">
    <input type="number" id="quantity" name="quantity" min="1" max="<?php echo $row['units_available']; ?>">
  </div>
  <button id="add-to-cart-button">Add to Cart</button>

  <div id="login-form-container" action="login.php">
    <span id="close-login-form">&times;</span>
    <form id="login-form" action="login.php" method="POST">
      <input type="text" name="username" placeholder="Username">
      <input type="password" name="password" placeholder="Password">
      <button type="submit">Login</button>
    </form>
    </div>


<?php }  ?>

        


        </div>
        <div class="about-image">
          <img src="<?php echo $row['image_path'] ?>" height='600px' alt="about">
        </div>




      </section>
      

      <script>

        var loggedIn = <?php isset($_SESSION['loggedIn']) ? 'true' : 'false' ?>
  document.addEventListener("DOMContentLoaded", function () {
    var addToCartButton = document.getElementById("add-to-cart-button");
    var loginFormContainer = document.getElementById("login-form-container");
    var closeLoginForm = document.getElementById("close-login-form");

    addToCartButton.addEventListener("click", function () {
      // Check if the user is logged in
      if (!loggedIn) {
        // Display the login form container as a pop-up
        loginFormContainer.style.display = "block";
      } else {
        // User is logged in, add to cart functionality
        // Implement your logic here
        loginFormContainer.style.display = "none";

      }
    });

    closeLoginForm.addEventListener("click", function () {
      // Close the login form container
      loginFormContainer.style.display = "none";
    });
  });
</script>
</body>
</html>
<?php include "footer.php"; ?>
