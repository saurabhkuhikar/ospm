<?php

namespace app\models;
use Yii;
use app\models\User;

/**
 * This is the model class for table "states".
 *
 * @property int $id
 * @property string $country_name
 * @property string $state_name
 */
class Search extends \yii\db\ActiveRecord
{
    public $state_name;
    public $city_name;
    public $search_input;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state_name','city_name'], 'required'],
            [['search_input'], 'safe'],
            [['state_name','city_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'city_name' => 'City',
            'state_name' => 'State',
            'search_input'=>'Search',
        ];
    }
    // public function filter(){
    //     if(isset($state_name) && isset($city_name)){
    //         $model = User::find()->select(['company_name','id','first_name','state','city','phone_number','profile_picture'])->where(['state'=>[$state_name],'city'=>[$city_name],'status' => 'Enabled','account_type' => ['Supplier'],]);
    //         return $model;
    //     }

    // }
    
}