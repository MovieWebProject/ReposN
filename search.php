<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit();
    }
    $_SESSION["find"] =  $_POST["search"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Video Streaming</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <!-- i will provide this in description  -->
  <link rel="stylesheet" href="css/slick.css" />
  <link rel="stylesheet" href="css/slick-theme.css" />
  <link rel="stylesheet" href="css/owl.carousel.min.css" />
  <link rel="stylesheet" href="css/animate.min.css" />
  <link rel="stylesheet" href="css/magnific-popup.css" />
  <link rel="stylesheet" href="css/select2.min.css" />
  <link rel="stylesheet" href="css/select2-bootstrap4.min.css" />

  <link rel="stylesheet" href="css/slick-animation.css" />
  <link rel="stylesheet" href="style.css" />
  
</head>

<body>
  <?php 
  include"db.php";
  include"./inc/header.php";
  if(isset($_GET['movie'])){
    $chuyen = $_GET['movie'];
  }else{
    $chuyen = '';
  }
  if(isset($_GET["search"]) && !empty($_GET["search"])){
    $key = $_GET["search"];
    $sql = "SELECT * FROM list_movie WHERE id_movie LIKE '%$key%' OR name_movie LIKE '%$key%'";
    $sql2 = "SELECT * FROM list_series WHERE id_series LIKE '%$key%' OR name_series LIKE '%$key%'";
  }
  else{
    $sql = "SELECT * FROM list_movie";
    $sql2 = "SELECT * FROM list_series";
  }
  $result = mysqli_query($conn, $sql);
  $result2 = mysqli_query($conn, $sql2);
  ?>
  <!-- main content starts  -->
  

  <!-- main content ends  -->
  <section id="iq-favorites">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 "  style="margin-top: 100px;">
              <?php 
              $value = '%' . $_SESSION["find"] . '%';
                
                $stmt = $conn->prepare("SELECT * FROM list_movie WHERE name_movie  LIKE ? ORDER BY id_movie ASC"); 
                $stmt->bind_param("s", $value);
                $stmt->execute();
                $res = $stmt->get_result();

                $stmt2 = $conn->prepare("SELECT * FROM list_series WHERE name_series  LIKE ? ORDER BY id_series ASC"); 
                $stmt2->bind_param("s", $value);
                $stmt2->execute();
                $res2 = $stmt2->get_result();
                
                ?>
                <div class="iq-main-header d-flex align-items-center justify-content-between">
              <h4 class="main-title"></h4>
              <a href="#" class="iq-view-all"></a>
            </div>
            <div class="favorite-contens">
              <?php 
              if(mysqli_num_rows($res) == 0 && (mysqli_num_rows($res2) == 0) ){
                echo "Movie not found";
              }else{
                $num_movies = mysqli_num_rows($res) + mysqli_num_rows($res2) ;
                echo "Found " . $num_movies . " movies.";
              }
              ?>
            <ul id="show">
            <?php 
      if(mysqli_num_rows($res) > 0 ){
                  while($row_movie = mysqli_fetch_assoc($res)) {
              ?>

                      <!-- slide item 1 -->
                      <li class="slide-item">
                        <div class="block-images position-relative">
                          <div class="img-box">
                            <img src="<?php echo  $row_movie["img_movie"]?>" class="img-fluid" alt="" />
                          </div>
                          <div class="block-description">
                            <h6 class="iq-title">
                              <a href="#"> <?php echo  $row_movie["name_movie"]?> </a>
                            </h6>
                            <div class="movie-time d-flex align-items-center my-2">
                              <div class="badge badge-secondary p-1 mr-2"><?php echo  $row_movie["age"]?></div>
                              <span class="text-white"><?php echo  $row_movie["time"]?></span>
                            </div>
                            <div class="hover-buttons">
                              <span class="btn btn-hover iq-button" onclick="window.location.href='watch.php?watch=<?php echo $row_movie["id_movie"]?>';">
                                <i class="fa fa-play mr-1"></i>
                                Play Now
                              </span>
                            </div>
                          </div>
                          <div class="block-social-info">
                            <ul class="list-inline p-0 m-0 music-play-lists">
                              <li class="share">
                                <span><i class="fa fa-share-alt"></i></span>
                                <div class="share-box">
                                  <div class="d-flex align-items-center">
                                    <a href="#" class="share-ico"><i class="fa fa-share-alt"></i></a>
                                    <a href="#" class="share-ico"><i class="fa fa-youtube"></i></a>
                                    <a href="#" class="share-ico"><i class="fa fa-instagram"></i></a>
                                  </div>
                                </div>
                              </li>
                              <li>
                                <span><i class="fa fa-heart"></i></span>
                                <span class="count-box">99+</span>
                              </li>
                              <li>
                                <span><i class="fa fa-plus"></i></span>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </li>
                      
                <?php 
                }
      }
      if(mysqli_num_rows($res2) > 0 ){
          while($row_movie = mysqli_fetch_assoc($res2)) {
              ?>
                      <!-- slide item 1 -->
                      <li class="slide-item">
                        <div class="block-images position-relative">
                          <div class="img-box">
                            <img src="<?php echo  $row_movie["img_series"]?>" class="img-fluid" alt="" />
                          </div>
                          <div class="block-description">
                            <h6 class="iq-title">
                              <a href="#"> <?php echo  $row_movie["name_series"]?> </a>
                            </h6>
                            <div class="movie-time d-flex align-items-center my-2">
                              <div class="badge badge-secondary p-1 mr-2"><?php echo  $row_movie["age"]?> episode</div>
                              <span class="text-white"><?php echo  $row_movie["ep"]?> episode</span>
                            </div>
                            <div class="hover-buttons">
                              <span class="btn btn-hover iq-button" onclick="window.location.href='watch.php?watch=<?php echo $row_movie["id_series"]?>';">
                                <i class="fa fa-play mr-1"></i>
                                Play Now
                              </span>
                            </div>
                          </div>
                          <div class="block-social-info">
                            <ul class="list-inline p-0 m-0 music-play-lists">
                              <li class="share">
                                <span><i class="fa fa-share-alt"></i></span>
                                <div class="share-box">
                                  <div class="d-flex align-items-center">
                                    <a href="#" class="share-ico"><i class="fa fa-share-alt"></i></a>
                                    <a href="#" class="share-ico"><i class="fa fa-youtube"></i></a>
                                    <a href="#" class="share-ico"><i class="fa fa-instagram"></i></a>
                                  </div>
                                </div>
                              </li>
                              <li>
                                <span><i class="fa fa-heart"></i></span>
                                <span class="count-box">99+</span>
                              </li>
                              <li>
                                <span><i class="fa fa-plus"></i></span>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </li>
                      
                <?php 
                }
      }
                ?>

              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>


  <!-- js files  -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/slick.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/select2.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/slick-animation.min.js"></script>
  <script src="js/home.js"></script>

  <script src="main.js"></script>
  <style>
    ul#show {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  padding: 0;
}

.slide-item {
  width: 25%;
  padding: 10px;
  box-sizing: border-box;
  margin-bottom: 20px;
}
  </style>
</body>

</html>