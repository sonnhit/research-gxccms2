<?php

/**
 * This is the model class for Create User.
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package cms.models.user
 *
 */
class UserCreateForm extends CFormModel
{
    
        public $username;
        public $display_name;
        public $password;
        public $email;
        

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
            return array(
                array('username, display_name, email, password', 'required'),                
                array('display_name', 'length', 'max'=>255),
                array('password','length','min'=>3),
                array('email, username', 'length', 'max'=>128),
                array('email', 'email' , 'message'=>t('cms','Email is not valid')),
                array('email', 'unique',
                        'attributeName'=>'email',
                        'className'=>'cms.models.user.User',
                        'message'=>t('cms','This email has been registered.')),
                array('username', 'unique',
                        'attributeName'=>'username',
                        'className'=>'cms.models.user.User',
                        'message'=>t('cms','Username has been registered.')),
             );
	}

        
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>t('cms','Username'),
                        'display_name'=>t('cms','Display Name'),
                        'password'=>t('cms','Password'),
                        'email'=>t('cms','Email')                        
		);
	}
              

}