<?php 
     	if(YII_DEBUG)
        	$layout_asset=Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.front_layouts.default.assets'), false, -1, true);
		else 
			$layout_asset=Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.front_layouts.default.assets'), false, -1, false);
            
		//Render Widget for Content Region
		$this->widget('BlockRenderWidget',array('page'=>$page,'region'=>'1','layout_asset'=>$layout_asset)); 
?>