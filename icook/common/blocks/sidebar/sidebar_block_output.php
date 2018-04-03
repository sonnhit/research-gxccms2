<!--Sidebar -->
<div class="col-md-4">
    <div class="sidebar">

        <div class="widget">
            <form class="search">
                <input type="text" class="search-line" placeholder="What are you searching for?" name="serch">
                <input type="submit" value="" class="search-button">
            </form>
        </div>


        <div class="widget">
            <h2 class="widget-title">Popular</h2>
            <div class="popular-entrys">


<?php if($this->display_type==SidebarBlock::DISPLAY_TYPE_HOMEPAGE) : ?>
	<?php if ($this->content_list != null) : ?>
		<?php
				//So I get the first content list and want to return as a Data Provider
                $content_list_data_provider = SidebarBlock::getContentList($this->content_list[0], null , null, ConstantDefine::CONTENT_LIST_RETURN_DATA_PROVIDER);
							//Get the current content List model
                if (isset($content_list_data_provider) && $content_list_data_provider != null) : ?>
                	 	<?php
                    	$this->widget('zii.widgets.CListView',
                                  array
                                  (
                                  	'viewData'=>array('asset'=>$this->layout_asset),
                                    'dataProvider'=>$content_list_data_provider,
                                    'itemView'=>'common.blocks.sidebar.item_render',
                                    'summaryText'=>'',
                                    'ajaxUpdate'=>true,
                                    'enablePagination'=> true,
                                    'enableSorting'=>false,
                                    'sortableAttributes'=>array(),
                                    )
                                  );
                		?>
	            <?php endif; ?>
	<?php endif; ?>
<?php endif; ?>

</div>
</div>

<div class="widget">
<h2 class="widget-title">Social</h2>
<ul class="socials">
		<li><a href="#"><img src="<?php echo $this->layout_asset;?>/images/mini_facebook.png" alt="facebook" /></a></li>
		<li><a href="#"><img src="<?php echo $this->layout_asset;?>/images/mini_twitter.png" alt="twitter" /></a></li>
		<li><a href="#"><img src="<?php echo $this->layout_asset;?>/images/mini_rss.png" alt="rss" /></a></li>
		<li><a href="#"><img src="<?php echo $this->layout_asset;?>/images/mini_google+.png" alt="google+" /></a></li>
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
