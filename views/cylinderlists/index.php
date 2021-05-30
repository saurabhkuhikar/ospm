<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CylinderListsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cylinder Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cylinder-lists-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cylinder Lists', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'cylinder_type',
            'cylinder_quantity',
            'cylinder_price',
            //'created',
            //'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
