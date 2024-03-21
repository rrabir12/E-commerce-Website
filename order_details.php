<?php include('layouts/header.php') ?>

<?php

/*
not paid
shipped
delivered 
*/

include('server/connect.php');

if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])){
    
    $order_id=$_POST['order_id'];

    $order_status=$_POST['order_status'];

    $stm=$conn->prepare("SELECT * FROM order_items WHERE order_id=?");

    $stm->bind_param("i",$order_id);

    $stm->execute();

    $order_details=$stm->get_result();

    $total_order_price=calculateTotalOrderPrice($order_details);
}else{
    header('location: account.php');
    exit;
}

function calculateTotalOrderPrice($order_details){
    $total=0;

    foreach($order_details as $row){
        $product_price=$row['product_price'];
        $product_quantity=$row['product_quantity'];

        $total=$total+($product_price * $product_quantity);
       
    }
    return $total;

}

?>

   <!-- orders -->
   <section id="orders" class="orders container my-5 py-3">
    <div class="container mt-5">
        <h2 class="font-weight-bold text-center">Your Orders</h2>
        <hr class="mx-auto">
        <table class="mt-5 pt-5 mx-auto">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                
            </tr>
            
            <?php foreach($order_details as $row) { ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/imgs/<?php echo $row['product_image']; ?>" alt="">
                            <div>
                                <p class="mt-3"><?php echo $row['product_name']; ?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span><?php echo "$ ".$row['product_price']; ?></span>
                    </td>
                    <td>
                        <span><?php echo $row['product_quantity']; ?></span>
                    </td>
                
                </tr>
            <?php } ?>
        </table>

        <?php

        if($order_status=='not paid'){?>
        <form style="float:right;" method="POST" action="payment.php">
            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
            <input type="hidden" name="total_order_price" value="<?php echo $total_order_price; ?>">
            <input type="hidden" name="order_status" value="<?php echo $order_status; ?>">
            <input type="submit" name="order_pay_btn" class="btn btn-primary" value="pay now">
        </form>
      
      <?php }?>
    </div>
</section>

<?php include('layouts/footer.php') ?>