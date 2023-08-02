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
</head>

<body>

<div class="profile-container">
  <div class="artist-bio">
    <div class="artist-image">
      <img src="./photo/<?php echo $pp ?>" alt="Artist Name">
    </div>
    <div class="artist-info">
      <h2 class="artist-name"><?php echo "$fname" . " " . "$lname"; ?></h2>
      <h2 class="artist-name"><?php echo "$email"; ?></h2>

      <form class="a" method="POST" action="ppupload.php" enctype="multipart/form-data">
        <input type="file" name="profilePicture">
        <input type="submit" value="Change Profile Picture">
      </form>
      <br>
      <a href="edit_artist.php?id= <?php echo $id ?>" class="profile-link">Edit Profile</a> 
      <br>
      <a href="./addArtwork.php" class="profile-link">Add Artwork</a> 
      <a href="./manageorderUser.php" class="profile-link">Order Dashboard</a> 

    </div>
  </div>
</div>



    <section class="line">
    <h2>Gallery</h2>
    </section>


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
          echo '<p>Units Available: '.$row['units_available'].'</p>';
         
          echo '<br><div class="link-container"> ';
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
<?php 
// include "footer.php"; ?>
</body>

</html>