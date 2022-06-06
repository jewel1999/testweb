<?php
    session_start();
    require_once 'connect_db.php';

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $deletestmt = $conn->query("DELETE FROM computers WHERE id = $delete_id");
        $deletestmt->execute();

        if($deletestmt){
            echo"<script> alert('data hasbeen deleted successfully ');  </script>";
            $_SESSION['success']="data has been deleted sccessfully";
            header("refresh:1; url=admin_com.php");
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee information : admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <div class="modal fade" id="UserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Insert Employee</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>    

        <div class="modal-body">   <!-- form for insert data -->        
            <form action="admin_emp_insert.php" method="post" enctype="multiplepart/form-data">
            <div class="mb-3">
                <label for="fnameeng" class="col-form-label">Name</label>
                <input type="text" class="form-control" name="fnameeng">
            </div>
            <div class="mb-3">
                <label for="lnameeng" class="col-form-label">Lastname :</label>
                <input type="text" class="form-control" name="lnameeng">
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
                <label for="extn" class="col-form-label">Extn</label>
                <input type="text" class="form-control" name="extn">
            </div>

            <div class="mb-3">
                <label for="phonenumber" class="col-form-label">Phonenumber</label>
                <input type="text" class="form-control" name="phonenumber">
            </div>
            <div class="mb-3">
                <label for="station" class="col-form-label">Station</label>
                <input type="text" class="form-control" name="station">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="admin_emp_insert" class="btn btn-success">submit</button>
        </div>
            </form>
           
        </div>
        
        </div>
    </div>
    </div>

    <!-- -------------------------- table section-------------------------- -->

    
    <div class="container mt-3">
    <div class="md-4  d-flex ">
                <a href="admin.php" type="button" class="btn btn-dark" > back</a >
            </div>
            <br>
        <div class="row">
            <div class="col-md-6">
                    <h1> Employee information </h1>
            </div>
            <div class="col-md-6  d-flex justify-content-end">
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#UserModal">Insert Employee </button>
            </div>

        </div>
        <hr>
        <br>
        <?php if(isset($_SESSION['success'])) { ?>   
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
            <th scope="col">emplonee id :</th>
            <th scope="col">exployee name</th>
            <th scope="col">department</th>
            <th scope="col">floor</th>
            <th scope="col">phone</th>
            <th scope="col">extn</th>
            <th scope="col">action</th>

            </tr>
        </thead>
        <tbody>
            <?php 
                $stmt =$conn->query("SELECT * FROM users");
                $stmt->execute(); 
                $users_table = $stmt->fetchALL();

                if(!$users_table){
                    echo"<tr> <td colpan='6' class='text-center'> No data found </td> </tr>";
                }else{
                    foreach  ($users_table as $users) {   // foreach = loop data in table
            ?>
            <tr>
                <th scope="row"><?php echo $users['id']; ?> </th>
                <td><?php echo $users['employee_id']; ?>     </td>
                <td><?php echo $users['fnameeng']; $users['lnameeng'];  ?> </td>
                <td><?php echo $users['nickname']; ?>  </td>
                <td><?php echo $users['floor']; ?> </td>
                <td><?php echo $users['department']; ?> </td>
                <td><?php echo $users['usermail']; ?>  </td>  
                <td><?php echo $users['phonenumber']; ?>  </td>     
                <td><?php echo $users['extn']; ?>  </td>          
                <td> 
                    
                     <a href="admin_edit_com.php?id=<?= $users['id']; ?>"  class="btn btn-warning">Edit</a>
                     <a href="?delete=<?= $users['id']; ?>"  class="btn btn-danger" onclick="return confirm('are you sure to delete ?')" >Delete</a>
                </td>    
            </tr>
        <?php }} ?>   
        </tbody>
    </table>
            
</div>
            
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
</body>
</html>