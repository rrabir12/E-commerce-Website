<?php include('layouts/header.php') ?>

<?php

if(isset($_POST['order_pay_btn'])){
  $order_status=$_POST['order_status'];
  $total_order_price=$_POST['total_order_price'];
}


?>

      <!-- payment -->
      <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Payment</h2>
            <hr>
        </div>
            <div class="mx-auto container text-center">


            <?php if(isset($_POST['order_status']) && $_POST['order_status'] == "not paid") { ?>
              <?php $amount=strval($_POST['total_order_price']); ?>
              <?php $order_id = $_POST['order_id']; ?>
              <p>Total payment: $ <?php echo $_POST['total_order_price']; ?></p>
              <!-- <input type="submit" class="btn btn-primary" value="Pay Now"> -->

               <!-- Set up a container element for the button -->
              <div id="paypal-button-container"></div>

            
            <?php } else if(isset($_SESSION['total']) && $_SESSION['total'] != 0) { ?>
              <?php $amount=strval($_SESSION['total']); ?>
              <?php $order_id = $_SESSION['order_id']; ?>
              <p>Total payment : $ <?php echo $_SESSION['total']; ?></p>
              <!-- <input type="submit" class="btn btn-primary" value="Pay Now"> -->

               <!-- Set up a container element for the button -->
              <div id="paypal-button-container"></div>

            

            <?php } else { ?>
              <p>You don't have an order</p>
            <?php } ?>
                    
                </div>
        </section>


      <!-- Replace "test" with your own sandbox Business account app client ID -->
    <script src="https://www.paypal.com/sdk/js?client-id=AVWKCAYW_1VE5zOoWg--mU0nt3FgdnoK89Ikxp66BlXlMlTQPYUdtRu3qEVaMRG3ysq2FP3Yw_QLwBXe&currency=USD"></script>

   

    <script>
      paypal.Buttons({
        createOrder: function(data, actions){
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '<?php echo $amount; ?>'
              }
            }]
          });
        },

        onApprove: function(data, actions){
          return actions.order.capture().then(function(orderData)
          {
            console.log('capture result',orderData, JSON.stringify(orderData, null, 2));
            var transaction = orderData.purchase_units[0].payments.captures[0];
            alert('Transaction'+ transaction.status + ': ' + transaction.id + '\n\nSee console for all variable details');

            window.location.href = "server/complete_payment.php?transaction_id=" + transaction.id + "&order_id=" + <?php echo $order_id; ?>;
          });
        }
      }).render('#paypal-button-container');
      </script>



      <!-- footer -->
      <?php include('layouts/footer.php') ?>