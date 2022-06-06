<?php 
    session_start();
    require_once "connect_db.php";
    if(isset($_POST['rn_update'])){
        $id = $_POST['id'];
        $rn_dn = $_POST['rn_dn'];
        $rn_no = $_POST['rn_no'];
        $rn_date = $_POST['rn_date'];
        $rn_status  = $_POST['rn_status'];
        $rn_des = $_POST['rn_des'];

                
                if(!isset($_SESSION['error'])){
                    $sql = $conn->prepare("UPDATE repair_notices SET rn_dn=:rn_dn,rn_no=:rn_no,rn_date=:rn_date,
                    rn_status=:rn_status,rn_des=:rn_des WHERE id=:id ");
                    $sql->bindParam(":id",$id);
                    $sql->bindParam(":rn_dn",$rn_dn);
                    $sql->bindParam(":rn_no",$rn_no);
                    $sql->bindParam(":rn_date",$rn_date);
                    $sql->bindParam(":rn_status",$rn_status);
                    $sql->bindParam(":rn_des",$rn_des);
                    $sql->execute();

                    $_SESSION['success'] = "Update sucessfully! " ;
                    header("location:admin_rn.php");     
                }else {
                    $_SESSION['error'] = "Update unsucessfully! " ;
                    header("location:admin_rn.php");
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
            <form action="admin_edit_rn.php" method="post" enctype="multiplepart/form-data">
                <?php 
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $stmt = $conn->query("SELECT * FROM repair_notices WHERE id = $id");
                        $stmt->execute();
                        $data = $stmt->fetch();
                    }
                ?>

            <div class="mb-3">
                <label  class="col-form-label">id :</label>
                <input type="text" readonly value="<?= $data['id']?>" class="form-control" name="id">    
            </div>
            <div class="mb-3">
                <label for="rn_dn" class="col-form-label">Device Name :</label>
                <input type="text" value="<?= $data['rn_dn']?>" class="form-control" name="rn_dn">
            </div>
            <div class="mb-3">
                <label for="rn_no" class="col-form-label">Service no. :</label>
                <input type="text" value="<?= $data['rn_no']?>" class="form-control" name="rn_no">
            </div>
            <div class="mb-3">
                <label for="rn_date" class="col-form-label">Started date :</label>
                <input type="text" value="<?= $data['rn_date']?>" class="form-control" name="rn_date">
            </div>
            <div class="mb-3">
                <label for="rn_status" class="col-form-label">Status :</label>
                <input type="text"  value="<?= $data['rn_status']?>" class="form-control" name="rn_status">
            </div>
            <div class="mb-3">
                <label for="rn_des" class="col-form-label">Description :</label>
                <input type="text"  value="<?= $data['rn_des']?>" class="form-control" name="rn_des">
            </div>

            <div class="modal-footer">
            <a type="button" class="btn btn-secondary" href="admin_rn.php">Close</a>
            <button type="submit" name="rn_update" class="btn btn-success" >Update</button>
        </div>
            </form>
           
        </div>