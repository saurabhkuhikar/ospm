<?php

namespace app\models;

use Yii;
use app\models\States;
/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $city_name
 * @property int $state_id
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
            [['city_name', 'state_id'], 'required'],
            [['state_id'], 'integer'],
            [['city_name'], 'string', 'max' => 255],
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
            'state_id' => 'State ID',
        ];
    }
     /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStates()
    {
        return $this->hasMany(States::className(), ['id' => 'state_id',]);
    }
}
