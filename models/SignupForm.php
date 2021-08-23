<?php
namespace app\models;
use Yii;
use yii\base\Model;
use app\models\User;

/**
* SignupForm is the model behind the login form.
*/

class SignupForm extends Model
{
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $mobile;
    public $confirm_password;
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // email and password are both required
            [['first_name','last_name','email', 'password','confirm_password','mobile'], 'required'],
            ['email','email'],
            [['password','confirm_password'], 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute'=>'password', 'message'=>"Confirm Passwords don't match with password." ],
            [['first_name','last_name'], 'match', 'pattern' => '/^[a-zA-Z_ ]*$/', 'message' => 'Only alphabetic characters allowed'],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This email is already registered with us.'],
            [['mobile'],'number'],
            ['mobile', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This mobile already registered with us.'],
            ['mobile', 'match', 'pattern' =>'/^[0-9]{10}$/','message' => 'Mobile Number Must be Exactly 10 Digit.'],
        ];
    }
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
        }
    }
    /**
     * Logs in a user using the provided email and password.
     * @return boolean whether the user is logged in successfully
     */
    public function signup()
    {
        if ($this->validate()) {
            $model = new User();
            $model->auth_key = Yii::$app->security->generateRandomString();
            $model->first_name = $this->first_name;
            $model->last_name = $this->last_name;
            $model->email = $this->email;
            $model->password = md5($this->password);
            $model->mobile = $this->mobile;
            //$model->profile_image = 'uploads/profile/default.png';
            //$model->account_type = 'PFM';
            //$model->referral_id = "1";
            $model->status = 'Enabled';
            //$model->profile_percentage = "10";
            $model->created = date('Y-m-d h:i:s');
            $model->updated = date('Y-m-d h:i:s');
            if($model->save() &&  Yii::$app->user->login($model,  3600*24*30))
		      return true;
            else
		      return false;	
        }
        return false;
    }
	
	
    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            
            $this->_user = User::findByUsername($this->email);
            //\app\components\Helper::pp($this->_user);
        }
        return $this->_user;
    }

    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'mobile' => 'Mobile',
            'password' => 'Password',
            'confirm_password' => 'Confirm Password'
        ];
    }    
}
