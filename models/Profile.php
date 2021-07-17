<?php
namespace app\models;
use Yii;
use app\models\CylinderList;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $email
 * @property string $password
 * @property string $auth_key
 * @property int $phone_number
 * @property string|null $indentity_proof
 * @property string|null $indentity_proof_type
 * @property string|null $aadhar_card_number
 * @property string|null $age
 * @property string|null $gender
 * @property string|null $address
 * @property string|null $state
 * @property string|null $city
 * @property string|null $status
 * @property string|null $created
 * @property string|null $updated
 */


class Profile extends \yii\db\ActiveRecord
{
     
    public static function tableName()
    {
        return 'users';
    }
   
   
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // email and password are both required
            [['first_name','last_name','email','phone_number','gender','address','state','city','identity_proof','aadhar_card_number'], 'required','on'=>'updateProfile'],
            [['age','phone_number'],'integer'],
            [['email'],'email'],
            [['identity_proof','company_name','account_type','created', 'updated'],'safe'],
            [['identity_proof_type'],'file','skipOnEmpty'=> true,'extensions' => 'png,jpg,pdf'],
            [['profile_picture'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['gender'], 'string', 'max' => 10],
            [['state', 'city'], 'string', 'max' => 100],
            [['auth_key'], 'string', 'max' => 32],
            [['first_name','last_name'], 'match', 'pattern' => '/^[a-zA-Z_ ]*$/', 'message' => 'Only alphabetic characters allowed'],
            ['phone_number', 'match', 'pattern' =>'/^[0-9]{10}$/','message' => 'Phone Number Must be Exactly 10 Digit.'],
            ['aadhar_card_number', 'match', 'pattern' =>'/^[0-9]{12}$/','message' => 'Adhar card Number Must be Exactly 12 Digit.'],
        ];
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
            'profile_picture' => 'Profile Picture',
            'identity_proof' => 'Identification proof provided/Type of ID',
            'identity_proof_type'=>'Identity proof File',
            'aadhar_card_number' => 'Aadhar Card Number',
            'account_type' => 'Account Type',
            'company_name' => 'Comapany Name',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',           
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getcylinderlist()
    {
        return $this->hasMany(CylinderList::className(), ['user_id' => 'id']);
    }    
}
