<?php
class CommentCreateWidget extends CWidget
{
	public $visible=true;

	public function init()
	{

	}

	public function run()
	{
		if($this->visible)
		{
			$this->renderContent();
		}
	}

	protected function renderContent()
	{
		$model = new Comment;
		if(isset($_POST['Comment']))
		{
			$model->attributes= $_POST['Comment'];
			$model->setAttributes(['comment_content'=>$_POST['Comment']['comment_content']],false);
			$model->setAttributes(['object_id'=>$_GET['id']],false);
			if ($model->save()){
				user()->setFlash('success',t('cms','Post Successfully!'));
			}
			else {
				user()->setFlash('fail',t('cms','Post Fail!'));
			}
		}
		$this->render('cmswidgets.views.comment.comment_create_widget',array('model'=>$model));
	}
}
?>
