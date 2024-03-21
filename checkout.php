<?php include('layouts/header.php') ?>

<?php

if(!empty($_SESSION['cart']) ){
//let user in 


//send user to home page
}else{
    header('location: index.php');
}

?>

      <!-- checkout -->
      <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Check Out</h2>
            <hr>
        </div>
            
                <div class="mx-auto container">
                    <form action="server/place_order.php" method="post" id="checkout-form">
                        <p class="text-center" style="color: red;">
                        <?php if(isset($_GET['message'])){ echo $_GET['message']; } ?>
                        <?php if(isset($_GET['message'])) { ?>
                            <a href="login.php" class="btn btn-primary">Login</a>

                            <?php } ?>
                    </p>
                        
                        <div class="form-group checkout-small-element">
                            <label for="">Name</label>
                            <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group checkout-small-element">
                        <label for="">Email</label>
                        <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group checkout-small-element">
                        <label for="">Phone</label>
                        <input type="phone" class="form-control" id="checkout-phone" name="phone" placeholder="Phone" required>
                    </div>
                    <div class="form-group checkout-small-element">
                        <label for="">City</label>
                        <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required>
                    </div>
                    <div class="form-group checkout-large-element">
                        <label for="">Address</label>
                        <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required>
                    </div>
                    <div class="form-group checkout-btn-container">
                        <p>Total Amount : $ <?php echo $_SESSION['total']; ?></p>
                        <input type="submit" class="btn" id="checkout-btn" name="place_order" value="place order" >
                    </form>
                    
                </div>
           
      </section>



      <?php include('layouts/footer.php') ?>