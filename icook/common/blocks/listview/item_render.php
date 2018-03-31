

  <?php
    $link = $data->getObjectLink();
    $temp = strstr( $data->object_content, 'src="http:');
    $url = substr( $temp,  5, 46);
  ?>
  <div class="blog-entry">
      <div class="entry-cover">
          <a href="<?php echo $link; ?>"><img src="<?php echo $url;?>" alt="blog image" /></a>
      </div>
      <div class="row">
          <div class="col-md-5">
              <div class="entry-header">
              <h1><a href="<?php echo $link; ?>"><?php echo CHtml::encode($data->object_name); ?></a></h1>
              <p><span><?php echo date("m/d/Y H:i", $data->object_date); ?></span> by <a href="#"><?php echo  $data->object_author_name; ?></a> in <a href="#">Recipe</a></p>
              </div>
          </div>
          <div class="col-md-7">
              <div class="entry-content">
                  <p><?php echo CHtml::encode($data->object_excerpt); ?></p>
              </div>
          </div>
      </div>
  </div>
