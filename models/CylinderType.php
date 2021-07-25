<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cylinder_types".
 *
 * @property int $id
 * @property int $litre_quantity
 * @property string $label
 * @property string $created
 * @property string $updated
 */
class CylinderType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cylinder_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['litre_quantity', 'label'], 'required'],
            [['litre_quantity'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['label'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'litre_quantity' => 'Litre Quantity',
            'label' => 'Label',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
     /**
    * @return \yii\db\ActiveQuery
    */
    public function getCylinderList()
    {
        return $this->hasMany(CylinderList::className(), ['id' => 'litre_quantity']);
    } 
}
