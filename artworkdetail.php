<?php
include 'header.php';
include 'partials/db.php';
$artworkId = $_GET['id'];
$q= "Select users.fname, users.lname, artworks.title, artworks.description, artworks.image_path 
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
</head>
<body>
<section class="hero">
        <div class="hero-text">
          <h2><?php echo $row['title'] ?></h2>
          <p><?php echo $row['description'] ?></p>
          <h3>Desined by: <?php echo $row['fname'] .' ' . $row['lname'] ?></h3>
        </div>
        <div class="about-image">
          <img src="<?php echo $row['image_path'] ?>" height='600px' alt="about">
        </div>
      </section>
</body>
</html>
<?php include "footer.php"; ?>
