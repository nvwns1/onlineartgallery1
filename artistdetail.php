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

<style>
  .artist-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
}

.artist-card {
    flex-basis: calc(33.33% - 20px);
    margin: 10px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

.artist-card img {
    width: 400px;
    height: 400px;
    object-fit: cover;
    border-radius: 0%;
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
</style>
<body>
<section class="hero">
        <div class="hero-text">
          <h2><?php echo $row['fname'].' '.$row['lname']?></h2>
        </div>
        <div class="about-image">
          <img src="<?php echo 'photo/'. $row['pp'] ?>" height='500px' alt="about">
        </div>
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
