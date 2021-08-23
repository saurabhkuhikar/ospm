<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gst_table".
 *
 * @property int $id
 * @property int $gst
 * @property int $sgst
 * @property int $cgst
 */
class GstTable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gst_table';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gst', 'sgst', 'cgst'], 'required'],
            [['gst', 'sgst', 'cgst'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gst' => 'Gst',
            'sgst' => 'Sgst',
            'cgst' => 'Cgst',
        ];
    }
}
