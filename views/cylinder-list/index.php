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
                            <div class="col-md-12">
                                <p>
                                    <?= Html::a('Add Cylinder', ['create'], ['class' => 'btn btn-success mt-24']) ?>
                                    <!-- <?= Html::a('Excel Export', ['cylinder-list/export-cylinder-stock'], ['class' => 'btn btn-info mt-24']) ?> -->
                                    <?= Html::button('Excel Export', ['class' => 'btn btn-info mt-24','id'=>'supplierInfo']) ?>
                                </p>
                            </div>
                        </div>  
                    
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                // ['class' => 'yii\grid\SerialColumn'],

                                //'id',
                                //'user_id',
                                //'cylinder_type_id',
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


<!-- Availble Cylinders popup :: start -->

<div id="supplierModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Export Cylinders Stock</h4>
         </div>
        <div class="modal-body">
        <?php $form = ActiveForm::begin(['action'=>'/cylinder-list/export-cylinder-stock','method'=>'post']); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group"> 
                        <label for="cylinderType">Cylinder Type</label>                       
                        <?php $data = ['All'=>'All','5'=>'5 liter','10'=>'10 liter','15'=>'15 liter']; ?>
                        <?= Select2::widget([
                            'name'=>'export_type',
                            'id'=>'export_type_value',
                            'data' => $data,                                        
                            'options' => ['placeholder' => 'Select Cylinder Types'],
                            'pluginOptions' => ['allowClear' => true],  
                        ]); 
                        ?> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 mt-24">
                        <?= Html::SubmitButton('Export', ['class' => 'btn btn-success','id'=>'export_btn']) ?>
                    </div>  
                </div>
            </div>
            <p class="error-message"></p>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<!-- Availble Cylinders popup :: End -->

<?php
  $this->registerJsFile(
    Yii::getAlias('@homeUrl') . '/js/cylinder_list_export.js',
    ['depends' => [\yii\bootstrap\BootstrapAsset::className(), \yii\web\JqueryAsset::className()]]
  );
?>