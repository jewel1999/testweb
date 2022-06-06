<?php
    session_start();
    require_once 'connect_db.php';

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $deletestmt = $conn->query("DELETE FROM printers WHERE id = $delete_id");
        $deletestmt->execute();

        if($deletestmt){
            echo"<script> alert('data hasbeen deleted successfully ');  </script>";
            $_SESSION['success']="data has been deleted sccessfully";
            header("refresh:1; url=admin_printer.php");
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computers information : admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <div class="modal fade" id="UserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Insert Printer</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>    

        <div class="modal-body">          
            <form action="admin_insert_printer.php" method="post" enctype="multiplepart/form-data">
            <div class="mb-3">
                <label for="printer_sn" class="col-form-label">Printer serial-number :</label>
                <input type="text" class="form-control" name="printer_sn">
            </div>
            <div class="mb-3">
                <label for="printer_name" class="col-form-label">Printer name :</label>
                <input type="text" class="form-control" name="printer_name">
            </div>
            <div class="mb-3">
                <label for="printer_owner" class="col-form-label">Printer owner :</label>
                <input type="text" class="form-control" name="printer_owner">
            </div>
            <div class="mb-3">
                <label for="printer_status" class="col-form-label">Status </label>
                <input type="text" class="form-control" name="printer_status">
            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="printer_insert" class="btn btn-success">Submit</button>
        </div>
            </form>
           
        </div>
        
        </div>
    </div>
    </div>

    <!-- -------------------------- table section-------------------------- -->

    
    <div class="container mt-3">
    <div class="md-4  d-flex ">
                <a href="admin.php" type="button" class="btn btn-dark" >back</a >
            </div>
            <br>
        <div class="row">
            <div class="col-md-6">
                    <h1> Printer information </h1>
            </div>
            <div class="col-md-6  d-flex justify-content-end">
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#UserModal">Insert Printer</button>
            </div>

        </div>
        <hr>
        <br>
        <?php if(isset($_SESSION['success'])) { ?>   <?php ?>
                <div class="alert alert-success" role="alert">  
            <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']); ?>
                </div>
            <?php } ?>

            <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">  
                <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']); ?>
                    </div>
                <?php } ?>


    <!--  --------------User data---------------------- -->
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">printner serial-number</th>
            <th scope="col">printer name</th>
            <th scope="col">owner</th>
            <th scope="col">status</th>
            <th scope="col">created time</th>
            <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $stmt =$conn->query("SELECT * FROM printers");
                $stmt->execute(); 
                $printer_table = $stmt->fetchALL();

                if(!$printer_table){
                    echo"<tr> <td colpan='6' class='text-center'> No data found </td> </tr>";
                }else{
                    foreach  ($printer_table as $printer) {   // foreach = loop data in table
            ?>
            <tr>
                <th scope="row"><?php echo $printer['id']; ?> </th>
                <td><?php echo $printer['printer_sn']; ?>     </td>
                <td><?php echo $printer['printer_name']; ?>   </td>
                <td><?php echo $printer['printer_owner']; ?>  </td>
                <td><?php echo $printer['printer_status']; ?> </td>
                <td><?php echo $printer['create_at']; ?>      </td>       
                
                <td>
                     <a href="admin_edit_printer.php ?id=<?= $printer['id']; ?>"  class="btn btn-warning">Edit</a>
                     <a href="?delete=<?= $printer['id']; ?>"  class="btn btn-danger" onclick="return confirm('are you sure to delete ?')" >Delete</a>
                </td>    
            </tr>
        <?php }} ?>   
        </tbody>
    </table>
            
</div>
            
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
</body>
</html>