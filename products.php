<?php
session_start();

// include 'nav.php';

$conn = mysqli_connect('localhost', 'root', '', 'fluids');
// $conn = mysqli_connect("sql207.epizy.com", "epiz_31855493", "2bP7rw6N3EXlwQ4", "epiz_31855493_fluids");


$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Fluids24</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.webp">

</head>
<?php include 'nav.php'; ?>
<body>
    <div class="small-container">
        <h1 class="title">Check out the Products</h1>
        <?php 
            if($_SESSION['added_to_cart'] == true){
                echo '<div class="green-alert" id="removeAlert">
                        <div>
                           Added to Cart ! <a href="cart.php">View Cart</a>
                        </div>
                        <div class="material-symbols-outlined" id="removeBtn" onclick="remove()" style="cursor:pointer;">
                            close
                        </div>
            </div>';
            $_SESSION['added_to_cart'] = false;
            }

        ?>
        <div class="row ">
        <?php 

            for ($i=0; $i < $num; $i++) { 
                $row = mysqli_fetch_assoc($result);
        ?>
                <div class="col-4 cart-items">
                <form action="cart.php" method="POST">
                    <img src="images/<?php echo $row['image'] ?>" id="productImage" width="100%" height="300px" style="object-fit: contain;">
                    <h4 id="productHeading"><?php echo $row['name'] ?></h4>
                    <p id="productPrice" >₹<?php echo $row['price'] ?></p>
                    <p id="productSize"><?php echo $row['size'] ?></p>
                    <div class="rating">
                        <i class="icon-star"></i>
                        <i class="icon-star"></i>
                        <i class="icon-star"></i>
                        <i class="icon-star"></i>
                        <i class="icon-star-empty"></i>
                    </div>
                    <input type="hidden" value="<?php echo $row['Id'] ?>" name="p_id">
                    <button class="btn" type="submit" name="Add_to_cart" id="addToCart">Add to cart</button>
                    </form>
                </div>
                <?php } ?>
            </div>
    </div>
    <script>
             let removeAlert = document.getElementById('removeAlert')

                function remove(){
                    removeAlert.remove("hide");
                }
    </script>
    <script src="script.js"></script>
</body>
</html>