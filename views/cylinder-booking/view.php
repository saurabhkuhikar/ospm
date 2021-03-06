<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CylinderBooking */

$this->title = "View Booking Details";
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
    <div class="col-md-2"></div>
    <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><?= Html::encode($this->title) ?></div>
                <div class="panel-body">
                <?php if (Yii::$app->session->hasFlash('order success')): ?>
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class = "fa fa-check-circle"></i> Successful!</h4>
                        <?= Yii::$app->session->getFlash('order success') ?>
                    </div>
                <?php endif; ?>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            // 'id',
                        
                            // 'customer_id', 
                            // 'supplier_id',
                            // 'covid_test_result',
                            // 'covid_test_date',
                            'cylinder_type_id',
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
            </div>
        </div>
    </div>
                        <div class="col-md-2"></div>
</div>
