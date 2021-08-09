<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\daterange\DateRangePicker; 


/* @var $this yii\web\View */
/* @var $searchModel app\models\CylinderBookingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cylinder Bookings';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="cylinder-booking-index">
<div class="col-md-2"></div>
    <div class="col-md-12"> 
        <div class="panel">
            <div class="panel-heading"><?= $_GET['status'] ?></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="row">
                            <div class="col-md-6 mt-20 mb-20">
                                <a href="/customer/get-cylinder-booking-status?status=<?= $_GET['status'] ?>" class="btn btn-info bt-lg"><i class="fa fa-download"></i> Download Files</a>
                            </div>                            
                        </div>                 
                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                // 'id',                                
                                // 'supplier_id',
                                // 'customer_id',
                                // 'covid_test_result',
                                //'covid_test_date',
                                // 'cylinder_type_id',
                                [
                                    'attribute' => 'cylinder_type',
                                    'format' => 'html',
                                    'label' => 'Cylinder Type',
                                    'filterInputOptions' => [
                                        'class'       => 'form-control',
                                        'placeholder' => 'Cylinder Type',
                                    ],
                                    'value' => function ($model) {                                          
                                                       
                                        if (isset($model->cylinderTypes->litre_quantity) && $model->cylinderTypes->litre_quantity !== null) {
                                            return $model->cylinderTypes->litre_quantity.' '.$model->cylinderTypes->label;
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

                                // ['class' => 'yii\grid\ActionColumn'],
                            ],
                        ]); ?>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
