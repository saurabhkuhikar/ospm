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
                    <a href="/cylinder-list/create" class="btn btn-info ">Add More Cylinders</a> 
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            // 'id',
                            // 'user_id',
                            [
                                'attribute' => 'litre_quantity',
                                'format' => 'html',
                                'label' => 'Cylinder Type',
                                'filterInputOptions' => [
                                    'class'       => 'form-control',
                                    'placeholder' => 'Cylinder Type'
                                ],
                                'value' => function ($model) {
                                    if (isset($model->cylinderTypes->litre_quantity) && $model->cylinderTypes->litre_quantity !== null) {
                                        return $model->cylinderTypes->litre_quantity.' '.$model->cylinderTypes->label;
                                    } else {
                                        return "";
                                    }
                                },
                            ],
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
