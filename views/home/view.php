<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CylinderBookings */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cylinder Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cylinder-bookings-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            'user_id',
            'covid_test_result',
            'covid_test_date',
            'cylinder_type',
            'cylinder_quantity',
            'total_amount',
            'order_date',
            'order_status',
            'payment_id',
            'payment_token',
            'payment_status',
            'created',
            'updated',
        ],
    ]) ?>

</div>
