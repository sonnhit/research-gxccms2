<?php $count = 0; ?>
<?php if($this->beginCache('menu-render-header'.$this->menu_id, array('duration'=>7200))) { ?>


<div class="container">
    <div class="footer">
        <p>Copyright © 2014 iCOOK Blog. All rights reserved. Vivamus gravida justo sed nisl viverra in venenatis lacus posuere.</p>
        <ul>
                    <?php foreach ($menus as $menu) :?>
                        <li>
                          <a href="<?php echo $menu['link'];?>" title="<?php echo $menu['name'];?>" <?php echo isset($_GET['slug'])&&$_GET['slug']==$menu['link']?'class="active"':'';?>>
                            <span>
                              <span><?php echo $menu['name'];?></span>
                            </span>

                          </a>
                        </li>
                    <?php endforeach;?>
        </ul>
    </div>
</div>
<?php $this->endCache(); } ?>



        <!-- ======================================================================
                                        START SCRIPTS
        ======================================================================= -->
        <script src="<?php echo $this->layout_asset;?>/js/modernizr.custom.63321.js" type="text/javascript"></script>
        <script src="<?php echo $this->layout_asset;?>/js/jquery-1.10.0.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->layout_asset;?>/js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->layout_asset;?>/js/bootstrap.js" type="text/javascript"></script>
        <script src="<?php echo $this->layout_asset;?>/js/placeholder.js" type="text/javascript"></script>
        <script src="<?php echo $this->layout_asset;?>/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->layout_asset;?>/js/masonry.pkgd.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->layout_asset;?>/js/jquery.swipebox.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->layout_asset;?>/js/options.js" type="text/javascript"></script>
        <script src="<?php echo $this->layout_asset;?>/js/plugins.js" type="text/javascript"></script>
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- ======================================================================
                                        END SCRIPTS
        ======================================================================= -->
    </body>
</html>
