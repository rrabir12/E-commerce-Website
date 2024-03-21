<?php include('header.php'); ?>

<?php 

if(isset($_GET['product_id'])){
 $product_id=$_GET['product_id'];
 $stm=$conn->prepare("SELECT * FROM products WHERE product_id=?");
 $stm->bind_param('i',$product_id);
 $stm->execute();
 $products=$stm->get_result();

}else if(isset($_POST['edit_btn'])){

    $product_id=$_POST['product_id'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $category=$_POST['category'];
    $color=$_POST['color'];
    $offer=$_POST['offer'];

     $stm = $conn->prepare('UPDATE products SET product_name=?, product_description=?,
     product_price=?,product_category=?, product_color=?, product_special_offer=?  WHERE product_id=?');
     $stm->bind_param('ssssssi', $title, $description, $price, $category, $color, $offer, $product_id);

     if($stm->execute()){
     header('location: products.php?edit_success_message=Product has been updated successfully');
     }else{
        header('location: products.php?edit_failure_message=Error occured, try again!');  
     }
}
else{
    header('location: products.php');
    exit;
}

?>

<div class="container-fluid">
  <div class="row">
    <?php include('sidebar.php'); ?>
    <div class="col-md-9 content">
      <h2>Edit Product</h2>

      <form method="POST" action="edit_product.php">
      <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
        <div class="form-group">

        <?php foreach($products as $product) { ?>
            <input type="hidden" class="form-control" name="product_id" value="<?php echo $product['product_id']; ?>">
          <label for="productName">Title</label>
          <input type="text" class="form-control" name="title" value="<?php echo $product['product_name']; ?>" id="productName" placeholder="Enter product name">
        </div>
        <div class="form-group">
          <label for="productName">Description</label>
          <input type="text" class="form-control" name="description" value="<?php echo $product['product_description']; ?>" id="productName" placeholder="Enter product description">
        </div>
        <div class="form-group">
          <label for="productPrice">Price</label>
          <input type="number" class="form-control" name="price" value="<?php echo $product['product_price']; ?>" id="productPrice" placeholder="Enter price">
        </div>
        <div class="form-group">
          <label for="productName">Category</label>
          <input type="text" class="form-control" name="category" value="<?php echo $product['product_category']; ?>" id="productName" placeholder="product category">
        </div>
        <div class="form-group">
          <label for="productName">Color</label>
          <input type="text" class="form-control" name="color" value="<?php echo $product['product_color']; ?>" id="productName" placeholder="product color">
        </div>
        <div class="form-group">
          <label for="productName">Special Offer/Sale</label>
          <input type="text" class="form-control" name="offer" value="<?php echo $product['product_special_offer']; ?>" id="productName" placeholder="sales %">
        </div>
        <button type="submit" name="edit_btn" class="btn btn-primary">Edit</button>

        <?php } ?>
      </form>
    </div>
  </div>
</div>
</body>
</html>
