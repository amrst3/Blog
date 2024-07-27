<?php require_once 'inc/header.php';
      require_once 'inc/conn.php';
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
              <h4><?php echo $data['view post'] ?></h4>
              <h2><?php echo $data['Read the post'] ?></h2>
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
    ?>

    
    <div class="best-features about-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2><?php echo $data['Our Post'] ?></h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <img src="assets/images/postImage/<?php echo $post['image'] ?>" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <h4><?php echo $post['title'] ?></h4>
              <p><?php echo $post['body'] ?></p>
              
              <div class="d-flex justify-content-center">
                  <a href="editPost.php?id=<?php echo $post['id'] ?>" class="btn btn-success mr-3 "><?php echo $data['edit post'] ?></a>
              
                  <a href="handel/deletePost.php?id=<?php echo $post['id'] ?>" class="btn btn-danger "><?php echo $data['delete post'] ?></a>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>

    <?php require_once 'inc/footer.php' ?>

</body>
</html>
