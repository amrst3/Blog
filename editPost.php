<?php
  require_once 'inc/conn.php';
if(isset($_SESSION['user_id'])):

require_once 'inc/header.php';
if(isset($_SESSION['lang'])){
  $lang = $_SESSION['lang'];
}else{
  $lang = "en";
}
if($lang == "ar"){
  require_once 'inc/ar.php';
}else{
  require_once 'inc/en.php';
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <!-- Page Content -->
 <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4><?php echo $data['Edit Post'] ?></h4>
              <h2><?php echo $data['edit your personal post'] ?></h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
      }else{
        header("location:index.php");
      }

      $query = "select * from posts where id=$id";
      $result = mysqli_query($conn,$query);
      if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
      }else{
        $msg = "post not found";
      }
    
      if(!empty($post)){?>

<div class="container w-50 ">
<div class="d-flex justify-content-center">
    <h3 class="my-5"><?php echo $data['Edit Post'] ?></h3>
  </div>

    <form method="POST" action="handel/editHandel.php?id=<?php echo $post['id'] ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label"><?php echo $data['Title'] ?></label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $post['title'] ?>">
        </div>
        <div class="mb-3">
            <label for="body" class="form-label"><?php echo $data['Body'] ?></label>
            <textarea class="form-control" id="body" name="body" rows="5"><?php echo $post['body'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label"><?php echo $data['image'] ?></label>
            <input type="file" class="form-control-file" id="image" name="image" >
        </div>
        <img src="assets/images/postImage/<?php echo $post['image'] ?>" alt="" width="100px" srcset="">
        <button type="submit" class="btn btn-primary" name="submit"><?php echo $data['Edit'] ?></button>
    </form>
</div>

      <?php
      }else{
        echo $msg;
      }
      ?>


<?php require_once 'inc/footer.php'; 

    else:
      header("location:Login.php");
    endif;
?>
</body>
</html>