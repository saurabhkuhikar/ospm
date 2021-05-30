<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cylinder_types".
 *
 * @property int $id
 * @property float $litre
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
            [['litre', 'created'], 'required'],
            [['litre'], 'number'],
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
            'litre' => 'Litre',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
