<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "states".
 *
 * @property int $id
 * @property string $country_name
 * @property string $state_name
 */
class States extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'states';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_name', 'state_name'], 'required'],
            [['country_name'], 'string', 'max' => 255],
            [['state_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_name' => 'Country Name',
            'state_name' => 'State Name',
        ];
    }
}