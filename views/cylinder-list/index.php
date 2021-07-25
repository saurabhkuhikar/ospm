<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\CylinderType;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CylinderListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cylinder Lists';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="cylinder-list-index">

    <div class="col-md-2"></div>
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading"><?= Html::encode($this->title) ?></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                    <?= Html::a('Add Cylinder', ['create'], ['class' => 'btn btn-success mt-24']) ?>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <?php $form = ActiveForm::begin(); ?>
                                <?php $data = ['All'=>'All','5'=>5,'10'=>10,'15'=>15]?>
                                <?= $form->field($model, 'export_list')->widget(Select2::classname(), [
                                    'data' =>  $data,                                        
                                    'options' => ['placeholder' => 'Select Cylinder Types'],
                                    'pluginOptions' => ['allowClear' => true,],  
                                    ]); 
                                ?> 
                            </div>
                            <div class="col-md-2">
                                <?= Html::submitButton('Export', ['class' => 'btn btn-success mt-24']) ?>
                            </div>  
                            <?php ActiveForm::end(); ?>
                        </div>  
                    
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                // ['class' => 'yii\grid\SerialColumn'],

                                //'id',
                                //'user_id',
                                'cylinder_type_id',
                                'cylinder_quantity',
                                'selling_price',
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
                </div>
            </div>
        </div>
    </div>
</div>
