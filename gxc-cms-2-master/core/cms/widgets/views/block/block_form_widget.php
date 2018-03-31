<?php if ((Yii::app()->user->hasFlash('success')) && (isset($_GET['embed'])) ) : ?>
    <script type="text/javascript">      	 
         window.parent.updateOnAddBlock(window.parent.document.getElementById('<?php echo $_GET['iframe_id']; ?>'),
         '<?php echo CHtml::encode($model->name); ?>','<?php echo $model->block_id ?>','<?php echo $model->type ?>');
    </script>
<?php endif; ?>
    
<div class="form">
<?php $this->render('cmswidgets.views.notification'); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'block-form',
        'enableAjaxValidation'=>true,       
        )); 
?>

<?php echo $form->errorSummary($model); ?>
    
<?php echo $form->hiddenField($model,'type'); ?>    
<div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name'); ?>
        <?php echo $form->error($model,'name'); ?>
</div>
<div class="row">
        
</div>    
<?php    
	$current_type_name=(strpos($type,'.')===false) ? $type : substr($type, strrpos($type, '.' )+1);	
    $this->render('common.blocks.'.$type.'.'.$current_type_name.'_block_input',array(   
        'model'=>$model,
        'block_model'=>$block_model,
        'form'=>$form
    )); 
?>
<script>		
<?php
    foreach($block_model->errors as $key=>$error) {
         echo "$('#Block-".$key."'".").attr('class','error')";	           
    }
?>
</script>
<div class="row buttons">
        <?php echo CHtml::submitButton(t('cms','Save'),array('class'=>'bebutton')); ?>
    
        <?php if(isset($_GET['embed'])): ?>
        <input type="button" class="button" value="<?php echo  t('cms','Cancel');?>" onClick="window.parent.cancelOnAddBlock(window.parent.document.getElementById(window.name));"/>
        <?php endif; ?>
</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
