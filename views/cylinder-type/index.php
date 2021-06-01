<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CylinderTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cylinder Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cylinder-type-index">

<div class="col-md-2"></div>
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><?= Html::encode($this->title) ?></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            <?= Html::a('Add Cylinder Type', ['create'], ['class' => 'btn btn-success']) ?>
                        </p>

                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'id',
                                'liter',
                                'created',
                                'updated',

                                ['class' => 'yii\grid\ActionColumn'],
                            ],
                        ]); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
