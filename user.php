<?php
include "header.php";
include "./partials/db.php";

$id = $_SESSION['id'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$email = $_SESSION['email'];

if (!isset($pp)) {
  $ppQ = "SELECT pp FROM users Where id='$id'";
  $result = mysqli_query($conn, $ppQ);
  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $pp = $row['pp'];
      $_SESSION['pp'] = $pp;
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>User Profile</title>
  <link rel="stylesheet" type="text/css" href="artistPage.css">

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
    width: 300px;
    height: 300px;
    object-fit: cover;
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
    .link-container {
            display: flex;
            gap: 10px;
        }

        .edit-link{
            padding: 5px 10px;
            background-color: #eee;
            text-decoration: none;
            color: #333;
        }
        .delete-link {
            padding: 5px 10px;
            background-color: red;
            text-decoration: none;
            color: #fff;
        }
</style>

<body>

  <div class="container">
    <div class="artist-bio">
      <div class="artist-image">
        <img src="./photo/<?php echo $pp ?>" alt="Artist Name">
      </div>
      <div class="artist-info">

        <h2 class="artist-name"><?php echo "$fname" . " " . "$lname"; ?></h2>
        <form method="POST" action="ppupload.php" enctype="multipart/form-data">
          <input type="file" name="profilePicture">
          <input type="submit" value="Change Profile Picture">

        </form>
      <nav>
      <a style="color: #fff; background-color:#333; width: 200px;" href="./addArtwork.php">Add artwork</a> 

      </nav>
     
      </div>
    </div>



    <div class="artist-container">
      <?php
      $query = "Select * FROM artworks WHERE artist_id = $id";
      $result = mysqli_query($conn, $query);
      if ($result  && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $id=$row['artwork_id'];
          $uname = $_SESSION['username'];
          echo '<div class="artist-card">';
          echo '<img src="'.$row['image_path']  .'"  onclick=
          "redirectToArtworkDetail(\'artworkdetail.php?id='.$id.'\')" alt="Artwork 1">';
          echo '<h2>'.$row['title'].'</h2>';
          echo '<div class="link-container">';
        echo '<a class="edit-link" href="edit_artwork.php?id='.$id.'">Edit';
       echo "<a class='delete-link' onclick=\"return confirm(
        'Are you sure to delete?')\" 
        href='deleteArtworkbyuser.php?id=$id'>Delete</a>";
        echo '</div>';
          echo "</div>";
        }

      }
      ?>

    </div>


  <script>
  function redirectToArtworkDetail(url) {
    window.location.href = url;
  }
</script>
<?php include "footer.php"; ?>
</body>

</html>