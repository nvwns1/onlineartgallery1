<?php
include "header.php";
if (!$_SESSION['loggedIn']) {
  header("location:login.php");
}

include("./partials/db.php");



$username = $_SESSION['username'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$email = $_SESSION['email'];
$status = $_SESSION['status'];


if($status=="suspend"){
  header("location: suspend.php");
  exit();
}
if (!isset($userid)) {
  $idQ = "SELECT id from users WHERE username='$username'";
  $result = mysqli_query($conn, $idQ);
  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $id = $row['id'];
      $_SESSION['id'] = $id;
    }
  }
}

?>
<title>Online Art Gallery</title>
<main>
  <section class="hero">
    <div class="hero-text">

      <h2>Welcome to Art Gallery</h2>

      <p>Discover the beauty of art and the power of expression in our online gallery.</p>
      <a href="user.php" class="btn">Explore Profile</a>
    </div>
    <div class="hero-image">
      <!-- <img src="https://i.pinimg.com/564x/37/0f/d6/370fd62bc86ec772653ef85a624f6553.jpg" alt="Artwork"> -->
    </div>
  </section>
  <section class="line">
      <h2>Featured Artists</h2>
    </section>
  <section class="featured-artists">
  
 
    <div class="artist-container">
  <?php
  $q = "SELECT * FROM `users` where username != 'admin' limit 3";
  $result = mysqli_query($conn, $q);
  while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    echo '<div class="artist-card" onclick="redirectToArtistDetail(\'artistdetail.php?id=' . $id . '\')">';
    echo '<img src=photo/' . $row['pp'] . ' height="500px" width= "500px" >';
    echo '<h2>'. $row['fname']. ' ' . $row['lname']. '<h2>  ';
    echo '</div>';
  }

  ?>
  <br>
</div>
  </section>

  <section class="line">
    <h2>Featured Artwork</h2>
    </section>
    <div class="artist-container">
      <?php
      $q = "SELECT * FROM `artworks` LIMIT 3";
      $result = mysqli_query($conn, $q);
      while($row = mysqli_fetch_assoc($result)){
        $artworkId = $row['artwork_id'];
        echo '<div class="artist-card" onclick="redirectToArtworkDetail(\'artworkdetail.php?id=' . $artworkId . '\')">';
        echo '<img src=' . $row['image_path'] . ' height="500px" width= "500px" >';
        echo '<h2>'. $row['title'];

        echo '</div>';
      
      }
      ?>
      
     
</main>

<script>
  function redirectToArtistDetail(url) {
    window.location.href = url;
  }
  function redirectToArtworkDetail(url) {
        window.location.href = url;
  }
  </script>
<?php include "footer.php"; ?>