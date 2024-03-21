<?php include('layouts/header.php') ?>

<?php 

include('server/connect.php');

if(isset($_GET['product_id'])){

    $product_id=$_GET['product_id'];

    $stm=$conn->prepare("select * from products where product_id = ?");
    $stm->bind_param("i",$product_id);

    $stm->execute();

    $product = $stm->get_result();
}else{
    header('location:index.php');
}

?>
      
<!-- single product  -->
      <section class="single-product container my-5 pt-5">
        <div class="row mt-5">

        <?php while($row=$product->fetch_assoc()) { ?>

           <div class="col-lg-5 col-md-6 col-sm-12">
            <img class="img-fluid w-100 pb-1" src="assets/imgs/<?php echo $row['product_image']; ?>" id="mainImg" alt="">
            <div class="small-img-group">
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image']; ?>" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image2']; ?>" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image3']; ?>" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image4']; ?>" width="100%" class="small-img" alt="">
                </div>
            </div>
           </div>

           <div class="col-lg-6 col-md-12 col-sm-12">
            <h6>Men/Shoes</h6>
            <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
            <h2>$ <?php echo $row['product_price']; ?></h2>

            <form method="POST" action="cart.php" >
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">

                <input type="number" name="product_quantity" value="1" />
            <button class="buy-btn" type="submit" name="add_to_cart">Add To Cart</button>
            </form>

            <h4 class="mt-5 mb-5">Product details</h4>
            <span><?php echo $row['product_description']; ?>
            </span>
           </div>

           <?php } ?>

        </div>
    </section>

      <!-- Related products -->
      <section id="related-products" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Related Products</h3>
            <hr>
            
        </div>
        <div class="row mx-auto container-fluid">
            <div class="products text-center col-lg-3 col-md-4 col-sm-12">
                <img src="assets/imgs/f1.webp" class="img-fluid" alt="">
                <div class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <h5 class="pname">Sports Shoes</h5>
                <h4 class="pprice">Rs.1500</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="products text-center col-lg-3 col-md-4 col-sm-12">
                <img src="assets/imgs/f2.jpg" class="img-fluid" alt="">
                <div class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <h5 class="pname">lady bag</h5>
                <h4 class="pprice">Rs.2500</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="products text-center col-lg-3 col-md-4 col-sm-12">
                <img src="assets/imgs/f3.jpg" class="img-fluid" alt="">
                <div class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <h5 class="pname">Nike bag</h5>
                <h4 class="pprice">Rs.2000</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="products text-center col-lg-3 col-md-4 col-sm-12">
                <img src="assets/imgs/f4.jpg" class="img-fluid" alt="">
                <div class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <h5 class="pname">Nice jacket</h5>
                <h4 class="pprice">Rs.3000</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
        </div>
    </section>


       <!-- footer -->
    <script>
      var mainImg = document.getElementById("mainImg");
      var smallimg = document.getElementsByClassName("small-img");

      for(let i=0;i<4;i++){
        smallimg[i].onclick = function(){
        mainImg.src=smallimg[i].src;
      }
      }

    </script>
<?php include('layouts/footer.php') ?>