<?php
namespace app\models;
use Yii;
use yii\base\Model;
use app\models\User;


/**
* SupplierSignupForm is the model behind the login form.
*/

class SupplierSignupForm extends Model
{
    public $first_name;
    public $last_name;
    public $password;
    public $phone_number;
    public $email;  
    public $age;  
    public $gender;
    public $address;
    public $state;
    public $city;
    public $identity_proof;
    public $aadhar_card_number;    
    public $account_type;    
    public $company_name;    
   
   
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // email and password are both required
            [['first_name','last_name','email','company_name','password','phone_number','gender','address','state','city','aadhar_card_number'], 'required'],
            ['email','email'],
            [['account_type'],'safe'],
            [['age','phone_number'],'number'],
            [['password',], 'string', 'min' => 6],
            [['first_name','last_name'], 'match', 'pattern' => '/^[a-zA-Z_ ]*$/', 'message' => 'Only alphabetic characters allowed'],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This email is already registered with us.'],
            ['phone_number', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This mobile already registered with us.'],
            ['phone_number', 'match', 'pattern' =>'/^[0-9]{10}$/','message' => 'Phone Number Must be Exactly 10 Digit.'],
            ['aadhar_card_number', 'match', 'pattern' =>'/^[0-9]{12}$/','message' => 'Adharcard Number Must be Exactly 12 Digit.'],
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
            $model->gender = $this->gender;
            $model->phone_number = $this->phone_number;
            $model->address = $this->address;
            $model->state = $this->state;
            $model->age = $this->age;
            $model->city = $this->city;
            $model->identity_proof = $this->identity_proof;
            $model->aadhar_card_number = $this->aadhar_card_number;  
            $model->account_type = "Supplier"; 
            $model->company_name = $this->company_name;
            $model->status = 'Enabled';                      
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
        }
        return $this->_user;
    }

    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'phone_number' => 'Phone Number',
            'age' => 'Age',
            'gender' => 'Gender',
            'address' => 'Address',
            'state' => 'State',
            'city' => 'City',
            'identity_proof' => 'Identity Proof',
            'aadhar_card_number' => 'Aadhar Card Number',
            'account_type' => 'Account Type',
            'company_name' => 'Comapany Name',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
           
        ];
    }    
}
