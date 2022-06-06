<?php 
   /*  require_once 'config/connect.php' */
   session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <div class="container">
    <br>
        <h1> Login </h1>
        <hr>
        <form action="login.php" method="post">
            
        <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">  
                <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']); ?>
                    </div>
                <?php } ?>

            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">  
            <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']); ?>
                </div>
            <?php } ?>
    
        <div class="mb-3">
            <label for="email" class="form-label">Email-user </label>
            <input type="email" class="form-control" name="email" aria-describedby="email">
            <div class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="rememberme">
            <label class="form-check-label" for="rememberme">Remember me</label>
        </div>
        
        <button type="submit" class="btn btn-primary" name="login"> login </button>
        </form>
        <hr>
        <p>Don't have an account? Please click here <a href="signup.php"> Sign-up </a> </p>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>