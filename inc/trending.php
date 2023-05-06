<section id="iq-topten">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 overflow-hidden">
            <div class="topten-contents">
              <h4 class="main-title iq-title topten-title">
                Trending Movies
              </h4>
              <ul id="top-ten-slider" class="list-inline p-0 m-0 d-flex align-items-center">
              <?php 
                $sql_movie = "SELECT * FROM list_series ORDER BY view DESC LIMIT 6";
                $result_movie = mysqli_query($conn, $sql_movie);
                
                if (mysqli_num_rows($result_movie) > 0) {
                  // output data of each row
                  while($row_movie = mysqli_fetch_assoc($result_movie)) {
              ?>
                <li class="slick-bg">
                  <a href="#">
                    <img src="<?php echo  $row_movie["img_series"]?>" class="img-fluid w-100" alt="" />
                    <h6 class="iq-title"><a href="#"><?php echo  $row_movie["name_series"]?></a></h6>
                  </a>
                </li>
                <?php 
                }
              } else {
                echo "no data";
              }
                ?>
              </ul>
              <div class="vertical_s">
                <ul id="top-ten-slider-nav" class="list-inline p-0 m-0 d-flex align-items-center">
                  <?php 
                  $sql_movie = "SELECT * FROM list_series ORDER BY view DESC LIMIT 6";
                  $result_movie = mysqli_query($conn, $sql_movie);
                  if (mysqli_num_rows($result_movie) > 0) {
                    // output data of each row
                    while($row_movie = mysqli_fetch_assoc($result_movie)) {
                ?>
                  <li>
                    <div class="block-images position-relative">
                      <a href="#">
                        <img src="<?php echo  $row_movie["img_series"]?>" class="img-fluid w-100" alt="" />
                      </a>
                      <div class="block-description">
                        <h5><?php echo  $row_movie["name_series"]?></h5>
                        <div class="movie-time d-flex align-items-center my-2">
                          <div class="badge badge-secondary p-1 mr-2">
                          <?php echo  $row_movie["age"]?>
                          </div>
                          <span class="text-white"><?php echo  $row_movie["ep"]?> episode</span>
                        </div>
                        <div class="hover-buttons">
                          <a href="series.php?watch=<?php echo $row_movie["id_series"]?>" class="btn btn-hover" tabindex="0">
                            <i class="fa fa-play mr-1" aria-hidden="true"></i>
                            Play Now
                          </a>
                        </div>
                      </div>
                    </div>
                  </li>
                <?php 
                }
              } else {
                echo "no data";
              }
                ?>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>