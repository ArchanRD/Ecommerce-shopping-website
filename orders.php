<?php
session_start();
if($_SESSION['role'] != "owner"){
    header("location: account.php");
}

// $conn = mysqli_connect("localhost", "root", "", "fluids");
$conn = mysqli_connect("sql207.epizy.com", "epiz_31855493", "2bP7rw6N3EXlwQ4", "epiz_31855493_fluids");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.webp">

</head>
<body class="body-bg2">
<div class="container">
            <div class="navbar">
                <div class="logo">
                    <img src="images/FluidArts.png" width="125px">
                </div>
                <nav>
                    <ul id="MenuItems">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="products.php">Products</a></li>
                        <li><a href="">About</a></li>
                        <li><a href="">Contact</a></li>
                        <li><a href="account.php">Account</a></li>
                        
                    </ul>
                </nav>
                <a href="cart.php"><img src="images/cart.png" width="30px" height="30px"></a>
                <img src=" images/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
            </div>
            
        <div class="order-container">
            <h1 class="heading2">Orders</h1>

    <?php 
    $sql = "SELECT * FROM orders WHERE user_id = ".$_SESSION['user_id']."";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

        for ($i=0; $i < $num; $i++) { 
            $row = mysqli_fetch_assoc($result);
            echo '
            <div class="order-card">
            <p>Order Id: '.$row["order_id"].'</p>
            <p>Username: '.$row['username'].'</p>
            <p>Address: '.$_SESSION['address'].'</p>
            <p>Product Name: '.$row['product_name'].'</p>
            <p>Product Price: '.$row['product_price'].'</p>
            <p>Final Price: '.$row['total'].'</p>
            
             <form action="orders.php" method="POST">
                <input type="hidden" value="'.$row['order_id'].'" name="order_id">
                <input type="submit" value="Confirm" name="confirm" class="remove-btn">
             </form>
             </div>
                ';
        }
    ?>
           


        </div>

<script src="script.js"></script>
</body>
</html>

<?php 

    if(isset($_POST['confirm'])){
        $order_id = $_POST['order_id'];
        $sql = "DELETE FROM `orders` WHERE `orders`.`order_id` = '$order_id'";
        $result = mysqli_query($conn, $sql);
        echo '<script>
            window.location.href="orders.php"
            </script>';
    }

?>