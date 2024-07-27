<?php
require_once '../inc/conn.php';

if (isset($_POST['submit'])) {
    extract($_POST);

    // image attreputes
    $image = $_FILES['image'];
    // var_dump($image);
    $temp_name = $image['tmp_name'];
    $size = $image['size']/(1024*1024);
    $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
    $ext_arr = ["png","jpg","jpeg"];

    $errors = [];
    // ERRORS CATCH
    if ($image['error']!=0) {
        $errors[] = "image not correct";
    }elseif($size > 3){
        $errors[] = "image is too large";
    }elseif(!in_array($ext,$ext_arr)){
        $errors[] = "wrong extintion";
    }elseif(empty($title)){
        $errors[] = "title required";
    }elseif(empty($body)){
        $errors[] = "body required";
    }

    $new_name = uniqid().".".$ext;
    if (empty($errors)) {
        //   UPLOAD AND STORE DATA
        move_uploaded_file($temp_name,"../assets/images/postImage/$new_name");
        $user_id = $_SESSION['user_id'];
        $query = "insert into posts(`title`,`body`,`image`,`user_id`) values('$title','$body','$new_name','$user_id')";
        mysqli_query($conn,$query);
        header("location:../index.php");
    }else{
        print_r($errors);
    }
}else{
    header("location:../index.php");
}