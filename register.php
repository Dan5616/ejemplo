<?php
      include_once('dbconec.php'); 

$error = false;
if(isset($_POST['btn-register'])){
    $username = $_POST['username'];
    $username = strip_tags($username);
    $username = htmlspecialchars($username);

    $email = $_POST['email'];
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $password = $_POST['password'];
    $password = strip_tags($password);
    $password =htmlspecialchars($password);

    
    if (empty($username)){
      $error = true;
      $errorUsername = 'Rellena Campo';
    }
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $error = true;
      $errorEmail = 'Introduce un Email valido';
    }

    if(empty($password)){
      $error = true;
      $errorPassword = 'Rellena Campo';
    }elseif(strlen($password) <6){
      $error = true;
      $errorPassword = 'Password debil, Intrdoduzaca un minimo de 6 caracteres';
    }

    $password = md5($password);

    if(!$error){
      echo '';
      $sql = "insert into tbl_user(username, email, password)
                   values('$username', '$email', '$password')";
                   if(mysqli_query($conn, $sql)){
                    $successMsg = 'Registro Exitoso'; 
                   }else{
                    echo 'Error '.mysqli_error($conn);
                   }
    }
}


?>


<html>
<head>
<title> Login  </title>
    <link rel ="stylesheet" href = "assets/css/bootstrap.min.css">
</head>
<body background="Picture/30316.png">
    <div class ="container">
    <div style = "...">
     <form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete = "off">
     <center><h2> Registro </h2></center>
     <hr/>
     <?php
        if(isset($successMsg)){
          ?>

            <div class = "alert alert-success">
            <span class = " glyphicon glyphicon-info-sign"></span>
            <?php echo $successMsg; ?>
            </div>

          <?php
        }
        ?>
     <div class = "form-group">
     <label for = "username" class = "control-label"> Username</label>
     <input type = "text" name = "username" class = "form-control" autocomplete="off">
     <span class = "text-danger"><?php if (isset($errorUsername)) echo $errorUsername; ?></span>   
    </div>
    <div class = "form-group">
    <label for = "email" class = "control-label">Email</label>
    <input type = "email" name = "email" class = "form-control" autocomplete="off">
    <span class = "text-danger"><?php if (isset($errorEmail)) echo $errorEmail; ?></span>
    </div>
        <div class = "form-group">
        <label for = "password" class = "control-label">Password</label>
        <input type = "password" name = "password" class = "form-control" autocomplete="off">
    <span class ="text-danger"><?php if (isset($errorPassword)) echo $errorPassword; ?></span>    
        </div>
          <div class = "form-group">
          <center><input type = "submit" name = "btn-register" value = "Registrate" class = "btn btn-primary"></center>
    </form>
    <hr/>
    <a href = "Index.php">Login</a>
    </div>
    </div>
</body>
</html>