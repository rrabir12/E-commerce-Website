<?php include('header.php'); ?>


<div class="container-fluid">
  <div class="row">
    <?php include('sidebar.php'); ?>
    <div class="col-md-9 content">
      <h2>Create Product</h2>

      <form method="POST" enctype="multipart/form-data" action="create_product.php">
      <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
        <div class="form-group">

            <input type="hidden" class="form-control" name="product_id" value="">
          <label for="productName">Title</label>
          <input type="text" class="form-control" name="product_name" value="" id="productName" placeholder="Enter product name">
        </div>
        <div class="form-group">
          <label for="productName">Description</label>
          <input type="text" class="form-control" name="description" value="" id="productName" placeholder="Enter product description">
        </div>
        <div class="form-group">
          <label for="productPrice">Price</label>
          <input type="text" class="form-control" name="price" value="" id="productPrice" placeholder="Enter price">
        </div>
        <div class="form-group">
          <label for="productName">Category</label>
          <input type="text" class="form-control" name="category" value="" id="productName" placeholder="product category">
        </div>
        <div class="form-group">
          <label for="productName">Color</label>
          <input type="text" class="form-control" name="color" value="" id="productName" placeholder="product color">
        </div>
        <div class="form-group">
          <label for="productName">Special Offer/Sale</label>
          <input type="text" class="form-control" name="offer" value="" id="productName" placeholder="sales %">
        </div>
        <div class="form-group">
          <label for="productName">Image 1</label>
          <input type="file" class="form-control" name="image1" value="" id="image1" placeholder="Image 1">
        </div>
        <div class="form-group">
          <label for="productName">Image 2</label>
          <input type="file" class="form-control" name="image2" value="" id="image2" placeholder="Image 2">
        </div>
        <div class="form-group">
          <label for="productName">Image 3</label>
          <input type="file" class="form-control" name="image3" value="" id="image3" placeholder="Image 3">
        </div>
        <div class="form-group">
          <label for="productName">Image 4</label>
          <input type="file" class="form-control" name="image4" value="" id="image4" placeholder="Image 4">
        </div>
        <button type="submit" name="create_product" class="btn btn-primary">Create</button>

      </form>
    </div>
  </div>
</div>
</body>
</html>
