<?php
require_once '../inc/conn.php';

$email = $_SESSION['email'];
$admin = "amr@a.com";

if($email == $admin):

    if(isset($_POST['submit'])){
        
        $name = trim(htmlspecialchars($_POST['name']));
        $email = trim(htmlspecialchars($_POST['email']));
        $password = trim(htmlspecialchars($_POST['password']));
        $phone = trim(htmlspecialchars($_POST['phone']));

        //valedation :::

        $errors = [];
        // ERRORS CATCH
        if (empty($name)) {
            $errors[] = "name required";
        }elseif(empty($email)){
            $errors[] = "email required";
        }elseif(empty($password)){
            $errors[] = "password required";
        }elseif(empty($phone)){
            $errors[] = "phone required";
        }

        if (empty($errors)) {
            //   UPLOAD AND STORE DATA
            $hashPass = password_hash($password, PASSWORD_DEFAULT);

            $query = "insert into users(`name`,`email`,`password`,`phone`) values ('$name','$email','$hashPass','$phone')";
            $result = mysqli_query($conn,$query);

            if($result){
                header("location:../Login.php");
            }else{
                header("location:register.php");
            }
        }else{
            print_r($errors);
        }

    }else{
        header("location:  register.php");
    }
else:
    header("location:../Login.php");
endif;