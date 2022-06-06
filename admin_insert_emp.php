<?php 
    session_start();
    require_once "connect_db.php";
    if(isset($_POST['admin_emp_insert'])){

        $id = $_POST['id'];
        $employee_id = $_POST['employee_id'];
        $fnameth = $_POST['fnameth'];
        $lnameth  = $_POST['lnameth'];
        $fnameeng  = $_POST['fnameeng'];
        $lnameeng  = $_POST['lnameeng'];
        $nickname  = $_POST['nickname'];
        $floor  = $_POST['floor'];
        $extn  = $_POST['extn'];
        $password  = $_POST['password'];
        $phonenumber  = $_POST['phonenumber'];
        $sex  = $_POST['sex'];
        $workgroup  = $_POST['workgroup'];
        $department  = $_POST['department'];
        $departmenteng  = $_POST['departmenteng'];
        $roleuser = $_POST['roleuser'];
        $station = $_POST['station'];
        $create_at = $_POST['create_at'];


        if(!isset($_SESSION['error'])){
        try {
            $check_com_sn = $conn->prepare("SELECT employee_id FROM users WHERE employee_id = :employee_id");   // : replace values
            $check_com_sn->bindParam(":employee_id",$employee_id);
            $check_com_sn->execute();
            $row = $check_com_sn->fetch(PDO::FETCH_ASSOC);

                $stmt = $conn->prepare("INSERT INTO users(employee_id,fnameth,lnameth,fnameeng,lnameeng,nickname,
                floor,extn,password,phonenumber,sex,workgroup,department,departmenteng,roleuser,station)
                                        VALUES (:employee_id,:fnameth,:lnameth,:fnameeng,:lnameeng,:nickname,
                :floor,:extn,:password,:phonenumber,:sex,:workgroup,:department,:departmenteng,:roleuser,:station)");

                $stmt->bindParam(":employee_id",$employee_id);
                $stmt->bindParam(":fnameth",$fnameth);
                $stmt->bindParam(":lnameth",$lnameth);
                $stmt->bindParam(":fnameeng",$fnameeng);
                $stmt->bindParam(":lnameeng",$lnameeng);
                $stmt->bindParam(":nickname",$nickname);
                $stmt->bindParam(":floor",$floor);
                $stmt->bindParam(":extn",$extn);
                $stmt->bindParam(":password",$password);
                $stmt->bindParam(":phonenumber",$phonenumber);
                $stmt->bindParam(":sex",$sex);
                $stmt->bindParam(":workgroup",$workgroup);
                $stmt->bindParam(":department",$department);
                $stmt->bindParam(":departmenteng",$departmenteng);
                $stmt->bindParam(":roleuser",$roleuser);
                $stmt->bindParam(":station",$station);
                $stmt->execute();
                $_SESSION['success'] = "data has been inserted sucessfully! " ;
                header("location: admin_emp.php");
            
            }catch(PDOException $e){    
            echo $e->getMessage();
        }
    }
}

?>