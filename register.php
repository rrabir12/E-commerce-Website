<?php include('layouts/header.php') ?>

<?php
include('server/connect.php');

if(isset($_SESSION['register'])){
    header('location: login.php');
    exit;
}

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
 
    //if password don't match
    if($password !== $confirmpassword){
        header('location: register.php?error=password_dont_match');    
    }

    //if password is less than 6 character
    elseif(strlen($password) < 6){
        header('location: register.php?error=password_must_be_at_least_6_character');
    }

    //if there is no error
    else{
        //check whether there is a user with this email or not
        $stm1 = $conn->prepare("SELECT count(*) FROM users where user_email=?");
        $stm1->bind_param('s', $email);
        $stm1->execute();
        $stm1->bind_result($num_rows);
        $stm1->store_result();
        $stm1->fetch();

        //if there is a user already registered with this email
        if($num_rows != 0){
            header('location: register.php?error=user_with_this_email_already_exist');
        }

        //if no user registered with this email before
        else{
            //create a new user
            $stm = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)");

            $stm->bind_param('sss', $name, $email, $password);

            if($stm->execute()){
                $user_id=$stm->insert_id;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['register'] = true;
                header('location: login.php?register_success=you_register_successfully_you_can_login_now');
                exit;
            }
            //account cannot be created
            else{
                header("location: register.php?error=couldn't_create_an_account_at_the_moment");
                exit;
            }
        }
    }
}

?>


      <!-- Register -->
      <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Register</h2>
            <hr>
        </div>
            
                <div class="mx-auto container">
                    <form id="register-form" method="POST" action="register.php">
                        <p style="color : red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" class="form-control" id="register-confirm-password" name="confirmpassword" placeholder="confirm Password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn" name="register" id="register-btn" value="Register" >
                    </form>
                    <div class="form-group">
                        <a href="login.php" class="btn" id="login-url">Do you have an account ? Login</a>
                    </form>
                </div>
           
      </section>



        <!-- footer -->
<?php include('layouts/footer.php') ?>