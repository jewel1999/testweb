<?php 
    session_start();
    require_once "connect_db.php";
    if(isset($_POST['com_insert'])){
        $com_sn = $_POST['com_sn'];
        $com_name = $_POST['com_name'];
        $com_owner = $_POST['com_owner'];
        $com_status  = $_POST['com_status'];

        if(!isset($_SESSION['error'])){
        try {
            $check_com_sn = $conn->prepare("SELECT com_sn FROM computers WHERE com_sn = :com_sn");   // : replace values
            $check_com_sn->bindParam(":com_sn",$com_sn);
            $check_com_sn->execute();
            $row = $check_com_sn->fetch(PDO::FETCH_ASSOC);

                $stmt = $conn->prepare("INSERT INTO computers(com_sn,com_name,com_owner,com_status)
                                        VALUES (:com_sn,:com_name,:com_owner,:com_status)");
                $stmt->bindParam(":com_sn",$com_sn);
                $stmt->bindParam(":com_name",$com_name);
                $stmt->bindParam(":com_owner",$com_owner);
                $stmt->bindParam(":com_status",$com_status);
                $stmt->execute();
                $_SESSION['success'] = "data has been inserted sucessfully! " ;
                header("location: admin_com.php");
            
            }catch(PDOException $e){    
            echo $e->getMessage();
        }
    }
}

?>