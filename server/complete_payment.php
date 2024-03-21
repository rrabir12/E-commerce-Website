<?php 

session_start();
include('connect.php');

if(isset($_GET['transaction_id']) && isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];
    $order_status='paid';
    $transaction_id=$_GET['transaction_id'];
    $user_id=$_SESSION['user_id'];
    $payment_date=date('y-m-d H:i:s');

    //change order_status to paid
    $stm = $conn->prepare('UPDATE orders SET order_status=? WHERE order_id=?');
    $stm->bind_param('si', $order_status, $order_id);
    $stm->execute();

    //store payment info
    $stm1=$conn->prepare('INSERT INTO payments (order_id,user_id,transaction_id,payment_date)
    VALUES (?,?,?,?)');

    $stm1->bind_param('iiss',$order_id,$user_id,$transaction_id,$payment_date);

    $stm1->execute();

    //go to user account
    header('location: ../account.php?payment_message=paid successfully, thanks for shopping with us');

}else{
    header('location: index.php');
    exit;
}

?>