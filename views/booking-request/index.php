<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookingRequesttSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Booking Requests';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-request-index">  
    <div class="col-md-2"></div>
    <div class="col-md-12">  
        <div class="panel">
            <div class="panel-heading"><?=$_GET['status']?></div>
            <div class="panel-body">
                <?= Html::a('Excel Export', ['booking-request/export-booking-list','status'=>$_GET['status'],], ['class' => 'btn btn-success mt-24']) ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="/supplier/get-cylinder-status-list?status=<?= $_GET['status'] ?>" class="btn btn-info mt-24"><i class="fa fa-download"></i> Download PDF</a>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id',                   
                        // 'customer_id',
                        // 'supplier_id',
                        //'covid_test_result',
                        // 'covid_test_date',
                        // 'cylinder_type_id',
                        [
                            'attribute' => 'litre_quantity',
                            'format' => 'html',
                            'label' => 'Cylinder Type',
                            'filterInputOptions' => [
                                'class'       => 'form-control',
                                'placeholder' => 'Cylinder Type',
                            ],
                            'value' => function ($model) {                         
                                if (isset($model->cylindertypes->litre_quantity) && $model->cylindertypes->litre_quantity !== null) {
                                    return $model->cylindertypes->litre_quantity.' '.$model->cylindertypes->label;
                                } else {
                                    return "";
                                }
                            },
                        ],
                        'cylinder_quantity',
                        'total_amount',
                        // 'order_date',
                        [
                            'attribute'=>'order_date',
                            'value' => function($searchModel) {                                   
                                if (isset($searchModel->order_date) && $searchModel->order_date !== null) {
                                    /*$d = $searchModel->created_date;
                                    $expDate = explode('-',$d);
                                    $dbDate = $expDate[2].'-'.$expDate[1].'-'.$expDate[0]; 
                                    return $dbDate;*/
                                    return $searchModel->order_date;
                                } else {
                                    return "";
                                }
                            },
                            'filter'=>DateRangePicker::widget([
                                'model'=>$searchModel,
                                'attribute'=>'order_date',
                                'convertFormat'=>true,
                                'pluginOptions'=>[
                                    //'timePicker'=>true,
                                    //'timePickerIncrement'=>30,
                                    'locale'=>[
                                        'format'=>'Y-m-d'
                                    ]
                                ],
                            ]),
                        ],
                        'order_status',
                        //'payment_id',
                        //'payment_token',
                        //'payment_status',
                        //'created',
                        //'updated',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>