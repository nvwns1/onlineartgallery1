<?php
include "header.php";
include "./partials/db.php";


$userId = $_SESSION['id'];
$grand_total = 0;
$msg = "";

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart`
     WHERE cart_id = '$delete_id'") or die('query failed');
    $msg = "Successfully deleted!!";
    // header("location: cart.php");
}

if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM `cart`
     WHERE user_id = '$userId'") or die('query failed');
    $msg = "Successfully deleted all items!!";
    // header("location: cart.php");
}

if (isset($_POST['update_quantity'])) {
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($conn, "UPDATE cart SET quantity = '$cart_quantity' WHERE cart_id = '$cart_id'") or die('Query failed');
    $msg = "Quantity updated successfully!";
}

?>
<html>
<head>
    <title>My Cart</title>
    <style>
.dropdown {
            position: relative;
            display: inline-block;
        }
        
        .dropdown-button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .update-form {
            display: none;
            position: absolute;
            bottom: 100%;
            left: 0;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .update-form .qty {
            width: 60px;
            padding: 5px;
            margin-right: 10px;
        }

        

    </style>
    <script>
        function toggleForm(id) {
            var form = document.getElementById('update-form-' + id);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</head>

<section class="my-cart-line line">
    <h2>My Cart</h2>
    <?php if (!empty($msg)) : ?>
        <div id="message-pop"><?php echo $msg ?></div>
        <script>
            setTimeout(function() {
                let message = document.getElementById("message-pop")
                message.style.display = 'none'
            }, 10000)
        </script>
    <?php endif; ?>
    <div class="cart-total">
        <?php
        $query = "SELECT cart.cart_id, cart.user_id, artworks.title, artworks.image_path, artworks.price, cart.quantity
        FROM cart INNER JOIN artworks ON artworks.artwork_id = cart.artwork_id WHERE cart.user_id = $userId";
        $result = mysqli_query($conn, $query) or die('query failed');
        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $sub_total = $row['price'] * $row['quantity'];
                $grand_total += $sub_total;
            }
        }
        ?>
        <a href="cart.php?delete_all" class="btn <?php echo ($grand_total > 1)?'':'disabled' ?>" onclick="return confirm('delete all from cart?');">delete all</a>
        <p>Grand total : <span>Rs.<?php echo $grand_total; ?>/-</span></p>
        <a href="artwork.php" class="btn">Continue shopping</a>
        <a href="checkout.php" class="btn <?php echo ($grand_total > 1) ? '' : 'disabled' ?>">
            Proceed to Checkout</a>
    </div>
</section>


<section class="artist-container">
    <?php
    $grand_total = 0;
    $query = "SELECT cart.cart_id, cart.user_id, artworks.title, artworks.image_path, artworks.price, cart.quantity
    FROM cart INNER JOIN artworks ON artworks.artwork_id = cart.artwork_id WHERE cart.user_id = $userId";
    $result = mysqli_query($conn, $query) or die('query failed');
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
            <div class="artist-card">
                <img src="<?php echo $row['image_path']; ?>" alt="" class="image"> <!-- Updated column name here -->
                <?php echo $row['title']; ?>
                <h4>Rs.<?php echo $row['price']; ?>/-</h4>
                <h4>Quantity: <?php echo $row['quantity']; ?></h4>
                <div class="sub-total"> Sub-total : <span>Rs.<?php echo $sub_total = ($row['price'] * $row['quantity']); ?>/-</span> </div>

                <div class="dropdown">
                        <button onclick="toggleForm(<?php echo $row['cart_id']; ?>)" class="dropdown-button">Update</button>
                        <form id="update-form-<?php echo $row['cart_id']; ?>" class="update-form" action="" method="post">
                            <input type="hidden" value="<?php echo $row['cart_id']; ?>" name="cart_id">
                            <input type="number" min="1" value="<?php echo $row['quantity']; ?>" name="cart_quantity" class="qty">
                            <input type="submit" value="Save" class="btn" name="update_quantity">
                        </form>
                    </div>
                <a href="cart.php?delete=<?php echo $row['cart_id']; ?>" onclick="return confirm('delete this from cart?');">Delete</a>
            </div>
            </div>
    <?php
            $grand_total += $sub_total;
        }
    } else {
        $msg = "";
        echo '<p class="empty">your cart is empty</p>';
    }
    ?>
</section>


<?php include 'footer.php'; ?>