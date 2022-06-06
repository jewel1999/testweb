<?php
    session_start();
    require_once 'connect_db.php';

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $deletestmt = $conn->query("DELETE FROM repair_notices WHERE id = $delete_id");
        $deletestmt->execute();

        if($deletestmt){
            echo"<script> alert('data hasbeen deleted successfully ');  </script>";
            $_SESSION['success']="data has been deleted sccessfully";
            header("refresh:1; url=admin_rn.php");
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Noticse information : admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="modal fade" id="UserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Insert Repair Noticse</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>    

        <div class="modal-body">        
            <form action="admin_insert_rn.php" method="post" enctype="multiplepart/form-data">
            <div class="mb-3">
                <label for="rn_dn" class="col-form-label">Device Name</label>
                <input type="text" class="form-control" name="rn_dn">
            </div>
            <div class="mb-3">
                <label for="rn_no" class="col-form-label">Service No.</label>
                <input type="text" class="form-control" name="rn_no">
            </div>
            <div class="mb-3">
                <label for="rn_date" class="col-form-label">Started date</label>
                <input type="text" class="form-control" name="rn_date">
            </div>
            <div class="mb-3">
                <label for="rn_status" class="col-form-label">Status</label>  <!--[submit -> in process] = rn_status -->
                <input type="text" class="form-control" name="rn_status">
            </div>
            <div class="mb-3">
                <label for="rn_des" class="col-form-label">Description</label> <!-- description -->
                <input type="text" class="form-control" name="rn_des">
            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="rn_insert" class="btn btn-success">Submit</button>
        </div>
            </form>
           
        </div>
        
        </div>
    </div>
    </div>

    <!-- -------------------------- table section-------------------------- -->

    
    <div class="container mt-3">
    <div class="md-4  d-flex ">
                <a href="user.php" type="button" class="btn btn-dark" >back</a >
            </div>
            <br>
        <div class="row">
            <div class="col-md-6">
                    <h1> Repair Notices information </h1>
                    <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" >
                <button class="btn btn-outline-success" type="submit" name="search" >Search</button>
                
            </form> 
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
            <th scope="col">Device Name</th>
            <th scope="col">Service No.</th>
            <th scope="col">Start Date</th>
            <th scope="col">Status</th>
            <th scope="col">Created time</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $stmt =$conn->query("SELECT * FROM repair_notices ");
                $stmt->execute(); 
                $rn_table = $stmt->fetchALL();

                if(!$rn_table){
                    echo"<tr> <td colpan='6' class='text-center'> No data found </td> </tr>";
                }else{
                    foreach  ($rn_table as $rn) {   // foreach = loop data in table
            ?>
            <tr>
                <th scope="row"><?php echo $rn['id']; ?> </th>
                <td><?php echo $rn['rn_dn']; ?>         </td>
                <td><?php echo $rn['rn_no']; ?>         </td>
                <td><?php echo $rn['rn_date']; ?>       </td>
                <td><?php echo $rn['rn_status']; ?>     </td>
                <td><?php echo $rn['create_at']; ?>     </td>       
                
                <td>
                     <a href="user_edit_rn.php?id=<?= $rn['id']; ?>"  class="btn btn-secondary">More</a>
                     
                </td>    
            </tr>
        <?php }} ?>   
        </tbody>
    </table>
            
</div>
            
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
</body>
</html>