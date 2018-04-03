

  <?php
    $link = $data->getObjectLink();
    $temp = strstr( $data->object_content, 'src="http:');
    $url = substr( $temp,  5, 46);
  ?>
  <div class="blog-entry">

      <div class="row">
          <div class="col-md-5">
              <div class="entry-header">
              <h1><a href="<?php echo $link; ?>"><?php echo CHtml::encode($data->object_name); ?></a></h1>

              </div>
          </div>
      </div>
      <div class="entry-cover">
          <a href="<?php echo $link; ?>"><img src="<?php echo $url;?>" alt="blog image" /></a>
      </div>
  </div>
