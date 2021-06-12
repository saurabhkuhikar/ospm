<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CylinderBooking */

$this->title = $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Cylinder Bookings', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
// \yii\web\YiiAsset::register($this);
?>
<div class="cylinder-booking-view">

    <!-- <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'first_name',
            'last_name',
            // 'customer_id', 
            // 'supplier_id',
            'covid_test_result',
            'covid_test_date',
            'cylinder_type',
            'cylinder_quantity',
            'total_amount',
            // 'order_date',
            // 'order_status',
            // 'payment_id',
            // 'payment_token',
            // 'payment_status',
            // 'created',
            // 'updated',
        ],
    ]) ?>

</div>