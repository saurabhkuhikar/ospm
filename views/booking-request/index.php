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
    <div class="panel panel-primary">
        <div class="panel-heading">Update Booking</div>
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    // ['class' => 'yii\grid\SerialColumn'],

                    // 'id',
                    'first_name',
                    'last_name',
                    // 'customer_id',
                    // 'supplier_id',
                    //'covid_test_result',
                    //'covid_test_date',
                    'cylinder_type',
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