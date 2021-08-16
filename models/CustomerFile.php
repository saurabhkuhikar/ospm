<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer_files".
 *
 * @property int $id
 * @property int $customer_id
 * @property string $file_name
 */
class CustomerFile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'file_name'], 'required'],
            [['customer_id'], 'integer'],
            [['file_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'file_name' => 'File Name',
        ];
    }
}
