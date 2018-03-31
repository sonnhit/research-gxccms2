<?php

/**
 * This is the model class for Login Form.
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package cms.models.user
 *
 */
class UserLoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
            'username'=>t('cms','Username/Email'),
			'password'=>t('cms','Password'),
			'rememberMe'=>t('cms','Remember me'),
		);
	}

	
    /**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
            $this->username=$this->username;                        
			$this->_identity=new UserIdentityDb($this->username,$this->password);
			if($this->_identity->authenticate() > 0){
				switch ($this->_identity->errorCode) {
					case ConstantDefine::USER_ERROR_NOT_ACTIVE :
						$this->addError('username',t('cms','User is not Active.'));
						break;
					default :
						$this->addError('password',t('cms','Incorrect username or password.'));
						break;
				    }
				
			}
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentityDb($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentityDb::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 60*60*24*7 : 17400; // 7 days or default to 20 minutes
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
