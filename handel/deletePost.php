<?php
        require_once '../inc/conn.php';
      if(isset($_SESSION['user_id'])):


      if (isset($_GET['id'])) {
        $id = $_GET['id'];
      }else{
        header("location:../index.php");
      }

      $query = "select * from posts where id=$id";
      $result = mysqli_query($conn,$query);
      

      if (mysqli_num_rows($result) == 1) {
        
        
        $post = mysqli_fetch_assoc($result);
        $image = $post['image'];
        if(!empty($image)){
            unlink("../assets/images/postImage/$image");
        }
        $query = "delete from posts where id=$id";
        $result = mysqli_query($conn,$query);
        if($result){
            $_SESSION['success']="post deleted";
            header("location:../index.php");
        }else{
            $_SESSION['errors']=["error while delete"];
            header("location:../index.php");
        }
    
    
    }else{
        $_SESSION['errors']=["post not found"];
            header("location:../index.php");
      }

    else:
      header("location:../Login.php");
    endif;