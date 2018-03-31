<div class="form">
<?php $this->render('cmswidgets.views.notification'); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'system_settings_form',
        'enableAjaxValidation'=>true,       
        )); 
?>

<?php echo $form->errorSummary($model); ?>
<div class="row">
        <?php echo $form->labelEx($model,'support_email'); ?>
        <?php echo $form->textField($model,'support_email'); ?>
        <?php echo $form->error($model,'support_email'); ?>
</div>
<div class="row">
        <?php echo $form->labelEx($model,'page_size'); ?>
        <?php echo $form->textField($model,'page_size'); ?>
        <?php echo $form->error($model,'page_size'); ?>
</div>
<div class="row">
        <?php echo $form->labelEx($model,'keep_file_name_upload'); ?>
        <?php echo $form->dropDownList($model,'keep_file_name_upload',SystemSettingsForm::filenameUpload()); ?>
        <?php echo $form->error($model,'keep_file_name_upload'); ?>
</div>
    
 
<div class="row buttons">
        <?php echo CHtml::submitButton(t('cms','Save'),array('class'=>'bebutton')); ?>
</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
