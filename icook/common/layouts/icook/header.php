<!doctype html>
<html>
<head>
        <meta charset="utf-8" />
        <title><?php echo $this->pageTitle ?></title>
        <meta name="description" content="Here goes description" />
        <meta name="author" content="author name" />
        <link rel="shortcut icon" href="<?php echo $layout_asset; ?>/images/favicon.ico" type="image/x-icon" />
        <!-- ======================================================================
                                    Mobile Specific Meta
        ======================================================================= -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!-- ======================================================================
                                    Style CSS + Google Fonts
        ======================================================================= -->
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300|Bitter:400,700,400italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo $layout_asset;?>/css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo $layout_asset;?>/css/style.css" />
        <?php
    		//Render Widget for Header Script
    		$this->widget('BlockRenderWidget',array('page'=>$page,'region'=>'3','layout_asset'=>$layout_asset));
    	?>

    </head>
