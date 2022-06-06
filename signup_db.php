<?php 

    session_start();
    require_once 'connect_db.php';

    if(isset($_POST['signup'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $department = $_POST['department'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $user_role = 'user';

        if(empty($firstname)){
            $_SESSION['error']='กรุณากรอกชื่อ';
            header("location:signup.php");   //re-direct to signup page  
        }else if (empty($lastname)){
            $_SESSION['error']='กรุณากรอกนามสกุล';
            header("location:signup.php");
        }else if (empty($department)){
            $_SESSION['error']='กรุณาเลือกแผนก';
            header("location:signup.php");
        }else if (empty($email)){
            $_SESSION['error']='กรุณากรอกอีเมลล์';
            header("location:signup.php");
        }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['error']='รูปแบบอีเมลล์ไม่ถูกต้อง';
            header("location:signup.php");
        }else if (empty($password)){
            $_SESSION['error']='กรุณากรอกรหัสผ่าน';
            header("location:signup.php");
        }else if (strlen($_POST['password'])>20 || strlen($_POST['password']<5)){
            $_SESSION['error']='รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location:signup.php");
        }else if (empty($c_password)){
            $_SESSION['error']='กรุณายืนยันรหัสผ่าน';
            header("location:signup.php");
        }else if ($password != $c_password){
            $_SESSION['error']='รหัสผ่านไม่ตรงกัน';
            header("location:signup.php");
        }else {
            try {
                $check_email = $conn->prepare("SELECT email FROM users_login WHERE email = :email");   // : replace values
                $check_email->bindParam(":email",$email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if($row['email']== $email){
                    $_SESSION['warning'] = "มีอีเมลล์นีอยู่ในระบบแล้ว <a href='index.php'>click here </a>";
                    header("location:signup.php");
                }else if(!isset($_SESSION['error'])){
                    $passwordHash = password_hash($password,PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users_login(firstname,lastname,department,email,password,user_role)
                                            VALUES (:firstname,:lastname,:department,:email,:password,:user_role)");
                    $stmt->bindParam(":firstname",$firstname);
                    $stmt->bindParam(":lastname",$lastname);
                    $stmt->bindParam(":department",$department);
                    $stmt->bindParam(":email",$email);
                    $stmt->bindParam(":password",$passwordHash);
                    $stmt->bindParam(":user_role",$user_role);
                    $stmt->execute();
                    $_SESSION['success'] = "ลงทะเบียนเรียบร้อยแล้ว ! <a href='index.php' class='alert alert-link' > click here </a> เพื่อเข้าสู่ระบบ" ;
                    header("location: signup.php");

                }else {
                    $_SESSION['error']= 'มีบางอย่าผิดพลาด';
                    header("location : signup.php");
                }


            }catch(PDOException $e){    
                echo $e->getMessage();
            }
        }
    }

?>