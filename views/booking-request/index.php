<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
            <?= Html::a('Export', ['booking-request/export-booking-list','status'=>$_GET['status'],], ['class' => 'btn btn-success mt-24']) ?>
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
                        'order_date',
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