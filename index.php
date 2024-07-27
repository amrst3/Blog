
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
    <!-- Banner Starts Here -->
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <!-- <h4>Best Offer</h4> -->
            <!-- <h2>New Arrivals On Sale</h2> -->
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <!-- <h4>Flash Deals</h4> -->
            <!-- <h2>Get your best products</h2> -->
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
            <!-- <h4>Last Minute</h4> -->
            <!-- <h2>Grab last minute deals</h2> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->
  <?php
   require_once 'inc/success.php';
   require_once 'inc/errors.php';
   ?>
    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2><?php echo $data['Latest Posts'] ?></h2>
              <!-- <a href="products.html">view all products <i class="fa fa-angle-right"></i></a> -->
            </div>
          </div>
                <!-- FETCH DATA FROM DATA BASE -->
          <?php 
            
            $query = "select * from posts";
            $result = mysqli_query($conn,$query);

            if (mysqli_num_rows($result) > 0) {
              $posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
            }else{
              $msg = "Posts not found";
            }
            
            if (!empty($posts)):
              foreach ($posts as $post):
          ?>


          <div class="col-md-4">
            <div class="product-item">
              <a href="viewPost.php?id=<?php echo $post['id'] ?>"><img src="assets/images/postImage/<?php echo $post['image'] ?>" alt=""></a>
              <div class="down-content">
                <a class="d-block" href="viewPost.php?id=<?php echo $post['id'] ?>"><h4><?php echo $post['title'] ?></h4></a>
                <hr/>
                <p><?php echo $post['body'] ?></p>
                <div class="d-block">
                <p class="d-block"><?php echo $post['created_at'] ?></p>
                </div>
                <!-- <ul class="stars">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span>Reviews (24)</span> -->
                <div class="d-flex justify-content-end">
                  <a href="viewPost.php?id=<?php echo $post['id'] ?>" class="btn btn-info "> <?php echo $data['view'] ?></a>
                </div>
                
              </div>
            </div>
            </div>

          
          <?php
              endforeach;
            else : echo $msg;
            endif;
          ?>

        </div>
      </div>
    </div>

 
    
<?php require_once 'inc/footer.php' ?>
</body>
</html>
