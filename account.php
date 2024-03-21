<?php include('layouts/header.php') ?>

<?php

include('server/connect.php');

if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit;
}

if (isset($_GET['logout'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        header('location: login.php');
        exit;
    }
}

if (isset($_POST['change_password'])) {
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirm_password'];
    $user_email = $_SESSION['user_email'];

    if ($password !== $confirmpassword) {
        header('location: account.php?error=password_dont_match');
    }

    //if password is less than 6 character
    elseif (strlen($password) < 6) {
        header('location: account.php?error=password_must_be_at_least_6_character');
    } else {
        //no error
        $stm = $conn->prepare('UPDATE users SET user_password=? WHERE user_email=?');
        $stm->bind_param('ss', $password, $user_email);
        if ($stm->execute()) {
            header('location: account.php?message=password has been updated successfully');
        } else {
            header('location: account.php?error=could not update password');
        }
    }
}

//get order
if (isset($_SESSION['logged_in'])) {

    $user_id = $_SESSION['user_id'];

    $stm = $conn->prepare("SELECT * FROM orders WHERE user_id=? ");

    $stm->bind_param('i',$user_id);

    $stm->execute();

    $orders = $stm->get_result();  //it  store an array here

}

?>


    <!-- Account -->
    <section class="my-5 py-5">
        <Div class="row container mx-auto">

        <?php if(isset($_GET['payment_message'])) { ?>
            <p class="mt-5 text-center" style="color: green;"><?php echo $_GET['payment_message']; ?></p>

        <?php }    ?>

            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
                <p class="text-center" style="color: green; "><?php if (isset($_GET['login_success'])) {
                                                                    echo $_GET['login_success'];
                                                                } ?></p>

                <h3 class="font-weight-bold">Account Info</h3>
                <hr>
                <div class="account-info">
                    <p>Name <span><?php if (isset($_SESSION['user_name'])) {
                                        echo $_SESSION['user_name'];
                                    } ?></span></p>
                    <p>Email <span><?php if (isset($_SESSION['user_email'])) {
                                        echo $_SESSION['user_email'];
                                    } ?></span></p>
                    <p><a href="#orders" id="order-btn">Your order</a></p>
                    <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <form action="account.php" method="post" id="account-form">
                    <p class="text-center" style="color: red; "><?php if (isset($_GET['error'])) {
                                                                    echo $_GET['error'];
                                                                } ?></p>
                    <p class="text-center" style="color: green; "><?php if (isset($_GET['message'])) {
                                                                        echo $_GET['message'];
                                                                    } ?></p>
                    <h3>Change Password</h3>
                    <hr>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" class="form-control" id="account-confirm-password" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="change_password" value="change password" class="btn" id="change-pass-btn">
                    </div>
                </form>
            </div>
        </Div>
    </section>


   <!-- orders -->
<section id="orders" class="orders container my-5 py-3">
    <div class="container mt-2">
        <h2 class="font-weight-bold text-center">Your Orders</h2>
        <hr class="mx-auto">
        <table class="mt-5 pt-5">
            <tr>
                <th>Order id</th>
                <th>Order cost</th>
                <th>Order status</th>
                <th>Date</th>
                <th>Order Details</th>
            </tr>
            <?php while ($row = $orders->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <!-- <div class="product-info">
                            <img src="assets/imgs/f1.webp" alt="">
                            <div>
                                <p class="mt-3"><?php echo $row['order_id']; ?></p>
                            </div>
                        </div> -->
                        <span><?php echo $row['order_id']; ?></span>
                    </td>
                    <td>
                        <span><?php echo $row['order_cost']; ?></span>
                    </td>
                    <td>
                        <span><?php echo $row['order_status']; ?></span>
                    </td>
                    <td>
                        <span><?php echo $row['order_date']; ?></span>
                    </td>
                    <td>
                    <form action="order_details.php" method="POST">
                            <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status">
                            <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
                            <input type="submit" class="btn orders-detail-btn" name="order_details_btn" value="details">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</section>



<?php include('layouts/footer.php') ?>