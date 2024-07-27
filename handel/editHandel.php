<?php require_once '../inc/header.php';
      require_once '../inc/conn.php';



      if (isset($_POST['submit']) && isset($_GET['id']) ) {
        extract($_POST);
        
        $id = $_GET['id'];
        $query = "select * from posts where id=$id";
        $result = mysqli_query($conn,$query);
         if (mysqli_num_rows($result) == 1) {
             // update
            $post = mysqli_fetch_assoc($result);
            $oldImage = $post['image'];

            // image attreputes
        if($_FILES['image'] && $_FILES['image']['name']){
            unlink("../assets/images/postImage/$oldImage");
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
            }else{
                $new_name = $oldImage;
            }
            if (empty($errors)) {
                //   UPLOAD AND STORE DATA
                
                $query = "update posts set `title` ='$title',`body` ='$body',`image` ='$new_name' where id = '$id'";
                $result= mysqli_query($conn,$query);
                if($_FILES['image'] && $_FILES['image']['name']){
                move_uploaded_file($temp_name,"../assets/images/postImage/$new_name");
                }
                header("location:../viewPost.php?id=$id");
            }else{
                $_SESSION['errors'] = $errors;
                header("location:../editPost.php?id=$id");
            }

         }else{
             $msg = "post not found";
         }
        
    }else{
        header("location:../index.php");
    }