<?php

namespace app\models;
use Yii;
use app\models\User;

/**
 * This is the model class for table "states".
 *
 * @property int $id
 * @property string $country_name
 * @property string $state_name
 */
class ExportCylinderStock extends \yii\db\ActiveRecord
{
    public $export_list;
   

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['export_list',], 'required' ],
            
            [['export_list'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'export_list' => 'Export Cylinders Stock ',            
        ];
    }   
    
}