<?php include "header.php"; ?>
    <main>
      <section class="hero">
        <div class="hero-text">
          <h2>Welcome to Art Gallery</h2>
          <p>Discover the beauty of art and the power of expression in our online gallery.</p>
          <a href="#" class="btn">View Gallery</a>
        </div>
        <div class="hero-image">
          <img src="https://i.pinimg.com/564x/37/0f/d6/370fd62bc86ec772653ef85a624f6553.jpg" alt="Artwork">
        </div>
      </section>
      <section class="featured-artists">
        <h3>Featured Artists</h3>
        <div class="artist-container">
          <div class="artist" onclick="window.location.href = 'artist.php';">
            <img src="https://i.pinimg.com/564x/69/eb/57/69eb5764440f5232a7aed7e3db53acf5.jpg"  alt="Artist 1">
            <h4>Artist 1</h4>
          </div>
          <div class="artist">
            <img src="https://i.pinimg.com/564x/68/d6/a4/68d6a48c399895ed469351445c7c4f89.jpg" alt="Artist 2">
            <h4>Artist 2</h4>
          </div>
          <div class="artist">
            <img src="https://i.pinimg.com/564x/d6/68/83/d668839b939f18db97ebb350cba1be57.jpg" alt="Artist 3">
            <h4>Artist 3</h4>
          </div>
        </div>
      </section>
      <section class="latest-exhibitions">
        <h3>Latest Exhibitions</h3>
        <div class="exhibition-container">
          <div class="exhibition">
            <img src="https://i.pinimg.com/564x/5e/8f/aa/5e8faad32bd6f19bdec419cec341f38e.jpg" alt="Exhibition 1">
            <h4>Exhibition 1</h4>
          </div>
          <div class="exhibition">
            <img src="https://i.pinimg.com/564x/5b/43/af/5b43afeeb5d0c859cca920cd5ac0fa68.jpg" alt="Exhibition 2">
            <h4>Exhibition 2</h4>
          </div>
          <div class="exhibition">
            <img src="https://i.pinimg.com/564x/3b/91/74/3b9174e9cbc1f5bfba037f600d1a3a53.jpg" alt="Exhibition 3">
            <h4>Exhibition 3</h4>
          </div>
        </div>
      </section>
    </main>
<?php include "footer.php"; ?>