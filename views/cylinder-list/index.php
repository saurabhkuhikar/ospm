<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CylinderListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cylinder Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cylinder-list-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Add Cylinder', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
            'cylinder_type',
            'cylinder_quantity',
            'cylinder_price',
            //'created',
            [
                'attribute' => 'created',
                'format' => 'html',
                'label' => 'Created',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Created'
                ],
                'value' => function ($searchModel) {
                    if (isset($searchModel->created) && $searchModel->created !== null) {
                        $createDate = date("d/m/Y", strtotime($searchModel->created));
                        return $createDate;
                    } else {
                        return "";
                    }
                },
            ],
            //'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>