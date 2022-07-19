<?php
session_start();

// $conn = mysqli_connect("localhost", "root", "", "fluids");
$conn = mysqli_connect("sql207.epizy.com", "epiz_31855493", "2bP7rw6N3EXlwQ4", "epiz_31855493_fluids");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddProducts</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<?php include 'nav.php';?>

<body>
   
    <div class="container container-fluid">
    <h1 class="my-5">Add products</h1>
    <?php 
        if($_SESSION['product_added'] == true){
            echo '<div class="green-alert" id="removeAlert">
                        <div>
                           Product Added !
                        </div>
                        <div class="material-symbols-outlined" id="removeBtn" onclick="remove()" style="cursor:pointer;">
                            close
                        </div>
            </div>';
            $_SESSION['product_added'] = false;
        }

    ?>


    <form  action="addproducts.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="text" class="form-control" name="name" placeholder="name" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <input type="text" name="price" placeholder="price" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <input type="text" name="size" placeholder="size" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <input type="file" name="image"  class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <a href="products.php"><button type="button"  class="btn btn-success">View Products</button></a>
    </form>
    </div>
        
    <script>
             let removeAlert = document.getElementById('removeAlert')

                function remove(){
                    removeAlert.remove("hide");
                }
    </script>
    

</body>

</html>

<?php 

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $price = $_POST['price'];
            $size = $_POST['size'];
            $image = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            move_uploaded_file($image_tmp, "images/$image");
            $query = "INSERT INTO `products` (`name`, `size`, `price`, `image`) VALUES ('$name', '$size', '$price', '$image')";
            $result = mysqli_query($conn, $query);
            if($result){
                $_SESSION['product_added'] = true;
                
                $_SESSION['product_name'] = $name;
                $_SESSION['product_size'] = $size;
                $_SESSION['product_price'] = $price;
                $_SESSION['product_image'] = $image;

            }else{
                echo "<script>alert('Product not added')</script>";
            }
        }

    }

?>