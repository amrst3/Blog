<?php
require_once '../inc/conn.php';

if(isset($_POST['submit'])){

    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(htmlspecialchars($_POST['password']));

    $errors = [];
    // ERRORS CATCH
    if(empty($email)){
        $errors[] = "email required";
    }elseif(empty($password)){
        $errors[] = "password required";
    }

    if (empty($errors)) {
        //   UPLOAD AND STORE DATA
       
        $query = "select * from users where `email` = '$email'";
        $result = mysqli_query($conn,$query);
        $account = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) == 1) {
            $name = $account['name'];
            $id = $account['id'];
            $thepass = $account['password'];
            $theemail = $account['email'];

            if(password_verify($password,$thepass)){
                $_SESSION['user_id']="$id";
                $_SESSION['email']="$email";
                $_SESSION['success']="welcome $name";
                header("location:../index.php");


            }else{
                $_SESSION['errors']=["wrong email or password"];
                header("location:../Login.php");
            }
        }else{
            $_SESSION['errors']=["this account not exist"];
            header("location:../Login.php");
        }

    }else{
        print_r($errors);
    }

}else{
    header("location:../Login.php");
}
