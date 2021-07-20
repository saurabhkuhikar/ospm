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
            // [[], 'required'],
            [['state_name','search_input','city_name'], 'safe'],
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
    
}