<?php

namespace app\models;

use Yii;
use app\models\CylinderType;

/**
 * This is the model class for table "cylinder_bookings".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $customer_id
 * @property string|null $supplier_id
 * @property string $covid_test_result
 * @property string $covid_test_date
 * @property string $cylinder_type
 * @property string $cylinder_quantity
 * @property string $total_amount
 * @property string $order_date
 * @property string|null $order_status
 * @property string|null $payment_id
 * @property string|null $payment_token
 * @property string|null $payment_status
 * @property string $created
 * @property string $updated
 */
class BookingRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cylinder_bookings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() 
    {
        return [
            [['order_status'], 'required'],
            [['covid_test_date','payment_option', 'order_date','customer_id', 'supplier_id','created', 'updated'], 'safe'],
            [['cylinder_type', 'order_status', 'payment_id', 'payment_token', 'payment_status'], 'string', 'max' => 255],
            [['covid_test_result', ], 'string', 'max' => 20],
            [['total_amount','cylinder_quantity'], 'number'],
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
            'supplier_id' => 'Supplier ID',
            'covid_test_result' => 'Covid Test Result',
            'covid_test_date' => 'Covid Test Date',
            'cylinder_type_id' => 'Cylinder Type',
            'cylinder_quantity' => 'Cylinder Quantity',
            'total_amount' => 'Total Amount',
            'order_date' => 'Order Date',
            'order_status' => 'Order Status',
            'payment_id' => 'Payment ID',
            'payment_token' => 'Payment Token',
            'payment_status' => 'Payment Status',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getCylindertypes()
    {
        return $this->hasOne(CylinderType::className(), ['id' => 'cylinder_type_id']);
    }

}
