

  <?php
    $link = $data->getObjectLink();
    $temp = strstr( $data->object_content, 'src="http:');
    $url = substr( $temp,  5, 46);
  ?>
<div class="page">
    <h3 class="site-title"><?php echo $data->object_name;?></h3>
    <?php echo $data->object_content;?>
    <hr/>
</div>
