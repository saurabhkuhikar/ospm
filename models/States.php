<?php

namespace app\models;
use Yii;
use app\models\Cities;

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
            [['state_name'], 'required'],
            [['country_id'], 'number',],
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
            'country_id' => 'Country id',
            'state_name' => 'State Name',
        ];
    }

     /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStates()
    {
        return $this->hasMany(Cities::className(), ['state_id' => 'id']);
    }
}