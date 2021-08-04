<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
                        <!-- <p>
                            <?= Html::a('Create Cylinder Booking', ['create'], ['class' => 'btn btn-success']) ?>
                        </p> -->

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
                                'order_date',
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
