<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <header>
    <div class="logo">
      <h1>Online Art Gallery</h1>
    </div>
    <nav>
      <ul>
        <?php
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
        }

        if (isset($_SESSION['loggedIn'])) {
          $username = $_SESSION['username'];
          $userURL = "$username";
           
          echo '<li><a href="index.php">Home</a></li>';
          echo '<li><a href="artist.php">Artist</a></li>';
            
          echo '<li><a href="artwork.php">Artwork</a></li>';
          echo '<li><a href="' . $userURL . '">' . $username . '</a></li>';
          echo '<li><a href="cart.php">My Cart</a></li>';

          echo '<li><a href="partials/logout.php">Log Out</a></li>';
        } else {
          echo '<li><a href="about.php">About Us</a></li>';
          echo '<li><a href="artist.php">Artist</a></li>';
          echo '<li><a href="artwork.php">Artwork</a></li>';
          echo '<li><a href="signupForm.php">Sign Up</a></li>';
          echo '<li><a href="login.php" class="login">Log In</a></li>';
        }
        ?>


      </ul>
    </nav>
  </header>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
