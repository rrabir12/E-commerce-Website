<?php include('layouts/header.php') ?>

<?php

if(isset($_POST['add_to_cart'])){
   
    //if user have already added a product to cart
    if(isset($_SESSION['cart'])){

        $products_array_ids = array_column($_SESSION['cart'],"product_id"); // [2,3,4,5...]
        //if product has already been added to cart or not
        if(!in_array($_POST['product_id'],$products_array_ids)){
        $product_id = $_POST['product_id'];
        $product_array=array(
              
        'product_id'=> $_POST['product_id'],
        'product_name'=>$_POST['product_name'],
        'product_price'=> $_POST['product_price'],
        'product_image'=> $_POST['product_image'],
        'product_quantity'=> $_POST['product_quantity'],
        'product_size' => isset($_POST['product_size']) ? $_POST['product_size'] : '',

        );

        $_SESSION['cart'][$product_id] = $product_array;
        //[ 2=>[]  3=>[] ...]

         //product has already been added
        }else{

            echo '<script>alert("product was already to cart");</script>';
        
        }

    //if this is the first product
    }else{

        $product_id=$_POST['product_id'];
        $product_name=$_POST['product_name'];
        $product_price=$_POST['product_price'];
        $product_image=$_POST['product_image'];
        $product_quantity=$_POST['product_quantity'];
        // $product_size=$_POST['product_size'];

        $product_array=array(
              
        'product_id'=> $product_id,
        'product_name'=> $product_name,
        'product_price'=> $product_price,
        'product_image'=> $product_image,
        'product_quantity'=> $product_quantity,
        // 'product_size'=> $product_size,

        );

        $_SESSION['cart'][$product_id] = $product_array;
        //[ 2=>[]  3=>[] ...]
    }

    //calculate total

    calculateTotalCart();

}else if(isset($_POST['remove_product'])){

    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);

    //calculate total

    calculateTotalCart();

}else if(isset($_POST['edit_quantity'])){
    
    //we get id and quantity from the form
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    //get the product array from the session
    $product_array = $_SESSION['cart'][$product_id];

    //update product quantity
    $product_array['product_quantity']=$product_quantity;

    //return array back its place
    $_SESSION['cart'][$product_id]=$product_array;

    //calculate total

    calculateTotalCart();
}
else{

   // header('location:index.php');
    //echo '<script>alert("product was already to cart");</script>';

}

function calculateTotalCart(){

    $total_price = 0;
    $total_quantity = 0;
    foreach($_SESSION['cart'] as $key => $value){
        $product = $_SESSION['cart'][$key];

        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total_price = $total_price+($price*$quantity);
        $total_quantity = $total_quantity + $quantity;
    }
    $_SESSION['total']=$total_price;
    $_SESSION['quantity']=$total_quantity;
}
?>


      <!-- cart -->
      <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bold text-center">Your cart</h2>
            <hr>
            <table class="mt-5 pt-5">
             <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
             </tr>

             <?php if(isset($_SESSION['cart']) ) { ?>

             <?php 
                    foreach ($_SESSION['cart'] as $key => $value) {
                        ?>
             <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/imgs/<?php echo $value['product_image']; ?>" alt="">
                        <div>
                            <p><?php echo $value['product_name']; ?></p>
                            <p>Size: <?php echo isset($value['product_size']) ? $value['product_size'] : 'N/A'; ?></p> <!-- Display product size or "N/A" if not available -->

                            <small><span>$ </span><?php echo $value['product_price']; ?></small>
                            <br>
                            <form action="cart.php" method="post">
                          <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
                           <input type="submit" name="remove_product" class="remove-btn" value="remove" /> 
                            </form>
                        </div>
                    </div>
                </td>
                <!-- <td>
                <p><?php echo $value['product_size']; ?></p>
                </td> -->
                <td>
                    
                    <form action="cart.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
                    <input type="number" value="<?php echo $value['product_quantity']; ?>" name="product_quantity" />
                   <input type="submit" class="edit-btn" value="Edit" name="edit_quantity" />
                    </form>
                    
                </td>
                <td>
                    <span>$ </span>
                    <span class="product-price"><?php echo $value['product_quantity']*$value['product_price']; ?></span>
                </td>
             </tr>

             <?php } ?>
        
             <?php } ?>

            </table>

           
                <div class="cart-total">
                    <table>
                        
                        <tr>
                            <td>Total</td>
                           <?php if(isset($_SESSION['total'])) { ?>
                            <td>$ <?php echo $_SESSION['total'];  ?></td> 
                            <?php } ?>
                        </tr>
                    </table>
                </div>
               
        </div>
        <div class="checkout-container">
            <form action="checkout.php" method="post">
            <input type="submit" class="btn checkout-btn" name="checkout" value="checkout" />
            </form>
        </div>

      </section>

      <?php include('layouts/footer.php') ?>





   