<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $auth_key
 * @property int $phone_number
 * @property int|null $age
 * @property string|null $gender
 * @property string|null $address
 * @property string|null $state
 * @property string|null $city
 * @property string|null $company_name
 * @property string $profile_picture
 * @property string|null $identity_proof
 * @property string|null $identity_proof_type
 * @property string|null $aadhar_card_number
 * @property string $account_type
 * @property string $status
 * @property string $created
 * @property string $updated
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'password', 'auth_key', 'phone_number', 'profile_picture', 'account_type', 'status', 'created'], 'required'],
            [['phone_number', 'age'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['first_name', 'last_name', 'email', 'password', 'address', 'company_name', 'profile_picture', 'identity_proof', 'identity_proof_type', 'account_type'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['gender'], 'string', 'max' => 10],
            [['state', 'city', 'status'], 'string', 'max' => 100],
            [['aadhar_card_number'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
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
            'company_name' => 'Company Name',
            'profile_picture' => 'Profile Picture',
            'identity_proof' => 'Identity Proof',
            'identity_proof_type' => 'Identity Proof Type',
            'aadhar_card_number' => 'Aadhar Card Number',
            'account_type' => 'Account Type',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
