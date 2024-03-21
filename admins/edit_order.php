<?php include('header.php'); ?>

<?php 

if(isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];
    $stm=$conn->prepare("SELECT * FROM orders WHERE order_id=?");
    $stm->bind_param('i',$order_id);
    $stm->execute();
    $orders=$stm->get_result();
   
   }else if(isset($_POST['edit_btn'])){

    $order_id=$_POST['order_id'];
    $order_status=$_POST['order_status'];

     $stm = $conn->prepare('UPDATE orders SET order_status=? WHERE order_id=?');
     $stm->bind_param('si', $order_status, $order_id);

     if($stm->execute()){
     header('location: orders.php?edit_success_message=Status has been updated successfully');
     }else{
        header('location: orders.php?edit_failure_message=Error occured, try again!');  
     }
}
else{
    header('location: orders.php');
    exit;
}
   

?>

<div class="container-fluid">
  <div class="row">
    <?php include('sidebar.php'); ?>
    <div class="col-md-9 content">
      <h2>Edit Product</h2>

      <form method="POST" action="edit_order.php">
    <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
        <div class="form-group">
        <?php foreach($orders as $order) { ?>
          <label for="productName">Order id</label>
          <p class="mb-4"><?php echo $order['order_id']; ?></p>
        </div>
        <div class="form-group">
          <label for="productName">Order cost</label>
          <p class="mb-4"><?php echo $order['order_cost']; ?></p>
        </div>

        <input type="hidden" class="form-control" name="order_id" value="<?php echo $order['order_id']; ?>">
        <div class="form-group my-3">
          <label >Order status</label>
          
         <select class="form-select" name="order_status" id="" required>
            <option value="not paid" <?php if($order['order_status']=='not paid'){echo "selected"; } ?>>Not paid</option>
            <option value="paid" <?php if($order['order_status']=='paid'){echo "selected"; } ?>>Paid</option>
            <option value="shipped" <?php if($order['order_status']=='shipped'){echo "selected"; } ?>>Shipped</option>
            <option value="delivered" <?php if($order['order_status']=='delivered'){echo "selected"; } ?>>Delivered</option>
         </select>
        </div>
        <div class="form-group">
          <p class="mt-4"><?php echo $order['order_date']; ?></p>
          
        </div>
        
        <button type="submit" name="edit_btn" class="btn btn-primary">Edit</button>

        <?php } ?>
      </form>
    </div>
  </div>
</div>
</body>
</html>
