
	<div class="half">
		<p style="margin-top:0">
			<h2 class="post-title"><?php echo CHtml::encode($post->object_name); ?></h2>
			<div class="date-author">Posted on <?php echo date("m/d/Y H:i", $post->object_date); ?> by <?php echo  $post->object_author_name; ?></div>
			<br /><br />
			<div class="post-content">
			<?php echo $post->object_content; ?>
			</div>
		</p>
	</div>

	<div class="comments-area">
		<div id="respond" class="comment-respond">
		<h3>Add a comment</h3>
		<?php
			$this->widget('cmswidgets.comment.CommentCreateWidget',array());
		?>
		</div>
	</div>
