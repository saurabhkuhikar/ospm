<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "suppliers".
 *
 * @property int $id
 * @property string $cylinder_type
 * @property string $cylinder_price
 * @property string $cylinder_status
 * @property string $created
 * @property string $updated
 */
class Suppliers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'suppliers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cylinder_type', 'cylinder_price', 'cylinder_status'], 'required'],
            [['created', 'updated'], 'safe'],
            [['cylinder_type','cylinder_quantity'], 'string', 'max' => 255],
            [['cylinder_price'], 'string', 'max' => 50],
            [['cylinder_status'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cylinder_type' => 'Cylinder Type',
            'cylinder_quantity' => 'Cylinder Quantity',
            'cylinder_price' => 'Cylinder Price',
            'cylinder_status' => 'Cylinder Status',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
