<?php include('db_connect.php'); session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fluids24 | Home </title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.webp">

</head>
<body>
    <header>
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
                        <?php if(isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) { ?>
                            <li><a href="logout.php">LogOut</a></li>
                        <?php } ?>
                    </ul>
                </nav>
                <a href="cart.php"><img src="images/cart.png" width="30px" height="30px"></a>
                <img src=" images/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
            <div class="row">
                <div class="col-2">
                    <h1>Give your decoration <br>a new look!</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita architecto facilis molestiae <br>aliquid beatae veritatis accusantium, numquam hic quaerat a!</p>
                    <a href="products.php" class="btn">Explore Now &#8594</a>
                </div>
                <div class="col-2">
                   
                </div>
            </div>
        </div>
    </header>

    <!-- --------featured Products------- -->

    <?php  ?>

    <div class="small-container">
        <h2 class="title"><?php if(isset($_SESSION['loggedin'])){ echo '<span class="welcome">Hey '.$_SESSION['username'].',</span>'; } ?> Check out this Featured Products</h2>
        <div class="row">
            
            <div class="col-4">
                <img src="images/art%201.jpeg" width="100px" height="300px">
                <h4>Art 1</h4>
                <div class="rating">
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star-empty"></i>
                </div>
                <p>$10.00</p>
                <a href="products.php" class="btn">Checkout More</a>
            </div>
            <div class="col-4">
                <img src="images/art%202.jpeg" width="100px" height="300px">
                <h4>Art 2</h4>
                <div class="rating">
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star-empty"></i>
                </div>
                <p>$50.00</p>
                <a href="products.php" class="btn">Checkout More</a>
            </div>
            <div class="col-4">
                <img src="images/art%203.jpeg" width="100px" height="300px">
                <h4>Art 3</h4>
                <div class="rating">
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star-empty"></i>
                </div>
                <p>$50.00</p>
                <a href="products.php" class="btn">Checkout More</a>
            </div>
            <div class="col-4">
                <img src="images/art%204.jpeg" width="100px" height="300px">
                <h4>Art 4</h4>
                <div class="rating">
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star-empty"></i>
                </div>
                <p>$50.00</p>
                <a href="products.php" class="btn">Checkout More</a>
            </div>
        </div>
    </div>

    <script src="script.js"></script>

</body>
</html>