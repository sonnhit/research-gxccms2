<?php

/**
 * This is the model class for table "{{user}}".
 * 
 * @author Tuan Nguyen
 * @version 1.0
 * @package cms.models.user
 *
 * The followings are the available columns in table '{{user}}':
 * @property string $user_id
 * @property string $username
 * @property string $user_url
 * @property string $display_name
 * @property string $password
 * @property string $email
 * @property string $fbuid
 * @property integer $status
 * @property integer $created_time
 * @property integer $updated_time
 * @property integer $recent_login
 * @property string $user_activation_key
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('created_time, updated_time, recent_login, confirmed','safe'),
						array('username, display_name, email, password', 'required'),
                        
                        //Email must be Unique if it is on Create Scenairo
                        array('email', 'unique',
                        'attributeName'=>'email',
                        'className'=>'cms.models.user.User',
                        'message'=>t('cms','This email has been registered.'),
                        ),
                                                                   
                        //Email must be Unique if it is on Create Scenairo
                        array('username', 'unique',
                        'attributeName'=>'username',
                        'className'=>'cms.models.user.User',
                        'message'=>t('cms','Username has been registered.'),
                        ),     
                    
                        //Email must be Unique if it is on Create Scenairo
                        array('user_url', 'unique',
                        'attributeName'=>'user_url',
                        'className'=>'cms.models.user.User',
                        'message'=>t('cms','Url has been registered.'),
                        'allowEmpty'=>true
                        ),
                        
                        array('location', 'length', 'max'=>100),
                        array('bio', 'length', 'max'=>1500),
                        array('gender', 'in', 'range'=>array('male','female','other')),
                        array('birthday_month', 'in', 'range'=>array('january','febuary','march','april','may','june','july','august','september','october','november','december')),
                        array('birthday_day', 'numerical'),
                        array('birthday_year', 'numerical'),                    
			
                        array('status, created_time, updated_time, recent_login', 'numerical', 'integerOnly'=>true),
						array('username, user_url, password, email', 'length', 'max'=>128),
						array('display_name', 'length', 'max'=>255),
						array('fbuid', 'length', 'max'=>20),
						array('user_activation_key', 'length', 'max'=>255),
						array('email_recover_key', 'length', 'max'=>255),                                               		
                        array('avatar', 'safe'), 
                        array('email_site_news','in','range'=>array('0','1')), 
                        array('email_search_alert','in','range'=>array('0','1')),
						// The following rule is used by search().
						// Please remove those attributes that should not be searched.
						array('user_id, username, user_url, display_name, email, fbuid, status, created_time, updated_time, recent_login', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' =>  t('cms','User'),
			'username' =>  t('cms','Username'),
			'user_url' =>  t('cms','User Url'),
			'display_name' =>  t('cms','Display Name'),
			'password' =>  t('cms','Password'),
			'email' =>  t('cms','Email'),
			'fbuid' =>  t('cms','Fbuid'),
			'status' =>  t('cms','Status'),
			'created_time' =>  t('cms','Created Time'),
			'updated_time' =>  t('cms','Updated Time'),
			'recent_login' =>  t('cms','Recent Login'),
			'user_activation_key' =>  t('cms','User Activation Key'),
            'confirmed' =>  t('cms','Confirmed'),
            'avatar' =>  t('cms','Avatar'),
            'email_site_news' =>  t('cms','Email site news'),
            'email_search_alert' =>  t('cms','Email search alert')
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('user_url',$this->user_url,true);
		$criteria->compare('display_name',$this->display_name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('fbuid',$this->fbuid,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_time',$this->created_time);
		$criteria->compare('updated_time',$this->updated_time);
		$criteria->compare('recent_login',$this->recent_login);

        $sort = new CSort;
        $sort->attributes = array(
                'user_id',
        );
        $sort->defaultOrder = 'user_id DESC';
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
             'sort'=>$sort
		));
	}       
	  
        
        /**
	 	* This is invoked before the record is saved.
		 * @return boolean whether the record should be saved.
		 */
		protected function beforeSave()
		{
			if(parent::beforeSave())
			{
                $this->email=strtolower($this->email);
                $this->username=strtolower($this->username);
                $this->user_url=strtolower($this->user_url);
				if($this->isNewRecord)
				{				
					$this->created_time=$this->updated_time=$this->recent_login=time();		
					$this->password = PassHash::hash($this->password);    
				}
				else {        
					$this->updated_time=time();
	            }
                       
				return true;
			}
			else
				return false;
		}
        
        //Do Clear Session after Save
        protected function afterSave()
		{
			parent::afterSave();	                	       
	        if(($this->user_id==user()->id) && ($this->scenario=='update')){
	 			//If this user updated his own settings, changed the session of him	            
	 			$command = Yii::app()->db->createCommand();
	            $command->select('username,user_url,display_name,email,fbuid,status,recent_login,avatar')->from('{{user}} u')
	            ->where('user_id='.(int)$this->user_id)     
	            ->limit(1);                             
	            $user=$command->queryRow();                 
	            //Add only some neccessary field
	            if($user){             
	                // Set User States here
	                Yii::app()->user->setState('current_user', $user);  
		        }
		    }
		}
        
        /**
         * Delete information of the User with Afer Delete
         */
        protected function afterDelete()
        {
            parent::afterDelete();
            AuthAssignment::model()->deleteAll('userid = :uid',
                                               array(':uid'=>$this->user_id));
        }
        
        /**
         * Static Function retrun String Roles of the User
         * @param bigint $uid
         * @return string
         */
		public static function getStringRoles($uid=0)
		{
			
			if($uid){
				$roles=Rights::getAssignedRoles($uid,true);
		                $res=array();
				foreach($roles as $r){
					$res[]=$r->name;
				}
		                if(count($res)>0)
		                    return implode(",",$res);
		                else 
		                    return '';
			
			} 			
			return '';
		
		}

		/**
         * Static Function retrun Array Roles of the User
         * @param bigint $uid
         * @return string
         */
		public static function getArrayRoles($uid=0)
		{
			$res=array();
			if($uid){
				$roles=Rights::getAssignedRoles($uid,true);
		        $res=array();
				foreach($roles as $r){
					$res[]=$r->name;
				}		                		
			} 			
			return $res;
		
		}
        
        /**
         * Return the String to the image
         * @param CActiveRecord $data
         * @return string
         */
        public static function convertUserState($data)
		{               
	         $image= ($data->status==ConstantDefine::USER_STATUS_ACTIVE) ? 'active' : 'disabled';							     
			 return bu().'/images/'.$image.'.png'; 
		}
        
        
         /**
         * Suggests a list of existing tags matching the specified keyword.
         * @param string the keyword to be matched
         * @param integer maximum number of tags to be returned
         * @return array list of matching tag names
         */
        public static function suggestPeople($keyword,$limit=20)
        {
                $users=User::model()->findAll(array(
                        'condition'=>'display_name LIKE :keyword',
                        'limit'=>$limit,
                        'params'=>array(
                                ':keyword'=>'%'.strtr($keyword,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
                        ),
                ));
                $names=array();
                foreach($users as $user){
                    $names[]=$user->display_name;
                    
                }
                       
                return $names;
        }
        
        /**
         * Find user with exactly display_name
         * @param type $keyword
         * @param type $limit
         * @return type 
         */
        public static function findPeople($keyword,$limit=20){            
            return User::model()->find(array(
                'condition'=>'display_name = :keyword',
                'limit'=>$limit,
                'params'=>array(
                        ':keyword'=>strtr($keyword,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')),
                ),
                ));
        }

}
