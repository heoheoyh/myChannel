
    <?php 
    require_once("dbconfig.php");
    $query = "SELECT board_free.*, GROUP_CONCAT(DISTINCT thum_hash SEPARATOR ' ') AS thum_hash ,GROUP_CONCAT(DISTINCT url  SEPARATOR ' ') AS url FROM board_free LEFT JOIN thumnail ON board_free.b_no=thumnail.b_no GROUP BY board_free.b_no ASC";
    // $query = "SELECT board_free.*, GROUP_CONCAT(DISTINCT thum_hash SEPARATOR '/') AS thum_hash ,GROUP_CONCAT(DISTINCT url  SEPARATOR ' ') AS url FROM board_free LEFT JOIN thumnail ON board_free.b_no=thumnail.b_no GROUP BY board_free.b_no ASC";
    $result = $db->query($query);
    $num_result= $result->num_rows;


    ?>

    <div class="content" style="margin-top:50px;">
      <div class=".cont_1280"> 

        <?php

        while($row = $result->fetch_assoc())
        {

          ?>

          <div class="inline">

            <?php 
            echo "<div class='card'>
            <div class='card-image'><img src='files/".$row['hash']."' class='activator' style='height:280px;' /></div>
            <div class='card-content'>
            <span class='card-title activator grey-text text-darken-4'>".$row['b_title']."<i class='material-icons right'>more_vert</i></span>
            <p><a href='".$row['main_url']."' target='_blank'>This is a link</a></p>
            </div>
            <div class='card-reveal'>
            <span class='card-title grey-text text-darken-4'>".$row['b_title']."<i class='material-icons right'>close</i></span>
            <p>".$row['b_content']."</p>
            </div>
            </div>" ;

            echo "<div class='owl-demo z-depth-1'  class='owl-carousel owl-theme'>";
            $imgPathArr = explode(' ', $row['thum_hash']);
            $urlPathArr = explode(' ', $row['url']);
            // $imgPathArr = split('/', $row['thum_hash']);
            //   $urlPathArr = split(' ', $row['url']);
            for($j=0; $j<count($imgPathArr) && count($urlPathArr); $j++){

              echo "<div class='item' style='margin-top:15px;'>
              <a href='".$urlPathArr[$j]."' target='_blank'><img src='files/".$imgPathArr[$j]."' class='thumb'/></a>
              <a href='".$urlPathArr[$j]."' target='_blank'>Go To Link</a>
              </div>";
            }

            echo "</div>";

            ?> 

          </div>

          <?php
        }
        ?>

      </div>

    </div>

    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/OwlCarousel/owl-carousel/owl.carousel.js"></script>
    <script type="text/javascript">

    $(document).ready(function() {

      $(".owl-demo").owlCarousel({

      // autoPlay: 3000,//Set AutoPlay to 3 seconds

      items : 2,
      itemsDesktop : [1199,2],
      itemsDesktopSmall : [979,2],
      itemsMobile : [640,2]


    });

    });

    </script>

  