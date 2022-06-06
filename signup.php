    <?php 
        session_start();
        require_once 'connect_db.php';
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Sign-up</title>
</head>
<body>
<div class="container">
        <br>
        <h1> Register </h1>
        <hr>
        <form action="signup_db.php" method="post">
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

            <?php if(isset($_SESSION['warning'])) { ?>
                <div class="alert alert-warning" role="alert">  
            <?php 
                echo $_SESSION['warning'];
                unset($_SESSION['warning']); ?>
                </div>

            <?php } ?>

        <div class="mb-3">
            <label for="firstname" class="form-label">Firstname</label>
            <input type="text" class="form-control" name="firstname">
        </div>

        <div class="mb-3">
            <label for="lastname" class="form-label">Lastname</label>
            <input type="text" class="form-control" name="lastname">
        </div>

        <div class="mb-3">
        <label for="department" class="form-label">Department</label>
        <select name="department" class="form-select" aria-label="Default select example">
        <option value="" selected >Select Department</option>
        <option value="human-resource">ส่วนงานฝ่ายบุคคล</option>
        <option value="administration">ส่วนงานธุรการ</option>
        <option value="finance">ส่วนงานการเงิน</option>
        <option value="it">ส่วนงานเทคโนโลยีสารสนเทศ</option>
        </select>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="mb-3">
            <label for="confirm password" class="form-label">Confirm Password</label>
            <input type="c_password" class="form-control" name="c_password">    
        </div>
        
       

        <button type="submit" class="btn btn-success" name= "signup" >Submit</button>
        </form>
        <hr>
        <p>Already have an account, Please click here <a href="index.php"> log-in </a> </p>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>