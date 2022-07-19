<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Products | Fluids24</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.webp">

</head>
<?php include 'nav.php';
?>
<body>
    <h1 class="text-center my-3 fw-semibold">Change the values of item and update the product</h1>
    <?php 
        if($_SESSION['alert']){
            echo '<div class="green-alert" id="removeAlert">
            <div>
               <strong style="color:#1d6c1d;">Success</strong> Product Updated !
            </div>
            <div class="material-symbols-outlined" id="removeBtn" onclick="remove()" style="cursor:pointer;">
                close
            </div>
            </div>';
            $_SESSION['alert'] = false;
        }
    ?>

    <script>
        let removeAlert = document.getElementById('removeAlert')

function remove(){
    removeAlert.remove("hide");
}
    </script>
</body>
</html>
<?php 


// $conn = mysqli_connect("localhost", "root", "", "fluids");
$conn = mysqli_connect("sql207.epizy.com", "epiz_31855493", "2bP7rw6N3EXlwQ4", "epiz_31855493_fluids");

$sql = "SELECT * FROM `products`";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
echo '<div class="flex">';
while($row = mysqli_fetch_assoc($result)){
    echo '
    <div class="card text-center" style="width: 18rem;">
    <form action="editproducts.php" method="POST" enctype="multipart/form-data">
    <img src="images/'.$row['image'].'" class="card-img-top" height="300px">
    <input type="file" name="image">
    <input type="hidden" value="'.$row['image'].'" name="old_image">
    <div class="card-body-2">
      <input type="text" name="name" class="text-center" value="'.$row['name'].'"> 
      <input type="text" name="price" class="text-center" value="'.$row['price'].'"> 
      <input type="text" name="size" class="text-center" value="'.$row['size'].'"> 
      <input type="hidden" value="'.$row['Id'].'" name="Id">
      <input type="submit" value="Update" name="update_product" class="remove-btn">
    </form>
    </div>
  </div>
    ';
}
echo '</div>';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['update_product'])){
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $old_image = $_POST['old_image'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $size = $_POST['size'];
        $id = $_POST['Id'];
        
        if($image == ''){
            $sql = "UPDATE `products` SET `name`='$name',`price`='$price',`size`='$size' WHERE `Id`='$id'";
            $result = $conn->query($sql);
            if($result){
                $_SESSION['alert'] = true;
                echo "<script>window.location.href='editproducts.php'</script>";
            }
        }else{

            move_uploaded_file($image_tmp, "images/$image");
            $sql = "UPDATE `products` SET `image`='$image',`name`='$name',`price`='$price',`size`='$size' WHERE `Id`='$id'";
            $result = $conn->query($sql);
            if($result){
                $_SESSION['alert'] = true;
                echo "<script>window.location.href='editproducts.php'</script>";
            }
        }
    


    }
}
?>