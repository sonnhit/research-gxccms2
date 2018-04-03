<div class="container">
    <div class="page">
        <div class="filter-area">
          <div class="filter-box">
              <ul class="filter tesla_filters" data-tesla-plugin="filters">
                  <li><a data-category="" class="active" href="#">all</a></li>
                  <li><a data-category="pasta" href="">Pasta</a></li>
                  <li><a data-category="meat" href="#">Meat</a></li>
                  <li><a data-category="dessert" href="#">Dessert</a></li>
                  <li><a data-category="drinks" href="#">Drinks</a></li>
                  <li><a data-category="vegetables" href="#">Vegetables</a></li>
              </ul>
              <h1>Recipes</h1>
          </div>
          <div class="row" data-tesla-plugin="masonry">

<?php if($this->display_type==GalleryBlock::DISPLAY_TYPE_HOMEPAGE) : ?>
	<?php if ($this->content_list != null) : ?>
		<?php
				//So I get the first content list and want to return as a Data Provider
                $content_list_data_provider = GalleryBlock::getContentList($this->content_list[0], null , null, ConstantDefine::CONTENT_LIST_RETURN_DATA_PROVIDER);
							//Get the current content List model
                if (isset($content_list_data_provider) && $content_list_data_provider != null) : ?>
                	 	<?php
                    	$this->widget('zii.widgets.CListView',
                                  array
                                  (
                                  	'viewData'=>array('asset'=>$this->layout_asset),
                                    'dataProvider'=>$content_list_data_provider,
                                    'itemView'=>'common.blocks.gallery.item_render',
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
	</div>
</div>
