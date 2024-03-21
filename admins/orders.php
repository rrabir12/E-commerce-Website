<!-- <?php 

include('../server/connect.php');

 //determine page no.
 if(isset($_GET['page_no']) && $_GET['page_no'] !=""){
    //if user has already entered page num is the ont that they selected
    $page_no=$_GET['page_no'];
}else{
    $page_no=1;
}

//return no. of products
$stm1=$conn->prepare("SELECT COUNT(*) As total_records FROM orders");
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
$stm2=$conn->prepare("SELECT * FROM orders LIMIT $offset,$total_records_per_page");
$stm2->execute();
$orders=$stm2->get_result();


?> -->


<?php include('header.php'); ?>

<body>

<div class="container-fluid">
  <div class="row">
    
   <?php include('sidebar.php'); ?>
  
   <div class="col-md-9 content">
      <h2>Orders</h2>

      <?php if(isset($_GET['edit_success_message'])) { ?>
        <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_message']; ?></p>
      <?php } ?>

      <?php if(isset($_GET['edit_failure_message'])) { ?>
        <p class="text-center" style="color: red;"><?php echo $_GET['edit_failure_message']; ?></p>
      <?php } ?>
      
      <table class="table">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Order status</th>
            <th>User Id</th>
            <th>Order date</th>
            <th>User phone</th>
            <th>User Address</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

    <?php foreach($orders as $order) { ?>
        <tr>
            <td><?php echo $order['order_id']; ?></td>
            <td><?php echo $order['order_status']; ?></td>
            <td><?php echo $order['user_id']; ?></td>
            <td><?php echo $order['order_date']; ?></td>
            <td><?php echo $order['user_phone']; ?></td>
            <td><?php echo $order['user_address']; ?></td>
            <td>
            <a class="btn btn-primary mb-2" href="edit_order.php?order_id=<?php echo $order['order_id']; ?>">Edit</a>
                <!-- <button class="btn btn-sm btn-danger">Delete</button> -->
            </td>
        </tr>
     <?php } ?>

    </tbody>
</table>
<nav class="pagination" aria-label="page navigation example">
                            <ul class="pagination ">
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

