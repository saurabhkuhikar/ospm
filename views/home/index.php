<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CylinderBookingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cylinder Bookings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cylinder-bookings-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cylinder Bookings', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'last_name',
            // 'user_id',
            // 'covid_test_result',
            // 'covid_test_date',
            'cylinder_type',
            'cylinder_quantity',
            'total_amount',
            'order_date',
            'order_status',
            //'payment_id',
            //'payment_token',
            'payment_status',
            //'created',
            //'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
