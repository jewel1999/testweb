<?php 
    session_start();
    require_once "connect_db.php";
    if(isset($_POST['printer_insert'])){
        $printer_sn = $_POST['printer_sn'];
        $printer_name = $_POST['printer_name'];
        $printer_owner = $_POST['printer_owner'];
        $printer_status  = $_POST['printer_status'];

        if(!isset($_SESSION['error'])){
        try {
            $check_printer_sn = $conn->prepare("SELECT printer_sn FROM printers WHERE printer_sn = :printer_sn");   // : replace values
            $check_printer_sn->bindParam(":printer_sn",$printer_sn);
            $check_printer_sn->execute();
            $row = $check_printer_sn->fetch(PDO::FETCH_ASSOC);

                $stmt = $conn->prepare("INSERT INTO printers(printer_sn,printer_name,printer_owner,printer_status)
                                        VALUES (:printer_sn,:printer_name,:printer_owner,:printer_status)");
                $stmt->bindParam(":printer_sn",$printer_sn);
                $stmt->bindParam(":printer_name",$printer_name);
                $stmt->bindParam(":printer_owner",$printer_owner);
                $stmt->bindParam(":printer_status",$printer_status);
                $stmt->execute();
                $_SESSION['success'] = "data has been inserted sucessfully! " ;
                header("location: admin_printer.php");
            
            }catch(PDOException $e){    
            echo $e->getMessage();
        }
    }
}

?>