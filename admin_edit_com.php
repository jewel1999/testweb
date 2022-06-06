<?php 
    session_start();
    require_once "connect_db.php";
    if(isset($_POST['com_update'])){
        $id = $_POST['id'];
        $com_sn = $_POST['com_sn'];
        $com_name = $_POST['com_name'];
        $com_owner = $_POST['com_owner'];
        $com_status  = $_POST['com_status'];

                
                if(!isset($_SESSION['error'])){
                    $sql = $conn->prepare("UPDATE computers SET com_sn=:com_sn,com_name=:com_name,
                    com_owner=:com_owner,com_status=:com_status WHERE id=:id ");
                    $sql->bindParam(":id",$id);
                    $sql->bindParam(":com_sn",$com_sn);
                    $sql->bindParam(":com_name",$com_name);
                    $sql->bindParam(":com_owner",$com_owner);
                    $sql->bindParam(":com_status",$com_status);
                    $sql->execute();

                    $_SESSION['success'] = "Update sucessfully! " ;
                    header("location:admin_com.php");     
                }else {
                    $_SESSION['error'] = "Update unsucessfully! " ;
                    header("location:admin_com.php");
                }
                 
        
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computers edit : admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .container{
            max-width:550px;
        }
    </style>

</head>
<body>

  <div class="container mt-6"> 
        <div class="modal-body">  <-- insert into data forms  -->   
            <form action="admin_edit_com.php" method="post" enctype="multiplepart/form-data">
                <?php 
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $stmt = $conn->query("SELECT * FROM computers WHERE id = $id");
                        $stmt->execute();
                        $data = $stmt->fetch();
                    }
                ?>

            
            <div class="mb-3">
                <label  class="col-form-label">Compuster id :</label>
                <input type="text" readonly value="<?= $data['id']?>" class="form-control" name="id">    
            </div>
            <div class="mb-3">
                <label for="com_sn" class="col-form-label">Compuster serial-number :</label>
                <input type="text" value="<?= $data['com_sn']?>" class="form-control" name="com_sn">
            </div>
            <div class="mb-3">
                <label for="com_name" class="col-form-label">Compuster name :</label>
                <input type="text" value="<?= $data['com_name']?>" class="form-control" name="com_name">
            </div>
            <div class="mb-3">
                <label for="com_owner" class="col-form-label">Compuster owner :</label>
                <input type="text" value="<?= $data['com_owner']?>" class="form-control" name="com_owner">
            </div>
            <div class="mb-3">
                <label for="com_status" class="col-form-label">Status :</label>
                <input type="text"  value="<?= $data['com_status']?>" class="form-control" name="com_status">
            </div>

            <div class="modal-footer">
            <a type="button" class="btn btn-secondary" href="admin_com.php">Close</a>
            <button type="submit" name="com_update" class="btn btn-success"  >Update</button>
        </div>
            </form>
           
        </div>
      
