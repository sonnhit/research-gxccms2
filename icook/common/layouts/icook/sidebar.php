<!--Sidebar -->
<div class="col-md-4">
    <div class="sidebar">

        <?php $this->renderPartial('common.layouts.icook.search',array('page'=>$page,'layout_asset'=>$layout_asset)); ?>

        <div class="widget">
            <h2 class="widget-title">Popular</h2>
            <div class="popular-entrys">

                <?php $this->widget('BlockRenderWidget',array('page'=>$page,'region'=>'2','layout_asset'=>$layout_asset)); ?>

            </div>
        </div>

        <div class="widget">
            <h2 class="widget-title">Social</h2>
            <ul class="socials">
                <li><a href="#"><img src="<?php echo $layout_asset;?>/images/mini_facebook.png" alt="facebook" /></a></li>
                <li><a href="#"><img src="<?php echo $layout_asset;?>/images/mini_twitter.png" alt="twitter" /></a></li>
                <li><a href="#"><img src="<?php echo $layout_asset;?>/images/mini_rss.png" alt="rss" /></a></li>
                <li><a href="#"><img src="<?php echo $layout_asset;?>/images/mini_google+.png" alt="google+" /></a></li>
            </ul>
        </div>

        <div class="widget">
            <h2 class="widget-title">Meta</h2>
            <ul>
                <li><a href="#">Log in</a></li>
                <li><a href="#">Archive</a></li>
            </ul>
        </div>
    </div>
</div>
<!--End Sidebar-->
