<?php

session_start();
include('connect.php');

    //if user is not logged in
if(!isset($_SESSION['logged_in'])){
    header('location: ../checkout.php?message=Please login/register to place an order');
    exit;
 
    //if user is logged in
}else{

if(isset($_POST['place_order'])){

//get user info and store it in database
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $city=$_POST['city'];
    $address=$_POST['address'];
    $order_cost=$_SESSION['total'];
    $order_status="not paid";
    $user_id= $_SESSION['user_id'];
    $order_date=date('y-m-d H:i:s');

    $stm=$conn->prepare('INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
    VALUES (?,?,?,?,?,?,?)');

    $stm->bind_param('isiisss',$order_cost,$order_status,$user_id,$phone,$city,$address,$order_date);

    $stm_status=$stm->execute();
    if(!$stm_status){
        header('location: ../index.php');
        exit;
    }

//issue new order and store order info in database
    $order_id=$stm->insert_id;

//get product from cart(from session)
    foreach($_SESSION['cart'] as $key => $value){
        $product = $_SESSION['cart'][$key];
        $product_id=$product['product_id'];
        $product_name=$product['product_name'];
        $product_image=$product['product_image'];
        $product_price=$product['product_price'];
        $product_quantity=$product['product_quantity'];

//store each single item in order_items db
       $stm1 = $conn->prepare('INSERT INTO order_items (order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date)
        VALUES (?,?,?,?,?,?,?,?)');
        
       $stm1->bind_param('iissiiis',$order_id,$product_id,$product_name,$product_image,$product_price,$product_quantity,$user_id,$order_date);

       $stm1->execute();
    
    }


//remove everything from cart->delay until payment is done
//    unset($_SESSION['cart']);

$_SESSION['order_id']=$order_id;


//inform user whether everything is fine or there is problem
header('location:../payment.php?order_status=order placed successfully');  // here this '?' means 'or'

}
}

?>