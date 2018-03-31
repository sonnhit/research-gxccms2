<?php

/**
 * This is the Widget for create new Content.
 *
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package  cmswidgets.object
 *
 */
class ObjectCreateWidget extends CWidget
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


        //Get some pre value from URL

        //The type of the content we want to create
        $type=isset($_GET['type']) ? strtolower(trim($_GET['type'])) : '';

        //If it has guid, it means this is a translated version
        $guid=isset($_GET['guid']) ? strtolower(trim($_GET['guid'])) : '';

        //Get the list of Content Type
        $types=GxcHelpers::getAvailableContentType();

        //List of language that should exclude not to translate
        $lang_exclude=array();

        //List of translated versions
        $versions=array();

        //Available Terms for this Object Type
        $terms=array();

        //Selected Terms
        $selected_terms=array();

		//Get Term Order

        $term_orders=ConstantDefine::getTermOrder();



        //If $type is empty then redirect to choose content type page
        if($type!=''){

            //Check if the type appear in content type Definition
            if (array_key_exists($type, $types)){

                    // If the guid is not empty, it means we are creating a translated version of a content
                    // We will exclude the translated language and include the name of the translated content to $versions
                    if($guid!=''){
                            $temp_object=Object::model()->findAll('guid=:gid',array(':gid'=>$guid));
                            if(count($temp_object)>0){
                                    foreach($temp_object as $obj){
                                            $lang_exclude[]=$obj->lang;
                                            $langs=GxcHelpers::getAvailableLanguages();
                                            $versions[]=$obj->object_name.' - '.$langs[$obj->lang]['name'];

                                    }
                            }

                    }

                    //Import the Content Type Class
                    Yii::import('common.content_type.'.$type.'.'.$types[$type]['class']);

					//Init the class
					$typeClassObj = new $types[$type]['class'];

					$content_resources=$typeClassObj->Resources();




                    //We start to implement the checking Permission HERE
                    $param_content_check=array();
                    $data_content_check=array();
                    $param_content_check['type']=$type;


                    if(GxcContentPermission::checkCreatePermission($param_content_check,$data_content_check,
                            $typeClassObj->Permissions())){


                        $param_content_check['new_content']=true;

						$content_status=GxcContentPermission::getContentStatus($param_content_check,$data_content_check,
                        $typeClassObj->Permissions());

                        $model=new $types[$type]['class'];
                        // Uncomment the following line if AJAX validation is needed
                        // $this->performAjaxValidation($model);
                        $model->object_date=date('Y-m-d H:i:s');

                        $model->person='';

                        $model->guid=$guid;



                        $get_languages=GxcHelpers::loadLanguageItems($lang_exclude);


                        $available_languages=array();
                        foreach($get_languages as $key=>$value){
                            $available_languages[]=$key;
                        }

                        //Get available Taxonomy and Terms for this Object
                        $available_taxonomy=Taxonomy::model()->findAll(' type = :type AND lang IN ('.implode(',',$available_languages).') ',array(':type'=>$type,

                            ));
                        if($available_taxonomy){
                            foreach($available_taxonomy as $t){
                                $temp=array();
                                $temp['id']=$t->taxonomy_id;
                                $temp['lang']=$t->lang;
                                $temp['name']=$t->name;
                                $temp['terms']=array();


                                //Look for the Term Items belong to this Taxonomy
                                $list_terms=Term::model()->findAll(
                                         array(
                                             'select'=>'*',
                                             'condition'=>'taxonomy_id=:id',
                                             'order'=>'t.parent ASC, t.order ASC',
                                             'params'=>array(':id'=>$t->taxonomy_id)
                                         ));
                                if($list_terms){
                                    foreach($list_terms as $term) {
                                        $temp_item['id']=$term->term_id;
                                        $temp_item['name']=CHtml::encode($term->name);
                                        $temp_item['parent']=$term->parent;

                                        $temp['terms']['item_'.$term->term_id]=$temp_item;
                                    }
                                }

                                $terms[$t->taxonomy_id]=$temp;


                            }
                        }

                        if(isset($_POST[$types[$type]['class']])){

                                $model->attributes=$_POST[$types[$type]['class']];

                                //Convert the date time publish to timestamp
                                $model->object_date=strtotime($model->object_date);
								$model->object_date_gmt=local_to_gmt($model->object_date);

                                //Check which button the User click To Send to person or group
                                $button=$_POST['which_button'];
                                $trans=new Transfer;



                                // Get the Terms that the User Choose
                                //
                                $post_terms=isset($_POST['terms']) ? $_POST['terms'] : array();
                                $selected_terms=array();
                                if(!empty($post_terms)){
                                        foreach($post_terms as $t){
                                        $t=explode('_',$t);
                                        if(!isset($selected_terms[$t[1]])){
                                            $selected_temp=array();
                                            $selected_temp['id']=$terms[$t[1]]['id'];
                                            $selected_temp['lang']=$terms[$t[1]]['lang'];
                                            $selected_temp['name']=$terms[$t[1]]['name'];

                                            $selected_temp['terms']['item_'.$t[0]]['id']=$t[0];
                                            $selected_temp['terms']['item_'.$t[0]]['name']=$terms[$t[1]]['terms']['item_'.$t[0]]['name'];
                                            $selected_temp['terms']['item_'.$t[0]]['parent']=$terms[$t[1]]['terms']['item_'.$t[0]]['parent'];
                                            $selected_temp['terms']['item_'.$t[0]]['data']=$t[2];
                                            $selected_temp['terms']['item_'.$t[0]]['data_name']=$term_orders[$t[2]];

                                            $selected_terms[$t[1]]=$selected_temp;
                                        } else {
                                            if(!isset($selected_terms['terms']['item_'.$t[0]])){
                                                $selected_terms[$t[1]]['terms']['item_'.$t[0]]['id']=$t[0];
                                                $selected_terms[$t[1]]['terms']['item_'.$t[0]]['name']=$terms[$t[1]]['terms']['item_'.$t[0]]['name'];
                                                $selected_terms[$t[1]]['terms']['item_'.$t[0]]['parent']=$terms[$t[1]]['terms']['item_'.$t[0]]['parent'];
                                                $selected_terms[$t[1]]['terms']['item_'.$t[0]]['data']=$t[2];
                                                $selected_terms[$t[1]]['terms']['item_'.$t[0]]['data_name']=$term_orders[$t[2]];
                                            }
                                        }
                                    }
                                }


                                // After having the selected Terms, we need to make sure  all parents
                                // of the selected Terms must be added also
                                foreach($selected_terms as $tx_key=>$t){

                                    $array_parent_selected_terms=array();

                                    foreach($t['terms'] as $key=>$st_terms){
                                        $current_term=$st_terms;
                                        while($current_term['parent']!=0){

                                            if((!isset($array_parent_selected_terms['item_'.$current_term['parent']])) && (
                                               !isset($t['terms']['item_'.$current_term['parent']])
                                                )){
                                                $array_parent_selected_terms['item_'.$current_term['parent']]=$terms[$tx_key]['terms']['item_'.$current_term['parent']];
                                                $array_parent_selected_terms['item_'.$current_term['parent']]['data']=key($term_orders);
                                                $array_parent_selected_terms['item_'.$current_term['parent']]['data_name']=$term_orders[key($term_orders)];

                                            }

                                            $current_term=$terms[$tx_key]['terms']['item_'.$current_term['parent']];

                                        }
                                    }

                                    $selected_terms[$tx_key]['terms']=CMap::mergeArray($t['terms'],$array_parent_selected_terms);

                                }

                                //Re-Set the Status based on what User Chooose

                                //The content is sent to ROLES OR STATUS
                                if($button=='1'){

                                        //Check if the object_status is number or character
                                        if(!is_numeric($model->object_status)){
                                                //Set the status to Pending
                                                $trans->note=$model->object_status;
                                                $model->object_status=  ConstantDefine::OBJECT_STATUS_PENDING;
                                                $trans->type=  ConstantDefine::TRANS_ROLE;
                                                $trans->after_status=  ConstantDefine::OBJECT_STATUS_PENDING;

                                        } else {
                                                $trans->type=ConstantDefine::TRANS_STATUS;
                                                $trans->after_status=$model->object_status;
                                        }
                                        $trans->from_user_id=user()->id;
                                        $trans->to_user_id=0;
                                        $trans->before_status=  ConstantDefine::OBJECT_STATUS_DRAFT;


                                }

                                //The content is sent to PERSON DIRECTLY
                                if($button=='2'){

                                        $to_user_id= User::findPeople($model->person);

                                        //Start to Transfer to the user and set the status to Pending
                                        if($to_user_id){
                                            $model->object_status=  ConstantDefine::OBJECT_STATUS_PENDING;

                                            $trans->from_user_id=user()->id;
                                            $trans->to_user_id=$to_user_id->user_id;
                                            $trans->type=  ConstantDefine::TRANS_PERSON;
                                            $trans->before_status=  ConstantDefine::OBJECT_STATUS_PENDING;
                                            $trans->after_status=  ConstantDefine::OBJECT_STATUS_PENDING;
                                        } else {
                                                $model->addError('person',t('User not found'));
                                        }
                                }

								//Work with Resource Binding
								$resource=array();
								$resource_upload=array();
								foreach($content_resources as $res){
									$resource_upload[]=GxcHelpers::getArrayResourceObjectBinding('resource_upload_'.$res['type']);
								}

								$i=0;
								$count_resource=0;
								foreach($content_resources as $cres){
									$j=1;
									foreach ($resource_upload[$i] as $res_up){
										$j++;
										$count_resource++;
									}
									$i++;
								}

								$model->total_number_resource=$count_resource;

                                if($model->save()){
                                        user()->setFlash('success',t('cms','Create new Content Successfully!'));
                                        $trans->object_id=$model->object_id;
                                        $trans->save();

                                        // We have all the selected Terms for now
                                        // We will add them to Object Terms
                                        foreach($selected_terms as $tx_key=>$t){
                                            foreach($t['terms'] as $key=>$st_terms){

                                                $obj_term=new ObjectTerm();
                                                $obj_term->object_id=$model->object_id;
                                                $obj_term->term_id=$st_terms['id'];
                                                $obj_term->data=$st_terms['data'];
                                                $obj_term->save();

                                                unset($obj_term);
                                            }
                                        }

										//Update Resource Binding Here
										$i=0;
										$count_resource=0;
										foreach($content_resources as $cres){
											$j=1;
											foreach ($resource_upload[$i] as $res_up){
												$obj_res = new ObjectResource;
												$obj_res->resource_id=$res_up['resid'];
												$obj_res->object_id=$model->object_id;
												$obj_res->description='';
												$obj_res->type=$cres['type'];
												$obj_res->resource_order=$j;

												$obj_res->save();
												$j++;
												$count_resource++;
											}
											$i++;
										}
										
										//Re-init new Model
                                        $model=new $types[$type]['class'];
                                        $model->object_date=date('Y-m-d H:i:s');

                                        Yii::app()->controller->refresh();



                                } else {
                                        $model->object_date=date('Y-m-d H:i:s',$model->object_date);
                                }

                        }

                        $render_template='cmswidgets.views.object.object_form_widget';

                        if(file_exists(Yii::getPathOfAlias('common.content_type.'.strtolower($type).'.object_form_widget').'.php')){
                            $render_template='common.content_type.'.strtolower($type).'.object_form_widget';
                        }

                        $this->render($render_template,
                                array('model'=>$model,
                                      'versions'=>$versions,
                                      'lang_exclude'=>$lang_exclude,
                                      'content_status'=>$content_status,
                                      'terms'=>$terms,
                                      'selected_terms'=>$selected_terms,
                                      'type'=>$type,
                                      'content_resources'=>$content_resources
                                    ));
                    }

            } else {

                //The type is not in Content Type Definition
                $this->render('cmswidgets.views.object.object_start_widget',array('types'=>$types));
            }
        } else {

                //There is no Type in $_GET
                $this->render('cmswidgets.views.object.object_start_widget',array('types'=>$types));
        }
    }


}
