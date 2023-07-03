<?php
include "header.php";
include "./partials/db.php";
$userId = $_SESSION['id'];

if(isset($_POST['order'])){
    $name = $_POST['name'];
    $number =  $_POST['number'];
    $email =  $_POST['email'];
    $status="Ordered";

    $address = $_POST['address'];
    $order_date=date("Y_m_d h:i:sa");

    $cart_total = 0;
    $cart_products[] = '';

    $query = "SELECT cart.cart_id, cart.user_id, artworks.title, artworks.image_path, artworks.price, cart.quantity
        FROM cart INNER JOIN artworks ON artworks.artwork_id = cart.artwork_id WHERE cart.user_id = $userId";
    
    $result = mysqli_query($conn, $query)or die('query failed');
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $cart_products[] = $row['title']. ' ('.$row['quantity'].') ';
            $sub_total = ($row['price']* $row['quantity']);
            $cart_total +=$sub_total;
        }
    }
    $total_products = implode(', ', $cart_products);
    $order_query = mysqli_query($conn,
     "SELECT * FROM `orders` WHERE name = '$name' 
     AND number = '$number' AND email = '$email' 
     AND status = '$status' AND address = '$address' 
     AND total_products = '$total_products' 
     AND total_price = '$cart_total'") or die('query failed');  


    if($cart_total == 0){
        $message[] = 'your cart is empty';
    }elseif(mysqli_num_rows($order_query)>0){
        echo "<script>
        alert('order placed')
        ";
        echo "</script>";
    }else{
        mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, address, total_products, total_price, order_date, status)
         VALUES('$user_id', '$name', '$number', '$email', '$address', '$total_products', '$cart_total' ,'$order_date', '$status')")
          or die('query failed');
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$userId'") or die('query failed');
        echo "<script>
                alert('order placed successfully');
      </script>"; 
    }
}



?>

<section>
    <h3>Checkout</h3>
</section>

<section class="display-order">
    <?php 
    $grand_total = 0;
    $query = "SELECT cart.cart_id, cart.user_id, artworks.title, artworks.image_path, artworks.price, cart.quantity
        FROM cart INNER JOIN artworks ON artworks.artwork_id = cart.artwork_id WHERE cart.user_id = $userId";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $total_price = ($row['price'] * $row['quantity']);
            $grand_total += $total_price;
            ?>

            <p><?php echo $row['title']?></p>
            <?php
        }
    }else{
        echo '<p class="empty">your card is empty</p>';
    }
    ?>
        <div class="grand-total">grand total : <span>$<?php echo $grand_total; ?>/-</span></div>

    
</section>


<section class="checkout">

    <form action="" method="POST">

        <h3>Place your order</h3>

        <div class="flex">
            <div class="inputBox">
                <span>Name :</span>
                <input type="text" name="name" placeholder="Enter your Name">
            </div>
            <div class="inputBox">
                <span>Number :</span>
                <input type="number" name="number" min="0" placeholder="E.g. 984xxxxxxx">
            </div>
            <div class="inputBox">
                <span>Email :</span>
                <input type="email" name="email" placeholder="Enter your email">
            </div>
            
            <div class="inputBox">
                <span>Address :</span>
                <input type="text" name="address" placeholder="E.g. Street, City, Country">
            </div>
            
        </div>

        <input type="submit" name="order" value="Order now" class="btn">

    </form>

</section>
