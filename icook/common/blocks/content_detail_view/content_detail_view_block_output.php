
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
	    <h3><?php echo $count;?> Comments</h3>
	    <ul class="commentlist">
				<?php
					foreach ($comment as $row) {
				?>
					<li>
	            <div class="comment">
	                <p><?php echo $row->comment_content;?></p>
	                <span class="comment-info">
	                    <i>by</i> <?php echo $row->comment_author?> <i>on</i> <span><?php echo date("m/d/Y H:i",$row->comment_date);?> </span>
	                </span>
	            </div>
	        </li>
			 <?php } ?>
	    </ul>
	</div>

	<div class="recipe-pagination">
		<?php
			if ($post_next){ ?>
	    <a class="next-recipe" href="<?php echo $post_next->getObjectLink();?>">
				 <?php echo $post_next->object_name; ?>»
			</a>
		<?php } ?>
		<?php if ($post_pre) {?>
	    <a class="last-recipe" href="<?php echo $post_pre->getObjectLink();?>">
				«<?php echo $post_pre->object_name;?>
			</a>
	<?php }?>
	</div>
