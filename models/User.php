<?php

namespace app\models;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends  ActiveRecord implements IdentityInterface 
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 'Enabled';
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
        
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['token'] === $token) {
                return new static($user);
            }
        }

        return null;
    }


    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByUsername($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
        

    }

    /**
     * Finds client user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByClientUsername($email)
    {
        $status = self::STATUS_ACTIVE;
        $deleted_at = self::STATUS_DELETED;
        return static::find()->where("status='{$status}' AND email= '{$email}'")->one();
    }

    public static function findByKeyword($keyword) {
        $status = self::STATUS_ACTIVE;
        $deleted_at = self::STATUS_DELETED;
        return static::find()->where("status='{$status}' AND (email= '{$keyword}')")->one();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
       
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
    */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
    */
    public function setPassword($password) {
        $this->password = md5($password);
    }

    /**
     * Generates "remember me" authentication key
    */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
