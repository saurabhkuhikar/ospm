<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cylinder_lists".
 *
 * @property int $id
 * @property string $user_id
 * @property string|null $cylinder_type
 * @property string|null $cylinder_quantity
 * @property string $cylinder_price
 * @property string $created
 * @property string $updated
 */
class CylinderList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cylinder_lists';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cylinder_price'], 'required'],
            [['created', 'updated'], 'safe'],
            [['cylinder_type', ], 'string', 'max' => 255],
            [['user_id'],'number'],
            [['cylinder_price','cylinder_quantity'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'cylinder_type' => 'Cylinder Type',
            'cylinder_quantity' => 'Cylinder Quantity',
            'cylinder_price' => 'Cylinder Price',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
