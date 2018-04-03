

  <?php
    $link = $data->getObjectLink();
    $temp = strstr( $data->object_content, 'src="http:');
    $url = substr( $temp,  5, 46);
  ?>

      <div class="<?php echo $data->css_class;?>">
          <div class="recipe-item">
              <a href="<?php echo $link?>" class="swipebox">
                <span class="recipe-item-cover">
                  <img src="<?php echo $url?>" alt="food image" />
                </span>
              </a>
              <h1>
                <a href="<?php echo $link?>"><?php echo $data->object_name?></a>
              </h1>
          </div>
      </div>
