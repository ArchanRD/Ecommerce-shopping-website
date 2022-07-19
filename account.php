<?php session_start();

include 'mail.php';
$address;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts | Fluids24</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.webp">
</head>
<body  class="body-bg">
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
                        <?php if($_SESSION['loggedin'] != true){
                            echo '<li><a href="account.php">Account</a></li>';
                        } ?>

                    </ul>
                </nav>
                <?php if($_SESSION["loggedin"] == true){  ?>
                <span class="material-symbols-outlined">account_circle</span>
                <?php }?>
                <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
        </div>
        <?php
        if($_SESSION['account_created'] == true){
            echo '<div class="green-alert" id="removeAlert">
                        <div>
                           <strong>Success !</strong> Account Created
                        </div>
                        <div class="material-symbols-outlined" id="removeBtn" onclick="remove()" style="cursor:pointer;">
                            close
                        </div>
            </div>';
            $_SESSION['account_created'] = false;
        }

        if($_SESSION['signup_error'] == true){
            echo '<div class="red-alert" id="removeAlert">
                <div>
                <strong>Error !</strong> Email Already Exists
                </div>
                <div class="material-symbols-outlined" id="removeBtn" onclick="remove()" style="cursor:pointer;">
                    close
                </div>
                </div>';
            $_SESSION['signup_error'] = false;
        }


        if($_SESSION['signin_error']){
            echo '<div class="red-alert" id="removeAlert">
                    <div>
                    <strong>Error !</strong> Invalid Credentials
                    </div>
                    <div class="material-symbols-outlined" id="removeBtn" onclick="remove()" style="cursor:pointer;">
                        close
                    </div>
                </div>';
            $_SESSION['signin_error'] = false;
        }



        if(!isset($_SESSION['loggedin'])){
            echo '
             <div class="account-page">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <div class="form-container">
                            <div class="form-btn">
                                <span onclick="login()">Login</span>
                                <span onclick="register()">Register</span>
                                <hr id="Indicator">

                                <form id="LoginForm" action="account.php" method="post">
                                    <input type="email" placeholder="email" name="loginEmail" required>
                                    <input type="password" placeholder="password" name="loginPassword" required>
                                    <button type="submit" class="btn" name="login-submit">Login</button>
                                    <a href="#">Forgot Password?</a>
                                </form>

                                <form id="RegForm" action="account.php" method="post">
                                    <input type="text" placeholder="username" name="regUsername" required>
                                    <input type="email" placeholder="email" name="regEmail" required>
                                    <input type="password" placeholder="password" name="regPassword" required>
                                    <button type="submit" class="btn" name="reg-submit">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
        }else{
            if(time() - $_SESSION['login_time_stamp'] > 518400){
                echo '<div class="red-alert" id="removeAlert">
                        <div>
                           <strong>Error !</strong> Session Expired
                        </div>
                        <div class="material-symbols-outlined" id="removeBtn" onclick="remove()" style="cursor:pointer;">
                            close
                        </div>';
                        header("Location: logout.php");
            }
        ?>
<!--      account page -->
        <div class="container-flex">
            <div class="left-container">
                <h2>hello</h2>
                <h3><?php echo $_SESSION['username'] ?></h3>
                <a class="logout" href="logout.php">Log Out</a>
                <ul class="account-links">

                    <li><a href="#" class="active">Dashboard</a></li>
                    <?php if($_SESSION['role'] == "owner") {?>
                    <li><a href="orders.php">Orders</a></li>
                    <?php } ?>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="right-container">
                <div class="cards">
                    
                    <div class="card-info">  
                    <a class="card-body" href="myaccount.php">
                        <img src="myAccount.png" width="90x" height="90px">
                        <div class="details">
                        <h2>My Account</h2>
                        <p>Edit your name or change <br>password. </p>
                    </div>
                    </a>
                    </div>
                   
                    <div class="card-info">  
                    <a class="card-body" href="#">
                        <img src="Address.png" width="90px" height="90px">
                        <div class="details">
                        <h2>Billing Address</h2>
                        <p>Setup your billing <br>address. </p>
                    </div>
                    </a>
                    </div>
                    <?php if($_SESSION['role'] != 'owner'){ ?>
                        
                        <div class="card-info">  
                        <a class="card-body" href="#">
                        <img src="Membership.png" width="9s0px" height="9s0px">
                        <div class="details">
                        <h2>Membership</h2>
                        <p>Introducing Soon. </p>
                        </div>
                        </a>
                        </div>
                    
                    <?php }else{?>
                        <div class="card-info">  
                            <a class="card-body" href="select.html">
                        <img src="Membership.png" width="100px" height="100px">
                        <div class="details">
                        <h2>Owner's Area</h2>
                        <p>Add, Edit or Remove <br>products. </p>
                        </div>
                    </a>
                        </div>
                        

                   <?php }?>
                   
                </div>
                <img src="wave.png" class="wave">
            </div>
        </div>



        <?php
        }

        ?>
        <script>
            let removeAlert = document.getElementById('removeAlert')

            function remove(){
                removeAlert.remove("hide");
            }
        </script>
        <script src="script.js"></script>

</body>
</html>

<?php
//register account
// $conn = mysqli_connect("sql207.epizy.com", "epiz_31855493", "2bP7rw6N3EXlwQ4", "epiz_31855493_fluids");
 $conn = mysqli_connect("localhost", "root", "", "fluids"); 



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['reg-submit'])){
        $username = $_POST['regUsername'];
        $email = $_POST['regEmail'];
        $password = $_POST['regPassword'];
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $role = "member";


        $sql = "SELECT name FROM users WHERE email = '$email';";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num > 0){
            $_SESSION['signup_error'] = true;
        }else{
            $otp = rand(1000, 3000);
            $_SESSION['otp'] = $otp;
            smtp_mailer($email);
            header("location: otp.php");
            if($_SESSION['signin_success']){
                $sql = "INSERT INTO `users` (`name`, `email`, `password`, `role`, `address`) VALUES ('$username', '$email', '$hash', '$role', '$address');";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $_SESSION['account_created'] = true;
                }
            }
        }
    }
}

//login

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['login-submit'])){
        $email = $_POST['loginEmail'];
        $password = $_POST['loginPassword'];

        $select = "SELECT * FROM users WHERE email = '$email';";
        $result = mysqli_query($conn, $select);
        $num = mysqli_num_rows($result);
        if($num == 1){
            $row = mysqli_fetch_assoc($result);
            $hash = $row['password'];
            if(password_verify($password, $hash)){
                $_SESSION['user_id'] = $row['Id'];
                $_SESSION['username'] = $row['name'];
                $_SESSION['loggedin'] = true;
                $_SESSION['role'] = $row['role'];
                $_SESSION['login_time_stamp'] = time();
                header("location: account.php");
            }
        }else{
           $_SESSION['signin_error'] = true;
        }

    }
}
?>