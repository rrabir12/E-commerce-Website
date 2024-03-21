<?php include('layouts/header.php') ?>

<?php

include('server/connect.php');

   //use the search section
if(isset($_POST['search'])){

     //determine page no.
     if(isset($_GET['page_no']) && $_GET['page_no'] !=""){
        //if user has already entered page num is the ont that they selected
        $page_no=$_GET['page_no'];
    }else{
        $page_no=1;
    }

    $category=$_POST['category'];
    $price=$_POST['price'];

    //return no. of products
    $stm1=$conn->prepare("SELECT COUNT(*) As total_records FROM products WHERE product_category=? AND product_price<=?");
    $stm1->bind_param("si",$category,$price);
    $stm1->execute();
    $stm1->bind_result($total_records);
    $stm1->store_result();
    $stm1->fetch();

    //products per page
    $total_records_per_page=8;
    $offset=($page_no-1) * $total_records_per_page;
    $previous_page=$page_no-1;
    $next_page=$page_no+1;
    $adjacents="2";
    $total_no_of_pages=ceil($total_records/$total_records_per_page);

     //get all products
     $stm2=$conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? LIMIT $offset,$total_records_per_page");
     $stm2->bind_param("si",$category,$price);
     $stm2->execute();
     $products=$stm2->get_result();  //it  store an array here


    //return all product
}else{
    
    //determine page no.
    if(isset($_GET['page_no']) && $_GET['page_no'] !=""){
        //if user has already entered page num is the ont that they selected
        $page_no=$_GET['page_no'];
    }else{
        $page_no=1;
    }
    
    //return no. of products
    $stm1=$conn->prepare("SELECT COUNT(*) As total_records FROM products");
    $stm1->execute();
    $stm1->bind_result($total_records);
    $stm1->store_result();
    $stm1->fetch();

    //products per page
    $total_records_per_page=8;
    $offset=($page_no-1) * $total_records_per_page;
    $previous_page=$page_no-1;
    $next_page=$page_no+1;
    $adjacents="2";
    $total_no_of_pages=ceil($total_records/$total_records_per_page);

    //get all products
    $stm2=$conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
    $stm2->execute();
    $products=$stm2->get_result();
}


?>

      <!-- <div class="container"> -->
        <div class="row">
            <!-- Search feature -->
            <div class="col-lg-3">
    <section id="search" class="my-5 py-5 ms-2 ">
       <div class="container mt-5 py-5">
          <p>Search Products</p>
          <hr style="margin-left: 50px;">
       </div>

       <form action="shop.php" method="POST">
        <div class="row mx-auto container">
            <div class="col-lg-12 col-md-12 col-sm-12">
 
                <p>Category</p>
                <div class="form-check">
                    <input type="radio" value="shoes" class="form-check-input" name="category" id="category-one"<?php if(isset($category) && $category=='shoes'){ echo 'checked'; } ?>>
                    <label for="flexRadioDefault1" class="form-check-label">
                        Shoes
                    </label>
                </div>

                <div class="form-check">
                    <input type="radio" value="coats" class="form-check-input" name="category" id="category-two"<?php if(isset($category) && $category=='coats'){ echo 'checked'; } ?>>  
                    <label for="flexRadioDefault2" class="form-check-label">
                        Coats
                    </label>
                </div>

                <div class="form-check">
                    <input type="radio" value="watches" class="form-check-input" name="category" id="category-three"<?php if(isset($category) && $category=='watches'){ echo 'checked'; } ?>> 
                    <label for="flexRadioDefault3" class="form-check-label">
                        Watches
                    </label>
                </div>

                <div class="form-check">
                    <input type="radio" value="bags" class="form-check-input" name="category" id="category-four"<?php if(isset($category) && $category=='bags'){ echo 'checked'; } ?>> 
                    <label for="flexRadioDefault3" class="form-check-label">
                        Bags
                    </label>
                </div>
            </div>
        </div>


        <div class="row mx-auto container mt-5">
            <div class="col-lg-12 col-md-12 col-sm-12">

                <p>Price</p>
                <input type="range" class="form-range w-50" name="price" 
                value="<?php if(isset($price)){ echo $price; }else{ echo "100"; } ?>" min="1" max="1000" id="customRange2">
                <div class="w-50">
                    <span style="float: left;">1</span>
                    <span style="float: right;">1000</span>
                </div>
            </div>
         </div>

         <div class="form-group my-3 mx-3">
            <input type="submit" name="search" value="Search" class="btn btn-primary">
         </div>
         
       </form>
    </section>
</div>
     
<div class="col-lg-9">
    <!-- shop -->
    <section id="feature" class="my-5 py-5">
        <div class="container text-center mt-5 py-5">
            <h3>Our Shop</h3>
            <hr style="margin-left: 440px;">
            <p>Here, you can check our features product for shopping</p>
        </div>
        <div class="row mx-auto container">

        <?php while($row=$products->fetch_assoc()) { ?>

            <div onclick="window.location.href='single_product.html';" class="products text-center col-lg-3 col-md-4 col-sm-12">
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
                <a class="btn buy-btn" href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>">Buy Now</a>
            </div>

            <?php } ?>
            
                        <nav aria-label="page navigation example">
                            <ul class="pagination mt-5">
                              <li class="page-item <?php if($page_no<=1){echo 'disabled';} ?>">
                                <a class="page-link" href="<?php if($page_no <= 1){echo '#';}else{echo "?page_no=".($page_no-1);} ?>">Previous</a>
                            </li>

                              <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                              <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>

                              <?php if($page_no>=3){ ?>
                              <li class="page-item"><a class="page-link" href="#">...</a></li>
                              <li class="page-item"><a class="page-link" href="<?php echo "?page_no=".$page_no; ?>"><?php echo $page_no; ?></a></li>
                              <?php } ?>

                              <li class="page-item <?php if($page_no>=$total_no_of_pages){echo 'disabled';} ?>">
                                 <a class="page-link" href="<?php if($page_no >= $total_no_of_pages){echo '#';}else{echo "?page_no=".($page_no+1);} ?>">Next</a>
                                </li>
                           
                            </ul>
                        </nav>
        </div>
    </section>
</div>
</div>
<!-- </div> -->
      
      <!-- footer -->
<?php include('layouts/footer.php') ?>