<?php

session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="assets/css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<style>
     h1{
    font-size: 2.5rem;
    font-weight: 700;
}
h2{
    font-size: 1.8rem;
    font-weight: 600;
}
h3{
    font-size: 1.5rem;
    font-weight: 800;
}
h4{
    font-size: 1rem;
    font-weight: 600;
}
h5{
    font-size: 1rem;
    font-weight: 400;
}
h6{
    color: #d8d8d8;
}
hr {
        width: 30px;
        height: 3px !important;
        opacity: 1 !important;
        background-color: goldenrod;
        margin-left: 49%;
    }
</style>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container">
          <img class="logo" src="assets/imgs/logo.jpg" alt="">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse nav" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="shop.php">Shop</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact Us</a>
              </li>

              <li class="nav-item">
                <a href="cart.php"><i class=" fa fa-shopping-cart">
                <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) { ?>
                  <span class="cart_quantity"><?php echo count($_SESSION['cart']); ?></span>
                <?php } ?>
                </i></a>
               <a href="account.php"><i class="fa fa-user"></i></a> 
              </li>

              

            </ul>
          </div>
        </div>
      </nav>