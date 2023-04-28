<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit();
    }
    
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
  }
  else{
    $sql = "SELECT * FROM list_movie";
  }
  $result = mysqli_query($conn, $sql);
  include"./inc/slider.php";
  ?>
  <!-- main content starts  -->
  <div class="main-content">
    <!-- favorite section starts   -->
    <?php include"./inc/TopPick.php";
          //upcoming contents section starts
          include"./inc/popular.php";
          //top ten trending
          include"./inc/trending.php";
          //parallax section
          include "./inc/parallax.php";
          include "./inc/recommend.php";
    ?>
  </div>

  <!-- main content ends  -->
  <?php include"./inc/footer.php";?>

  

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
</body>

</html>