<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BookingRequest */

$this->title = "View Booking Request Details";
// $this->params['breadcrumbs'][] = ['label' => 'Booking Requests', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="booking-request-view">

<div class="col-md-2"></div>
    <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><?= Html::encode($this->title) ?></div>
                <div class="panel-body">                  

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            // 'id',
                           
                            // 'customer_id',
                            // 'supplier_id',
                            'covid_test_result',
                            'covid_test_date',
                            [
                                'attribute' => 'litre_quantity',
                                'format' => 'html',
                                'label' => 'Cylinder Type',
                                'filterInputOptions' => [
                                    'class'       => 'form-control',
                                    'placeholder' => 'Cylinder Type'
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
                            // 'payment_id',
                            // 'payment_token',
                            // 'payment_status',
                            // 'created',
                            // 'updated',
                        ],
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</div>
