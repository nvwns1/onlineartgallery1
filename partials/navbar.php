<nav>
    <div class="nav-left-items">
        <span>Online Art Gallery</span>
    </div>
    <div class="nav-right-items">
        <div class="user-pic">
            <img src="<?php echo $_SESSION["profilePicLocation"]?>" alt="logo">
        </div>
        <h3><?php echo $_SESSION['username'] ?></h3>
        <a href="./partials/logout.php"><button class="btn">Logout</a>
    </div>
</nav>