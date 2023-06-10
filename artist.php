<?php include "header.php"; 
include "partials/db.php"?>

<style>
    .artist-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
}

.artist-card {
    flex-basis: calc(33.33% - 20px);
    margin-bottom: 20px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    transition: transform 0.3s ease;
}

.artist-card img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 20px;
}
.artist-card h2 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            color: #333;
            margin-bottom: 10px;
        }


.artist-card p {
    margin: 0;
    color: #666;
    text-align: center;
    font-size: 14px;
}
</style>


<section class="hero">
  <div class="hero-text">
    <h2>Featured artist.</h2>
    <p>Where creativity knows no bounds, and imagination takes flight.</p>
  </div>
  <div class="about-image">
    <img src="img/artist.jpg" height='600px' alt="about">
  </div>
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
  <br>
</div>



<script>
  function redirectToArtistDetail(url) {
    window.location.href = url;
  }
</script>
<?php include "footer.php"; ?>