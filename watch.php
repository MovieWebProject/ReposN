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
  ?>
  <main>
  <?php 
        $value = $_GET['watch'];
        $stmt = $conn->prepare( "SELECT * FROM list_movie WHERE id_movie = ?");
        $stmt->bind_param("s", $value);

        $stmt->execute();
        $res = $stmt->get_result();
        $row = mysqli_fetch_assoc($res);

        
    ?>
  <div class="movie-details" >
    <div class="movie-image" style="margin-top: 100px;">
        <img src="<?php echo $row['img_movie'];?>" alt="Movie Title" width="600" height="440">
    </div>
    
    
    
    <div class="movie-info" style="margin-top: 100px;">
        <div class="movie-header">
            <h1 class="movie-title"><?php echo $row['name_movie'];?></h1>
            <p class="age-limit">Age limit: <?php echo $row['age'];?></p>
        </div>
    <p class="movie-genre">Action, Adventure, Comedy</p>
    <p class="movie-description"><?php echo $row['detail'];?></p>
    <p class="movie-description"><strong>Actors:</strong> <?php echo $row['actor'];?></p>
    <p class="movie-description"><strong>Time:</strong> <?php echo $row['time'];?></p>
    <div class="watch-buttons">
      <button class="watch-button" >Watch Now</button>
      <button class="trailer-button"onclick="window.location.href='https://www.youtube.com/watch?v=L-aFL-bX1ao'">Watch Trailer</button>
    </div>
    <!-- <div class="hover-buttons">
        <span class="btn btn-hover iq-button"onclick="window.location.href='watch.php';">
        <i class="fa fa-play mr-1"></i>
        Play Now
        </span>
        <span class="btn btn-hover iq-button"onclick="window.location.href='watch.php';">
        <i class="fa fa-play mr-1"></i>
        Play Now
        </span> -->
    </div>
  </div>
</div >
</div>

<div class="comments">

    <h1>Comments</h1>
  <?php 
    $conn = open_database();  
    $email = $_SESSION['email'];
    $watch = $_GET['watch'];

    // Go up view 
    $stm = $conn->prepare("UPDATE list_movie SET view = view + 1 WHERE id_movie = $watch");
    $stm->execute();


    $stmt = $conn->prepare("SELECT * FROM comments WHERE id_movie = ?");
    $stmt->bind_param('s', $watch);
    $stmt->execute();
    $comments = $stmt->get_result();
    while($row = $comments->fetch_assoc()){
  ?>
  <div class="comment">
    <div class="comment-header">
      <span class="comment-author"><?php echo $row['username']; ?></span>
      <span class="comment-date"><?php echo $row['created_at']; ?></span>
    </div>
    <div class="comment-body">
      <?php echo $row['comment']; ?>
    </div>
  </div>
  <?php 
    }
  ?>
</div>
    <form class="comment-form" method="post" action="comment.php?watch=<?php echo $value?>">

        <div class="form-group">
        <!-- <label for="comment" style="color:#444">Comment:</label> -->
          <textarea id="comment" name="comment" class="comment-text" placeholder="Add a comment"></textarea>
        </div>
        <!-- <div class="form-group">
          <input type="submit" value="Submit">
        </div> -->
        <div class="comment-header">
              <input type="submit" class="btn btn-primary" value="Write a comment">
        </div>
    </form>

    
    </main>
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
    <style>
    main {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    strong {
  font-weight:bold;
  color: #e50914 !important;
}

    .movie-details {
        display: flex;
        flex-wrap: flex-start;
        margin-bottom: 50px;
    }
    .movie-image {
        flex-basis: 50%;
        text-align: center;
    }
    .movie-image img {
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
    }
    .movie-info {
        flex-basis: 50%;
        padding: 0 40px;
        position: relative;
    }
    .movie-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .movie-title {
        font-size: 36px;
        margin-right: 20px;
    }
    .age-limit {
        background-color: #ff2d55;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: bold;
    }
    .movie-genre {
        margin-bottom: 20px;
        font-size: 18px;
    }
    .movie-description {
        margin-bottom: 30px;
        font-size: 16px;
        line-height: 1.5;
    }
    .watch-buttons {
  display: flex;
  flex-wrap: wrap;
  margin-top: 20px;
}

.watch-button,
.trailer-button {
  display: inline-block;
  padding: 10px 20px;
  font-size: 1.2rem;
  font-weight: bold;
  text-align: center;
  text-decoration: none;
  color: #fff;
  border-radius: 5px;
  margin-right: 10px;
  margin-bottom: 10px;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease;
}

.watch-button {
  background-color: #e50914;
}

.trailer-button {
  background-color: #333;
}

.watch-button:hover,
.trailer-button:hover {
  transform: translateY(-2px);
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}
.comment-header h2 {
  font-size: 24px;
  margin: 0;
}
.comment-form {
  margin-bottom: 20px;
}

.comment-text {
  width: 100%;
  height: 100px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
  resize: none;
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
  font-size: 1.2rem;
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 1rem;
}

.form-group textarea {
  height: 150px;
}

.form-group input[type="submit"] {
  background-color: #333;
  color: #fff;
  border: none;
  border-radius: 5px;
  font-size: 1rem;
  font-weight: bold;
  padding: 10px 20px;
  cursor: pointer;
}

.form-group input[type="submit"]:hover {
  background-color: #444;
}
    .comments {
  margin-top: 20px;
  
}

.comment {
  margin-bottom: 20px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  position: relative;
}

.comment:hover {
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  transition: box-shadow 0.3s ease-in-out;
}

.comment-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

.comment-author {
  font-weight: bold;
  font-size: 1.2rem;
}

.comment-date {
  font-size: 0.8rem;
  color: #666;
}

.comment-body {
  line-height: 1.5;
  margin-bottom: 10px;
}

.comment-actions {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  position: absolute;
  bottom: 10px;
  right: 10px;
}




    </style>       

</body>
<?php 
    include "./inc/recommend.php";
    include "./inc/footer.php";
?>