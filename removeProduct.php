<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Products | Fluids24</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    
</body>
</html>

<?php 

session_start();

include 'nav.php';

// $conn = mysqli_connect("localhost", "root", "", "fluids");
$conn = mysqli_connect("sql207.epizy.com", "epiz_31855493", "2bP7rw6N3EXlwQ4", "epiz_31855493_fluids");


$sql = "SELECT * FROM `products`";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
echo '<div class="flex">';
while($row = mysqli_fetch_assoc($result)){
    echo '
    <div class="card text-center" style="width: 18rem;">
    <img src="images/'.$row['image'].'" class="card-img-top" height="300px">
    <div class="card-body">
    <form action="removeProduct.php" method="POST">
      <h5 class="card-title">'.$row['name'].'</h5>
      <h5 class="card-title iprice">'.$row['price'].'</h5>
      <h5 class="card-title">'.$row['size'].'</h5>
      <input type="hidden" value="'.$row['Id'].'" name="Id">
      <input type="submit" value="Remove" name="remove_product" class="remove-btn">
    </form>
    </div>
  </div>
    ';
}
echo '</div>';




if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['remove_product'])){
      
      $Id = $_POST['Id'];
      
      $sql = "DELETE FROM `products` WHERE `products`.`Id` = '$Id'";
      $result = $conn->query($sql);
      if($result){
        header('location: removeProduct.php');
      }
    }
}
?>