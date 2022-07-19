<?php  
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = mysqli_connect("localhost", "root", "", "fluids");



    if($_SERVER['REQUEST_METHOD'] == 'POST'){
         
            if(isset($_POST['Add_to_cart'])){
            
                $name = $_POST['name'];
                echo $name;

    }
}
    
?>