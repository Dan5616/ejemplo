<?php
session_start();
include_once('dbconec.php');

$error = false;

if(isset($_POST['btn-login'])){
   $email = trim($_POST['email']);
   $email = htmlspecialchars(strip_tags($email));

   $password = trim($_POST['password']);
   $password = htmlspecialchars(strip_tags($password));

   if(empty($email)){
    $error = true;
    $errorEmail = 'Introduce Correo';

   }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error = true;
    $errorEmail = 'Introduce un Correo Valido';

   }

   if(empty($password)){
    $error = true;
    $errorPassword = 'Introduce Password';
   }elseif(strlen($password)< 6){
    $error = true;
    $errorPassword = 'Password menor de 6 caracterees';
   }

   if(!$error){
    $password = md5($password);
    $sql = "select * from tbl_user where email = '$email' ";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    if($count==1 && $row['password'] == $password){ 
      $_SESSION['username'] = $row['username'];
      header('location: Principal.html');
    }else{
      $errorMsg = 'Password o Usuario Invalido';
    }

   }
}

?>


<html>
<head>
<title> Login  </title>
    <link rel ="stylesheet" href = "assets/css/bootstrap.min.css">
</head>
<body background="Picture/fondo_con.jpg">
    <div class ="container">
    <div style = "width: 500px; margin: 50px auto;">
     <form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete = "off">
     <center><h2> Login </h2></center>
     <hr/>
     <?php
      if(isset($errorMsg)){
        ?>
        <div class = "alert alert-danger">
        <span class = "glyphicon glyphicon-info-sign"></span>
        <?php echo $errorMsg; ?>
        </div>
        <?php

      }
     ?>
     
    <div class = "form-group">
    <label for = "email" class = "control-label">Email </label>
    <input type = "email" name = "email" class = "form-control" autocomplete="off">
    <span class = "text-danger"><?php if(isset($errorEmail)) echo $errorEmail; ?></span>
    </div>
        <div class = "form-group">
        <label for = "password" class = "control-label">Password</label>
        <input type = "password" name = "password" class = "form-control" autocomplete="off">
        <span class = "text-danger"><?php if(isset($errorPassword)) echo $errorPassword; ?></span>
        </div>
          <div class = "form-group">
          <center><input type = "submit" name = "btn-login" value = "Login" class = "btn btn-primary"></center>
    </div>
    <hr/>
    <a href = "register.php">Registro</a>
    </form>
    </div>
    </div>
</body>
</html>