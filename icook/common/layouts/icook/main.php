<?php
	$layout_asset=GxcHelpers::publishAsset(Yii::getPathOfAlias('common.layouts.icook.assets'));
?>
<?php $this->renderPartial('common.layouts.icook.header',array('page'=>$page,'layout_asset'=>$layout_asset)); ?>
<body>
	<!-- ===============================================
	START HEADER =================================== -->
	<div class="header">
			<div class="container">
					<div class="row">
							<div class="col-md-4 col-xs-6">
									<div class="logo">
											<a href="<?php echo Yii::app()->request->getBaseUrl(true);?>"><?php echo settings()->get('general', 'site_name'); ?></a>
									</div>
							</div>
							<div class="col-md-8 col-xs-6">
									<?php $this->widget('BlockRenderWidget',array('page'=>$page,'region'=>'0','layout_asset'=>$layout_asset)); ?>
							</div>
					</div>
					<div class="header-heading">
					<h2>Your recipe is at a click away. Choose your favorite recipe and cooking with iCOOK. Enjoy all the flavors with iCOOK.</h2>
					</div>
			</div>
	</div>
	<!-- ===============================================
	END HEADER =================================== -->



	<!-- ===============================================
	START CONTENT =================================== -->
	<div class="content">
			<div class="container">
					<div class="row">
							<div class="col-md-8">
							<!-- BLOG ENTRY REPEAT -->
								<?php $this->widget('BlockRenderWidget',array('page'=>$page,'region'=>'1','layout_asset'=>$layout_asset)); ?>
							<!-- BLOG ENTRY REPEAT -->
							</div>
							<!--Sidebar -->
							<?php $this->widget('BlockRenderWidget',array('page'=>$page,'region'=>'2','layout_asset'=>$layout_asset)); ?>
							<!--End Sidebar-->
					</div>
			</div>
	</div>
	<!-- ===============================================
	END CONTENT =================================== -->
	<?php $this->widget('BlockRenderWidget',array('page'=>$page,'region'=>'4','layout_asset'=>$layout_asset)); ?>
