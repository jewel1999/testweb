<?php 
    session_start();
    require_once "connect_db.php";
    if(isset($_POST['printer_update'])){
        $id = $_POST['id'];
        $printer_sn = $_POST['printer_sn'];
        $printer_name = $_POST['printer_name'];
        $printer_owner = $_POST['printer_owner'];
        $printer_status  = $_POST['printer_status'];

                
                if(!isset($_SESSION['error'])){
                    $sql = $conn->prepare("UPDATE printers SET printer_sn=:printer_sn,printer_name=:printer_name,
                    printer_owner=:printer_owner,printer_status=:printer_status WHERE id=:id ");
                    $sql->bindParam(":id",$id);
                    $sql->bindParam(":printer_sn",$printer_sn);
                    $sql->bindParam(":printer_name",$printer_name);
                    $sql->bindParam(":printer_owner",$printer_owner);
                    $sql->bindParam(":printer_status",$printer_status);
                    $sql->execute();

                    $_SESSION['success'] = "Update sucessfully! " ;
                    header("location: user_printer.php");     
                }else {
                    $_SESSION['error'] = "Update unsucessfully! " ;
                    header("location: user_printer.php");
                }
                 
        
        }

?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printer edit : admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .container{
            max-width:550px;
        }
    </style>

</head>
<body>

  <div class="container mt-6"> 

        <!-- insert into data forms  -->   
        <div class="modal-body">  
            <form action="user_edit_printer.php" method="post" enctype="multiplepart/form-data">
                <?php 
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $stmt = $conn->query("SELECT * FROM printers WHERE id = $id");
                        $stmt->execute();
                        $data = $stmt->fetch();
                    }
                ?>

            
            <div class="mb-3">
                <label  class="col-form-label">Printer id :</label>
                <input type="text" readonly value="<?= $data['id']?>" class="form-control" name="id">    
            </div>
            <div class="mb-3">
                <label for="printer_sn" class="col-form-label">Printer serial-number :</label>
                <input type="text" value="<?= $data['printer_sn']?>" class="form-control" name="printer_sn">
            </div>
            <div class="mb-3">
                <label for="printer_name" class="col-form-label">Printer name :</label>
                <input type="text" value="<?= $data['printer_name']?>" class="form-control" name="printer_name">
            </div>
            <div class="mb-3">
                <label for="printer_owner" class="col-form-label">Printer owner :</label>
                <input type="text" value="<?= $data['printer_owner']?>" class="form-control" name="printer_owner">
            </div>
            <div class="mb-3">
                <label for="printer_status" class="col-form-label">Status :</label>
                <input type="text"  value="<?= $data['printer_status']?>" class="form-control" name="printer_status">
            </div>

            <div class="modal-footer">
            <a type="button" class="btn btn-secondary" href="user_printer.php">Close</a>
        </div>
            </form>
           
        </div> 
      