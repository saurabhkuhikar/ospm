<?php

namespace app\models;

use Yii;
use app\models\CylinderType;

/**
 * This is the model class for table "cylinder_lists".
 *
 * @property int $id
 * @property string $user_id
 * @property string|null $cylinder_type
 * @property string|null $cylinder_quantity
 * @property string $selling_price
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
            [['selling_price','cylinder_type_id','cylinder_quantity'], 'required'],
            [['created', 'updated'], 'safe'],
            [['cylinder_type_id', ], 'string', 'max' => 255],
            [['user_id'],'number'],
            [['selling_price','cylinder_quantity'], 'number'],
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
            'cylinder_type_id' => 'Cylinder Type',
            'cylinder_quantity' => 'Cylinder Quantity',
            'selling_price' => 'Selling  Price',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getCylinderTypes()
    {
        return $this->hasOne(CylinderType::className(), ['id' => 'cylinder_type_id']);
    } 
}