<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $city_name
 * @property string $state_name
 * @property string $country_name
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_name', 'state_name', 'country_name'], 'required'],
            [['city_name'], 'string', 'max' => 50],
            [['state_name', 'country_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_name' => 'City Name',
            'state_name' => 'State Name',
            'country_name' => 'Country Name',
        ];
    }
}
