<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cylinder_types".
 *
 * @property int $id
 * @property float $liter
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
            [['liter'], 'required'],
            [['liter'], 'string'],
            [['created', 'updated'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'liter' => 'Liter',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
