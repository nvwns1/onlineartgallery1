<?php
include "header.php"; 
include "partials/db.php"?>

<title>Online Art Gallery-Artist</title>
<section class="hero">
  <div class="hero-text">
    <h2>Featured artist.</h2>
    <p>Where creativity knows no bounds, and imagination takes flight.</p>
  </div>
  <div class="hero-image">
    <img src="img/artist.jpg" alt="about">
  </div>
</section>
<section class="line">
    <h2>Artist</h2>
    </section>


<div class="artist-container">
  <?php
  $q = "SELECT * FROM `users` where username != 'admin'";
  $result = mysqli_query($conn, $q);
  while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    echo '<div class="artist-card" onclick="redirectToArtistDetail(\'artistdetail.php?id=' . $id . '\')">';
    echo '<img src=photo/' . $row['pp'] . ' height="500px" width= "500px" >';
    echo '<h2>'. $row['fname']. ' ' . $row['lname']. '<h2>  ';
    echo '<p> Username: '. $row['username'];

    echo '</div>';
  }

  ?>
</div>



<script>
  function redirectToArtistDetail(url) {
    window.location.href = url;
  }
</script>
<?php include "footer.php"; ?>