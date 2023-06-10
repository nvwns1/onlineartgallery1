<?php include 'header.php';



?>
<style>
    .container{
        margin: 30px;
    }
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
</style>
<section class="hero menu">
    <div class="hero-text container1">
        <h2>Expressive Creation</h2>
        <p>Breathing life into the canvas, creating a world of its own.</p>
    </div>
    <div class="about-image container2">
        <img src="img/artwork.jpg" height='700px' alt="about">
    </div>
</section>
<div class="container">
<h2>Artwork</h2>



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
</div>

<?php include 'footer.php'; ?>