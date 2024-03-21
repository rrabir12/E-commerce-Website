<?php

session_start();

include('../server/connect.php');

if(!isset($_SESSION['admin_logged_in'])){
  header('location: admin_login.php');
  exit;
}

if(isset($_GET['product_id'])){

    $product_id=$_GET['product_id'];
$stm=$conn->prepare("DELETE FROM products WHERE product_id=?");
$stm->bind_param('i',$product_id);

if($stm->execute()){
header('location: products.php?deleted_success=product has been deleted successfully');
}else{
header('location: products.php?deleted_failure=could not deleted product');   
}

}


?>