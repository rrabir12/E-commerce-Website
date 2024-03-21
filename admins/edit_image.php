<?php include('header.php'); ?>

<?php 

if(isset($_GET['product_id'])){
    $product_id=$_GET['product_id'];
    $product_name=$_GET['product_name'];
}else{
    header('location: products.php');
}

?>


<div class="container-fluid">
  <div class="row">
    <?php include('sidebar.php'); ?>
    <div class="col-md-9 content">
      <h2>Update product images</h2>

      <form method="POST" enctype="multipart/form-data" action="update_image.php">
      <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
        <div class="form-group">

            <input type="hidden" class="form-control" name="product_id" value="<?php echo $product_id; ?>">
            <input type="hidden" class="form-control" name="product_name" value="<?php echo $product_name; ?>">
         
        <div class="form-group">
          <label for="productName">Image 1</label>
          <input type="file" class="form-control" name="image1" value="" id="image1" placeholder="Image 1" required>
        </div>
        <div class="form-group">
          <label for="productName">Image 2</label>
          <input type="file" class="form-control" name="image2" value="" id="image2" placeholder="Image 2" required>
        </div>
        <div class="form-group">
          <label for="productName">Image 3</label>
          <input type="file" class="form-control" name="image3" value="" id="image3" placeholder="Image 3" required>
        </div>
        <div class="form-group">
          <label for="productName">Image 4</label>
          <input type="file" class="form-control" name="image4" value="" id="image4" placeholder="Image 4" required>
        </div>
        <button type="submit" name="update_image" class="btn btn-primary">Update</button>

      </form>
    </div>
  </div>
</div>
</body>
</html>
