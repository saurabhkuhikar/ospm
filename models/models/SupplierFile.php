<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier_files".
 *
 * @property int $id
 * @property int $supplier_id
 * @property string $file_name
 */
class SupplierFile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supplier_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['supplier_id', 'file_name'], 'required'],
            [['supplier_id'], 'integer'],
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
            'supplier_id' => 'Supplier ID',
            'file_name' => 'File Name',
        ];
    }
}
