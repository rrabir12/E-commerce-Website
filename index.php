<?php include('layouts/header.php') ?>
     
      <!-- Home -->
      <section id="home">
        <div class="container">
            <h5>NEW ARRIVALS</h5>
            <h1><span>Best Prices</span> This Season</h1>
            <p>Eshop offers the best product for the most affordable price</p>
            <button>Shop Now</button>
        </div>
      </section>

      <!-- brand -->
      <section id="brand" class="container mt-5 py-5 text-center">
        <h3>Our brands</h3><hr>
         <div class="row  ">
            
            <img src="assets/imgs/brand1.jpg" class="img-fluid col-lg-3 col-md-6 col-sm-12" alt="">
            <img src="assets/imgs/brand2" class="img-fluid col-lg-3 col-md-6 col-sm-12" alt="">
            <img src="assets/imgs/brand3.png" class="img-fluid col-lg-3 col-md-6 col-sm-12" alt="">
            <img src="assets/imgs/brand4.svg" class="img-fluid col-lg-3 col-md-6 col-sm-12" alt=""> 
         </div>
    </section>

    <!-- NEW -->
    <section id="new" class="w-100 mt-3 py-3 text-center">
        <h3 >New Arrivals</h3>
        <hr>
        <p>Here's our new products</p>
        <div class="row p-0 m-0">
          <div class="one col-lg-4 col-md-8 col-sm-12 p-3">
            <img src="assets/imgs/shoes.jpg" class="img-fluid" alt="">
            <div class="details">
                <h2>Extremely Awesome Shoes</h2>
                <button class="text-uppercase">shop now</button>
            </div>
          </div>

    <!-- two -->
    <div class="one col-lg-4 col-md-8 col-sm-12 p-0">
        <img src="assets/imgs/jackets.webp" class="img-fluid" alt="">
        <div class="details">
            <h2>Awesome jackets</h2>
            <button class="text-uppercase">shop now</button>
        </div>
      </div>

      <!-- three -->
      <div class="one col-lg-4 col-md-8 col-sm-12 p-0">
        <img src="assets/imgs/watches.webp" class="img-fluid" alt="">
        <div class="details">
            <h2>50% off watches</h2>
            <button class="text-uppercase">shop now</button>
        </div>
      </div>

        </div>
    </section>

    <!-- featured -->
    <section id="feature" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h3>Our Features</h3>
            <hr>
            <p>Here, you can check our features product</p>
        </div>
        <div class="row mx-auto container-fluid">
        <?php include('server/get_featured_product.php'); ?>

<?php while($row=$featured_products->fetch_assoc()){ ?>
    <div class="products text-center col-lg-3 col-md-4 col-sm-12">
        <img src="assets/imgs/<?php echo $row['product_image']; ?>" class="img-fluid" alt="">
        <div class="star">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
        <h5 class="pname"><?php echo $row['product_name']; ?></h5>
        <h4 class="pprice">$ <?php echo $row['product_price']; ?></h4>
        <a href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
    </div>
 <?php } ?>
        </div>
    </section>

    <!-- banner -->
    <section id="banner" class="my-4">
        <div class="container">
            <h4>MID SEASON'S SALE</h4>
            <h1>Autum collection<br/>UP to 30% OFF</h1>
            <button class="text-uppercase">Shop Now</button>
        </div>
    </section>

    <!-- clothes -->
    <section id="feature" class="my-4">
        <div class="container text-center mt-5 py-5">
            <h3>Dresses and Coats</h3>
            <hr>
            <p>Here, you can check our amazing clothes</p>
        </div>
        <div class="row mx-auto container-fluid">

        <?php include('server/get_coats.php'); ?>

       <?php while($row=$coats_products->fetch_assoc()){ ?>

            <div class="products text-center col-lg-3 col-md-4 col-sm-12">
                <img src="assets/imgs/<?php echo $row['product_image']; ?>" class="img-fluid" alt="">
                <div class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <h5 class="pname"><?php echo $row['product_name']; ?></h5>
                <h4 class="pprice">$ <?php echo $row['product_price']; ?></h4>
                <a href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
            </div>
        <?php } ?>
        </div>
    </section>

    <!-- shoes -->
    <section id="feature" class="">
        <div class="container text-center ">
            <h3>Shoes</h3>
            <hr>
            <p>Here, you can check our amazing shoes</p>
        </div>
        <div class="row mx-auto container-fluid">

        <?php include('server/get_shoes.php'); ?>

        <?php while($row=$shoes->fetch_assoc()){ ?>

            <div class="products text-center col-lg-3 col-md-4 col-sm-12">
            <img src="assets/imgs/<?php echo $row['product_image']; ?>" class="img-fluid" alt="">
                <div class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <h5 class="pname"><?php echo $row['product_name']; ?></h5>
                <h4 class="pprice">$ <?php echo $row['product_price']; ?></h4>
                <a href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
            </div>

            <?php } ?>
           
        </div>
    </section>

    <!-- watches -->
    <section id="feature" class="">
        <div class="container text-center">
            <h3>Watches</h3>
            <hr>
            <p>Here, you can check our amazing watches</p>
        </div>
        <div class="row mx-auto container-fluid">

        <?php include('server/get_watches.php'); ?>

        <?php while($row=$watches->fetch_assoc()){ ?>

            <div class="products text-center col-lg-3 col-md-4 col-sm-12">
            <img src="assets/imgs/<?php echo $row['product_image']; ?>" class="img-fluid" alt="">
                <div class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <h5 class="pname"><?php echo $row['product_name']; ?></h5>
                <h4 class="pprice">$ <?php echo $row['product_price']; ?></h4>
                <a href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
            </div>

            <?php } ?>
            
        </div>
    </section>

  <?php include('layouts/footer.php') ?>