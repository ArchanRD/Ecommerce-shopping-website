<?php

use function PHPSTORM_META\type;

session_start();
include 'checkout_mail.php';

$conn = mysqli_connect("localhost", "root", "", "fluids");
// $conn = mysqli_connect("sql207.epizy.com", "epiz_31855493", "2bP7rw6N3EXlwQ4", "epiz_31855493_fluids");

$sql = "SELECT * FROM users WHERE Id = '".$_SESSION['user_id']."'";
$result = mysqli_query($conn, $sql);
$row= mysqli_fetch_assoc($result);
$email = $row['email'];
$_SESSION['address'] = $row['address'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Fluids24</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.webp">

</head>
<?php include 'nav.php';


?>

<body>

    <?php

   


    if($_SESSION['loggedin'] == true || isset($_SESSION['loggedin'])){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['Add_to_cart'])){
                $id = $_POST['p_id'];
    
                $query = "SELECT * FROM products WHERE id = '$id'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_array($result);
                $ID = $row['Id'];
                $name = $row['name'];
                $price = $row['price'];
                $image = $row['image'];
                $size = $row['size'];
                $user_id = $_SESSION['user_id'];
                $_SESSION['pr_name'] = $name;


                $total = $price;
                $quantity = 1;
                $insert = "INSERT INTO `cart_products` (`user_id`, `pr_name`, `pr_price`, `quantity`, `total`, `size`, `image`) VALUES ('$user_id', '$name', '$price', '$quantity', '$total', '$size', '$image');";
                $result = mysqli_query($conn, $insert);
                if($result){
                    $_SESSION['added_to_cart'] = true; 
                    $_SESSION['p_id'] = $row['Id'];
                    header("location: products.php");
                }else{
                    echo '<script>alert("Failed to add the product")</script>';
                }
            }
        }

        $user_id = $_SESSION['user_id'];
        $select  = "SELECT * FROM `cart_products` WHERE `user_id` = '$user_id'";
        $result = mysqli_query($conn, $select);
        $num = mysqli_num_rows($result);
        
        for ($i=0; $i < $num; $i++) { 
            $epic_row = mysqli_fetch_assoc($result);

            $total += $epic_row['total'];
        }

        //remove item script

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['remove_item'])){

                $id = $_POST['id'];

                $sql = "DELETE FROM `cart_products` WHERE `cart_products`.`user_id` = '$user_id' AND `cart_products`.`Id` = '$id'";
                $result = mysqli_query($conn, $sql);
                if($result){
                    header('location: cart.php');
                    
                }
            }
        }

        ?>
        <h1 class="heading">Your Cart</h1>
        

        <?php
        echo '<div class="flex">';
        $select = "SELECT * FROM `cart_products` WHERE `user_id` = '$user_id'";
        $result = mysqli_query($conn, $select);
        while( $row = mysqli_fetch_assoc($result)){

            echo '
            <div class="card text-center" style="width: 18rem;">
            <img src="images/'.$row['image'].'" class="card-img-top" height="300px">
            <div class="card-body">
            <form action="cart.php" method="POST">
              <h5 class="card-title">Name: '.$row['pr_name'].'</h5>
              <h5 class="card-title iprice">Price: ₹'.$row['pr_price'].'</span></h5>
              <h5 class="card-title">Canvas Size: '.$row['size'].'</h5>
              <input type="hidden" value="'.$row['pr_price'].'" name="price">
              <input type="hidden" value="'.$row['Id'].'" name="id">
              <button class="minus counter-buttons" name="minus" type="submit" >-</button>
              <input type="number" min="1" max="5" name="quantity" value="'.$row['quantity'].'" class="quantity iquantity">
              <button class="plus counter-buttons" name="add" type="submit" onchange="subtotal()">+</button>
              <input type="submit" value="Remove" name="remove_item" class="remove-btn">
            </form>
            </div>
          </div>
            ';
        }
        echo '</div>';
        

        echo '<div class="container container-fluid bg-light rounded flexbox">
                <h5>Grand Total: ₹<span id="gtotal">'.$total.'</span></h5>
                <form action="payscript.php" method="POST">
                    <input type="submit" value="Checkout" name="checkout" class="checkout-btn">
               </form>
            </div>';
    }else{
        header("location: account.php");
    }
    //checkout script
    if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['checkout'])){
        $user_id = $_SESSION['user_id'];
        
        $select = "SELECT * FROM `cart_products` WHERE `user_id` = '$user_id'";
        $execute = $conn->query($select);
        $num = mysqli_num_rows($execute);
        
        for ($i=0; $i < $num; $i++) { 
            $order_id = rand(000000000, 200000000);
            $row = mysqli_fetch_assoc($execute);

            $sql = "INSERT INTO orders (user_id, order_id, username, product_name, product_price, total) VALUES($user_id, $order_id, '$_SESSION[username]', '$row[pr_name]', $row[pr_price],$row[total])";
            $result = mysqli_query($conn, $sql);
        }

        $sql = "DELETE FROM `cart_products` WHERE `cart_products`.`user_id` = '$user_id'";
        $result = mysqli_query($conn, $sql);
        if(checkout_mailer($email)){
            echo "<script>window.location.href='cart.php'</script>";
        }
    }
}

    //cart quantity
   

    if(isset($_POST['add'])){
        $quantity = $_POST['quantity'];
        $quantity+=1;
        $id = $_POST['id'];
        $price = $_POST['price'];
        $total = $quantity * $price;

        if($quantity == 6){
            $quantity -= 1;
        }

        $sql = "UPDATE `cart_products` SET `quantity` = '$quantity', `total` = '$total' WHERE `Id` = '$id'";
        $result = $conn->query($sql);
        echo '<script>
            window.location.href="cart.php"
            </script>';

    }
    if(isset($_POST['minus'])){
        $quantity = $_POST['quantity'];
        $quantity-=1;
        $id = $_POST['id'];
        $price = $_POST['price'];
        $total = $quantity * $price;
        if($quantity == 0){
            $sql = "DELETE FROM `cart_products` WHERE `cart_products`.`Id` = '$id'";
            $result = $conn->query($sql);
        }    

        $sql = "UPDATE `cart_products` SET `quantity` = '$quantity', `total` = '$total' WHERE `Id` = '$id'";
        $result = $conn->query($sql);
        echo '<script>
            window.location.href="cart.php"
            </script>';
        
    }
 
    ?>
    <script src="script.js"></script>
</body>
</html>