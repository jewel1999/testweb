<?php 
    session_start();
    require_once "connect_db.php";
    if(isset($_POST['other_insert'])){
        $device_no = $_POST['device_no'];
        $device_name = $_POST['device_name'];
        $device_type = $_POST['device_type'];
        $device_status  = $_POST['device_status'];

        if(!isset($_SESSION['error'])){
        try {
            $check_device_sn = $conn->prepare("SELECT device_no FROM other_device WHERE device_no = :device_no");   // : replace values
            $check_device_sn->bindParam(":device_no",$device_no);
            $check_device_sn->execute();
            $row = $check_device_sn->fetch(PDO::FETCH_ASSOC);

                $stmt = $conn->prepare("INSERT INTO ohter_device(device_no,device_name,device_type,device_status)
                                        VALUES (:device_no,:device_name,:device_type,:device_status)");
                $stmt->bindParam(":device_no",$device_no);
                $stmt->bindParam(":device_name",$device_name);
                $stmt->bindParam(":device_type",$device_type);
                $stmt->bindParam(":device_status",$device_status);
                $stmt->execute();
                $_SESSION['success'] = "data has been inserted sucessfully! " ;
                header("location: admin_other.php");
            
            }catch(PDOException $e){    
            echo $e->getMessage();
        }
    }
}

?>