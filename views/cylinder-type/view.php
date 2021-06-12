<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CylinderType */

$this->title = "View Details";
// $this->params['breadcrumbs'][] = ['label' => 'Cylinder Types', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
// \yii\web\YiiAsset::register($this);
?>
<div class="cylinder-type-view">
<div class="col-md-2"></div>
    <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading"><?= Html::encode($this->title) ?></div>
                <div class="panel-body">
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
                            'liter',
                            'created',
                            'updated',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
<div class="col-md-2"></div>
</div>
