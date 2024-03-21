<?php

session_start();
include('../server/connect.php');

if(isset($_SESSION['admin_logged_in'])){
    header('location: admin_index.php');
    exit;
}

if(isset($_POST['login_btn'])){

    $email=$_POST['email'];
    $password=$_POST['password'];

    $stm=$conn->prepare("SELECT admin_id,admin_name,admin_email,admin_password FROM admins WHERE admin_email=? AND admin_password=? LIMIT 1");
    $stm->bind_param('ss',$email,$password);

    if($stm->execute()){
        $stm->bind_result($admin_id,$admin_name,$admin_email,$admin_password);
        $stm->store_result();

        if($stm->num_rows()==1){
            $stm->fetch();

            $_SESSION['admin_id']=$admin_id;
            $_SESSION['admin_name']=$admin_name;
            $_SESSION['admin_email']=$admin_email;
            $_SESSION['admin_logged_in']=true;

            header('location: admin_index.php?login_success=logged in successfully');
            exit;
        }else{
            header('location: admin_login.php?error=could not verify your account');
            exit;
        }
    }else{

        header('location: admin_login.php?error=something went wrong');
        exit;
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>


<body>
    <div class="login-container">
    <a href="#"><img class="logo" src="../assets/imgs/logo.jpg" style="margin-left:38%; height: 15%; width: 25%;" alt=""></a>
        <h2>Login to Admin Dashboard</h2>
        <form action="admin_login.php" method="POST">
        <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
        
            <input type="text" name="email" placeholder="E-mail" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login_btn">Login</button>
        </form>
    </div>

</body>
</html>
