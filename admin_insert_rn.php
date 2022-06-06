<?php 
    session_start();
    require_once "connect_db.php";
    if(isset($_POST['rn_insert'])){
        $rn_dn = $_POST['rn_dn'];
        $rn_no = $_POST['rn_no'];
        $rn_date = $_POST['rn_date'];
        $rn_status  = $_POST['rn_status'];
        $rn_des = $_POST['rn_des'];

        if(!isset($_SESSION['error'])){
        try {
            $check_rn_sn = $conn->prepare("SELECT rn_no FROM repair_notices WHERE rn_no = :rn_no");   // : replace values
            $check_rn_sn->bindParam(":rn_no",$rn_no);
            $check_rn_sn->execute();
            $row = $check_rn_sn->fetch(PDO::FETCH_ASSOC);

                $stmt = $conn->prepare("INSERT INTO repair_notices(rn_dn,rn_no,rn_date,rn_status,rn_des)
                                        VALUES (:rn_dn,:rn_no,:rn_date,:rn_status,:rn_des)");
                $stmt->bindParam(":rn_dn",$rn_dn);
                $stmt->bindParam(":rn_no",$rn_no);
                $stmt->bindParam(":rn_date",$rn_date);
                $stmt->bindParam(":rn_status",$rn_status);
                $stmt->bindParam(":rn_des",$rn_des);
                $stmt->execute();
                $_SESSION['success'] = "data has been inserted sucessfully! " ;
                header("location: admin_rn.php");
            
            }catch(PDOException $e){    
            echo $e->getMessage();
        }
    }
}

?>