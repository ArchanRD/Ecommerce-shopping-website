<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "fluids");
// $conn = mysqli_connect("sql207.epizy.com", "epiz_31855493", "2bP7rw6N3EXlwQ4", "epiz_31855493_fluids");


$sql = "SELECT * FROM users WHERE Id = '$_SESSION[user_id]'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account | Fluids24</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.webp">
<body class="body-bg">
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
    <div class="container-flex">
        <div class="mid-container">
            <h1 class="heading">My Account</h1>
            <div class="account-details">
            <h2 for="name">Username: <?php echo $row['name'] ?></h2>
            <h2>Email: <?php echo $row['email'] ?></h2>
            <a href="" class="change_password">Change Password</a>
            <h2>Address: <?php echo "<span class='address_not_added'>".$row['address']."</span>" ?></h2>
            <?php 
                if($row['address'] == NULL){
                    echo '<div>
                            <form action="myaccount.php" method="POST">
                                <label>Add Now</label>
                                <input type="text" name="address">
                                <input type="submit" name="submit-btn">
                            </form>
                    </div>';
                }

            ?>
            <form action="myaccount.php" method="POST">
                <button type="button" id="del_btn" class="del_btn" onclick="showModal()">Delete Account</button>
              
                    <div id="modal">
                        <div id="modal-content">
                            <!-- modal content  -->
                            <h2>Are you sure you want to delete your account?</h2>
                            <input type="submit" class="del_button" value="Delete Account" name="delete_account_final">
                            <input type="button" class="close_button" id="close" value="Cancel">
                        </div>
                    </div>
                
            </form>
            </div>
        
        <script src="script.js"></script>
        <script>
            let btn = document.getElementById('del_btn')
            let modal = document.getElementById('modal')
            let close = document.getElementById('close')

            function showModal(){
                modal.style.display = "block";
            }

            close.onclick = function(){
                modal.style.display = "none"
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            

        </script>
</body>
</html>

<?php 

if(isset($_POST['submit-btn']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $update = "UPDATE `users` SET `address` = '".$_POST['address']."' WHERE `users`.`Id` = '".$_SESSION['user_id']."'";
    $result = mysqli_query($conn, $update);
    header("location: myaccount.php");
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['delete_account_final'])){
       $sql = "DELETE FROM users WHERE Id=".$_SESSION['user_id']."";
       $result = mysqli_query($conn, $sql);
       if($result){
        header("location: logout.php");
       }
    }
}
?>