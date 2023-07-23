<?php
include 'header.php';
include 'partials/db.php';


$artworkId = $_GET['id'];

$userId = '';
if (isset($_SESSION['id'])) {
  $userId = $_SESSION['id'];
}

function addToCart($conn, $userId, $artworkId, $quantity, $refresh)
{
  $sql = "SELECT * FROM `cart` WHERE user_id = '$userId' AND artwork_id = '$artworkId' ";
  $check_cart_num = mysqli_query($conn, $sql) or die('query failed!');

  if ($refresh) {
    header("Refresh:2");
  }

  if (mysqli_num_rows($check_cart_num) > 0) {
    echo "<script>
      Swal.fire({
        title: 'Artwork already added',
        text: 'The artwork is already in your cart.',
        icon: 'warning',
        confirmButtonText: 'OK'
      });
    </script>";
  } else {
    $sql = "INSERT INTO `cart`(user_id, artwork_id, quantity) VALUES ('$userId', '$artworkId' ,'$quantity')";
    mysqli_query($conn, $sql);

    echo "<script>
      Swal.fire({
        title: 'Artwork added to cart',
        text: 'The Artwork has been successfully added to your cart.',
        icon: 'success',
        confirmButtonText: 'OK'
      });
    </script>";
  }
}



if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $userCheck = "SELECT * from users WHERE `username` = '$username'";
  $resultOfUserCheck = mysqli_query($conn, $userCheck);
  $numOfUser = mysqli_num_rows($resultOfUserCheck);

  if ($numOfUser == 1) {
    while ($row = mysqli_fetch_assoc($resultOfUserCheck)) {
      if (password_verify($password, $row['password'])) {
        $login = true;
        $_SESSION['loggedIn'] = true;

        $_SESSION['id'] = $row["id"];
        $userId = $row["id"];

        $_SESSION['fname'] = $row["fname"];
        $_SESSION['lname'] = $row["lname"];

        $_SESSION['username'] = $row["username"];
        $_SESSION['email'] = $row["email"];
        $_SESSION['status'] = $row["status"];
        $_SESSION['pp'] = $row['pp'];

        $quantity = $_SESSION['Q'];
        if ($_SESSION['artist'] != $_SESSION['username']) {
          addToCart($conn, $userId, $artworkId, $quantity, true);
          unset($_SESSION['q']);
        } else {
          header("Refresh:2");
          echo "<script>
          Swal.fire({
            title: 'Artwork cannot be added',
            text: 'The artwork belongs to you.',
            icon: 'warning',
            confirmButtonText: 'OK',
          });
    </script>";
          unset($_SESSION['q']);
          unset($_SESSION['artist']);

        }
      }
    }
  }
}


$q = "Select users.id, users.fname, users.lname,users.username, artworks.title, artworks.description,
 artworks.image_path , artworks.price, artworks.units_available
from artworks INNER JOIN users on users.id = artworks.artist_id 
WHERE artworks.artwork_id = $artworkId;
";

$result = mysqli_query($conn, $q);
$row = mysqli_fetch_assoc($result);

$artist_username = $row['username'];
$_SESSION['artist'] = $artist_username;


if (isset($_POST['add_to_cart'])) {
  $artworkId = $_POST['artworkId'];
  $quantity = $_POST['quantity'];
  $_SESSION['Q'] = $quantity;
  if (empty($userId)) {

    echo '
    <script>
    document.addEventListener("DOMContentLoaded", function(){
      document.getElementById("login-form-container").style.display = "block";

      let closeLoginForm = document.getElementById("close-login-form");
      closeLoginForm.addEventListener("click", function(){
        document.getElementById("login-form-container").style.display = "none";
      });
    });
    </script>';
  } else {
    addToCart($conn, $userId, $artworkId, $quantity, false);
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Artwork</title>
  <style>
    footer {
      position: fixed;
      bottom: 0px;
    }

    .small {
      margin-bottom: 20px;
      width: 20%;
      padding: 10px;
      border-radius: 3px;
      font-size: 16px;
    }

    #login-form-container {
      display: none;
      position: fixed;
      width: 50%;
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
      <h2>
        <?php echo $row['title'] ?>
      </h2>
      <p>
        <?php echo $row['description'] ?>
      </p>
      <h3>Desined by:
        <?php echo $row['fname'] . ' ' . $row['lname'] ?>
      </h3>
      <h4>Price [in Rs]:
        <?php echo $row['price'] ?>
      </h4>
      <br>
      <br>
      <?php if (
        isset($_SESSION['loggedIn']) && isset($row['username']) && $_SESSION['username'] == $row['username']
      ) {
      ?>
        <h5>This is yours design.</h5>
      <?php } else { 
        if($row['units_available']==0){
          echo '<div class="sold"><p>Completely Sold</p></div>';
          
        }else{
        ?>
        <form action="" method="post">
          <label for="quantity">Quantity (between 1 and
            <?php echo $row['units_available']; ?>):
          </label>
          <div class="small">
            <input type="hidden" name="artworkId" value="<?php echo $artworkId ?>">
            <input type="hidden" name="userId" value="<?php echo $userId ?>">


            <input type="number" value='1' id="quantity" name="quantity" min="1" max="<?php echo $row['units_available']; ?>" style="width: 80px;">
            <input type="submit" value="Add to Cart" name="add_to_cart" class="btnn" id="add-to-cart-button">
          </div>
        </form>

        <div id="login-form-container">
          <h3>Please Login to proceed</h3>
          <span id="close-login-form">&times;</span>
          <form id="login-form" action="" method="POST">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" value='Login' name='login'>
          </form>
          <div style="display: flex; align-items: center; justify-content: center;">
            <p>
              Don't have an account? <a style="text-decoration: none; color:#0095F6" href="signupForm.php"><b>Sign
                  up</b></a>
            </p>
          </div>
        </div>
      <?php }} ?>

    </div>
    <div class="about-image">
      <img src="<?php echo $row['image_path'] ?>" height='600px' alt="about">
    </div>
  </section>



</body>

</html>
<?php include "footer.php"; ?>