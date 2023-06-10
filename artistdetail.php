<?php
include 'header.php';
include 'partials/db.php';
$id = $_GET['id'];
$q= "Select users.fname, users.lname,users.pp, artworks.artwork_id, artworks.title , artworks.image_path
from users left join artworks on users.id = artworks.artist_id 
WHERE users.id = $id;
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
</head>

<body>
<section class="hero">
        <div class="hero-text">
          <h2><?php echo $row['fname'].' '.$row['lname']?></h2>
        </div>
        <div class="about-image">
          <img src="<?php echo 'photo/'. $row['pp'] ?>" height='500px' alt="about">
        </div>
      </section>
 
      <section class="line">
        <h2><?php echo $row['fname']?>'s Gallery</h2>
      </section>
<div class="artist-container">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        $artworkId = $row['artwork_id'];
        echo '<div class="artist-card" onclick="redirectToArtworkDetail(\'artworkdetail.php?id=' . $artworkId . '\')">';
        echo '<img src=' . $row['image_path'].'>';
        echo '<h2>' . $row['title'].'</h2>';
        echo '</div>';
    } 
    ?>
    <br>
</div>
<script>
    function redirectToArtworkDetail(url) {
        window.location.href = url;
    }
</script>
</body>
</html>
<?php include "footer.php"; ?>
