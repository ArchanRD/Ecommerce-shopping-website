<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
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
        </div>

        <script src="script.js"></script>

</body>
</html>