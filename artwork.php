<?php include 'header.php';
?>
  <title>Online Art Gallery-Artwork</title>
<section class="hero">
    <div class="hero-text">
        <h2>Expressive Creation</h2>
        <p>Breathing life into the canvas, creating a world of its own.</p>
    </div>
    <div class="hero-image">
        <img src="img/artwork.jpg" alt="about">
    </div>
</section>
<section class="line">
    <h2>Artwork</h2>
    </section>



<div class="artist-container">
    <?php
    include 'partials/db.php';
    $q = "SELECT * FROM `artworks`";
    $result = mysqli_query($conn, $q);
    while ($row = mysqli_fetch_assoc($result)) {
        $artworkId = $row['artwork_id'];
        echo '<div class="artist-card" onclick="redirectToArtworkDetail(\'artworkdetail.php?id=' . $artworkId . '\')">';
        echo '<img src=' . $row['image_path'] . ' height="500px" width= "500px" >';
        echo '<h2>'. $row['title'];
        // echo '<p>Price: Rs. '. $row['price'].'</p>';

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

<?php include 'footer.php'; ?>