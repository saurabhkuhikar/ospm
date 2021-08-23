<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cylinder_bookings".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $covid_test_result
 * @property string $covid_test_date
 * @property string $cylinder_type_id
 * @property string $cylinder_quantity
 * @property string $total_amount
 * @property string|null $order_date
 * @property string|null $order_status
 * @property string|null $customer_id
 * @property string|null $supplier_id
 * @property string|null $payment_id
 * @property string|null $payment_token
 * @property string|null $payment_status
 * @property string|null $created
 * @property string $updated
 */
class CylinderBooking extends \yii\db\ActiveRecord
{
    public $token;
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
            //[['first_name', 'last_name','payment_option', 'covid_test_result', 'covid_test_date', 'cylinder_type_id', 'cylinder_quantity', 'order_date'], 'required'],
            [[ 'cylinder_type_id', 'cylinder_quantity', 'order_date'], 'required','on'=>'cylinderDetail'],  
            // [[ 'total_amount',], 'required','on'=>'cartDetail'],  
            [[ 'covid_test_result', 'covid_test_date',], 'required','on'=>'covidDetail'],  
            [['payment_option','order_status',], 'required','on'=>'paymentInformation'],  
            // [['payment_option',], 'required','on'=>'paymentOption'],  
            [['covid_test_date','customer_id','supplier_id','order_date', 'total_amount', 'created', 'updated'], 'safe'],
            [[ 'order_status', 'payment_id', 'payment_token', 'payment_status'], 'string', 'max' => 255],
            [['covid_test_result'], 'string', 'max' => 20],
            // [['payment_option'], 'string', 'max' => 100],
            [['cylinder_quantity'],'number','min' => 1,'max' => 5,],
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
            'payment_option' => 'Select Payment Options', 
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
    public function getCylinderTypes()
    {
        return $this->hasOne(CylinderType::className(), ['id' => 'cylinder_type_id']);
    } 
}
