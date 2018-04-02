<div class="form">
<?php $this->render('cmswidgets.views.notification'); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comments-form',
	'enableAjaxValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">

		<div class="col-md-4">
			<?php echo $form->labelEx($model,'comment_author'); ?>
			<?php echo $form->textField($model,'comment_author',array('size'=>60,'maxlength'=>100,'class'=>'comments-line')); ?>
			<?php echo $form->error($model,'comment_author'); ?>
		</div>

		<div class="col-md-4">
			<?php echo $form->labelEx($model,'comment_author_url'); ?>
			<?php echo $form->textField($model,'comment_author_url',array('size'=>60,'maxlength'=>200,'class'=>'comments-line')); ?>
			<?php echo $form->error($model,'comment_author_url'); ?>
		</div>

		<div class="col-md-4">
			<?php echo $form->labelEx($model,'comment_author_email'); ?>
			<?php echo $form->textField($model,'comment_author_email',array('size'=>60,'maxlength'=>100,'class'=>'comments-line')); ?>
			<?php echo $form->error($model,'comment_author_email'); ?>
		</div>
		</div>

			<?php echo $form->labelEx($model,'comment_content'); ?>
			<?php echo $form->textArea($model,'comment_content',array('rows'=>6, 'cols'=>50,'disabled'=>false,'class'=>'comments-area')); ?>
			<?php echo $form->error($model,'comment_content'); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? t('cms','Create') : t('cms','Save') ,array('class'=>'comments-button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
