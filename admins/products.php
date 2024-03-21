<?php 

include('../server/connect.php');

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
$total_records_per_page=5;
$offset=($page_no-1) * $total_records_per_page;
$previous_page=$page_no-1;
$next_page=$page_no+1;
$adjacents="2";
$total_no_of_pages=ceil($total_records/$total_records_per_page);

//get all products
$stm2=$conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
$stm2->execute();
$products=$stm2->get_result();


?>


<?php include('header.php'); ?>

<body>

<div class="container-fluid">
  <div class="row">
    
   <?php include('sidebar.php'); ?>
  
   <div class="col-md-9 content">
      <h2>Products</h2>
 
      <?php if(isset($_GET['edit_success_message'])) { ?>
        <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_message']; ?></p>
      <?php } ?>

      <?php if(isset($_GET['edit_failure_message'])) { ?>
        <p class="text-center" style="color: red;"><?php echo $_GET['edit_failure_message']; ?></p>
      <?php } ?>

      <?php if(isset($_GET['deleted_success'])) { ?>
        <p class="text-center" style="color: green;"><?php echo $_GET['deleted_success']; ?></p>
      <?php } ?>

      <?php if(isset($_GET['deleted_failure'])) { ?>
        <p class="text-center" style="color: red;"><?php echo $_GET['deleted_failure']; ?></p>
      <?php } ?>

      <?php if(isset($_GET['product_created'])) { ?>
        <p class="text-center" style="color: green;"><?php echo $_GET['product_created']; ?></p>
      <?php } ?>

      <?php if(isset($_GET['product_failed'])) { ?>
        <p class="text-center" style="color: red;"><?php echo $_GET['product_failed']; ?></p>
      <?php } ?>

      <?php if(isset($_GET['image_updated'])) { ?>
        <p class="text-center" style="color: green;"><?php echo $_GET['image_updated']; ?></p>
      <?php } ?>

      <?php if(isset($_GET['image_failed'])) { ?>
        <p class="text-center" style="color: red;"><?php echo $_GET['image_failed']; ?></p>
      <?php } ?>

      <table class="table">
    <thead>
        <tr>
            <th scope="col">Product ID</th>
            <th scope="col">Product image</th>
            <th scope="col">Product name</th>
            <th scope="col">product price</th>
            <th scope="col">product offer</th>
            <th scope="col">product category</th>
            <th scope="col">product color</th>
            <th scope="col">Actions</th>
            <th scope="col">Edit images</th>
        </tr>
    </thead>
    <tbody>

    <?php foreach($products as $product) { ?>
        <tr>
            <td><?php echo $product['product_id']; ?></td>
            <td><img src="<?php echo "../assets/imgs/".$product['product_image']; ?>" style="height:70px; width:70px;" alt=""></td>
            <td><?php echo $product['product_name']; ?></td>
            <td><?php echo "$ ".$product['product_price']; ?></td>
            <td><?php echo $product['product_special_offer']."%"; ?></td>
            <td><?php echo $product['product_category']; ?></td>
            <td><?php echo $product['product_color']; ?></td>
            <td>
                <a class="btn btn-primary mb-2" style="width: 80%;" href="edit_product.php?product_id=<?php echo $product['product_id']; ?>">Edit</a>
                <a class="btn btn-danger" href="delete_product.php?product_id=<?php echo $product['product_id']; ?>">Delete</a>
            </td>
            <td><a class="btn btn-warning mb-2"  href="<?php echo "edit_image.php?product_id=".$product['product_id']."&product_name=".$product['product_name']; ?>">Edit images</a></td>
        </tr>
     <?php } ?>

    </tbody>
</table>
<nav aria-label="page navigation example">
                            <ul class="pagination">
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
</div>
</div>
</body>
</html>

