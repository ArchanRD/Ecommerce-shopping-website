<?php
session_start();
include 'mail.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify Account</title>
    <link rel="icon" type="image/x-icon" href="favicon.webp">
    <link rel="stylesheet" href="style.css">
</head>
<body class="otp-body">
    <div class="container otp-form">
    <h1>We have sent a verification code on your email account.</h1>
    <form action="otp.php" method="post">

    <input type="text"  name="user_otp">
    <input type="submit" name="otp_submit" class="otp-submit">

    </form>
    </div>
   
</body>
</html>
<?php
//  $conn = mysqli_connect("localhost", "root", "", "fluids");
$conn = mysqli_connect("sql207.epizy.com", "epiz_31855493", "2bP7rw6N3EXlwQ4", "epiz_31855493_fluids");

    if(isset($_POST['otp_submit'])){
        $user_otp = $_POST['user_otp'];
        if($user_otp == $_SESSION['otp']){
           $_SESSION['signin_success'] = true;
           header("Location: account.php"); 
        }else{
            echo '<script>alert("Invalid Code")</script>';
        }
    }
?>
