

   
    <!-- Sidebar -->
    <div class="col-md-3 sidebar">
    <a href="#"><img class="logo" src="../assets/imgs/logo.jpg" style="margin-left:38%; height: 15%; width: 25%;" alt=""></a>
    <a href="admin_index.php" class="dashboard"><h2>Admin Dashboard</h2></a>
      <ul class="list-group">
        <li class="list-group-item"><a href="orders.php">Orders</a></li>
        <li class="list-group-item"><a href="products.php">Products</a></li>
        <li class="list-group-item"><a href="account.php">Accounts</a></li>
        <li class="list-group-item"><a href="add_product.php">Add New Product</a></li>
        <li class="list-group-item"><a href="help.php">Help</a></li>

        <?php if(isset($_SESSION['admin_logged_in'])) { ?>
      <li class="list-group-item"><a href="logout.php?logout=1">Logout</a></li>
      <?php } ?>
      </ul>
    </div>
