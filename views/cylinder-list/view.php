<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CylinderList */

$this->title = 'Updated Cylinder list';
// $this->params['breadcrumbs'][] = ['label' => 'Cylinder Lists', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
// \yii\web\YiiAsset::register($this);
// ?>
<div class="cylinder-list-view">
<div class="col-md-2"></div>
    <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><?= Html::encode($this->title) ?></div>
                <div class="panel-body"> 

                                       
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            // 'id',
                            // 'user_id',
                            'cylinder_type_id',
                            'cylinder_quantity',
                            'selling_price',
                            'created',
                            'updated',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
