<?php include('header.php'); ?>

<div class="container-fluid">
  <div class="row">
    <?php include('sidebar.php'); ?>
    <div class="col-md-9 content">
      <h2>Admin Account</h2>

     <p>Id: <?php echo $_SESSION['admin_id'] ?></p>
     <p>Name: <?php echo $_SESSION['admin_name'] ?></p>
     <p>Email: <?php echo $_SESSION['admin_email'] ?></p>

    </div>
  </div>
</div>
</body>
</html>
