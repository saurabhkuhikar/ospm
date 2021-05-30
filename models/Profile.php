<?php
namespace app\models;
use Yii;



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
            [['identity_proof','account_type','created', 'updated'],'safe'],
            [['gender'], 'string', 'max' => 10],
            [['state', 'city'], 'string', 'max' => 50],
            [['auth_key'], 'string', 'max' => 32],
            [['first_name','last_name'], 'match', 'pattern' => '/^[a-zA-Z_ ]*$/', 'message' => 'Only alphabetic characters allowed'],
            ['phone_number', 'match', 'pattern' =>'/^[0-9]{10}$/','message' => 'Phone Number Must be Exactly 10 Digit.'],
            ['aadhar_card_number', 'match', 'pattern' =>'/^[0-9]{12}$/','message' => 'Adharcard Number Must be Exactly 12 Digit.'],
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
            'identity_proof' => 'Identity Proof',
            'aadhar_card_number' => 'Aadhar Card Number',
            'account_type' => 'Account Type',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
           
        ];
    }    
}
