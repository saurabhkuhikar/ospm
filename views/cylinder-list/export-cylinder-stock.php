<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\CylinderType;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\CylinderList */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Export Cylinder Lists';
?>

<div class="cylinder-list-form">
<?php $form = ActiveForm::begin(); ?>
    <div class="col-md-2"></div>
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading"><?= Html::encode($this->title) ?></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <?php $data = ['All'=>'All','5'=>5,'10'=>10,'15'=>15]; ?>
                        <?= $form->field($model, 'export_list')->widget(Select2::classname(), [
                            'data' => $data,                                        
                            'options' => ['placeholder' => 'Select Cylinder Types'],
                            'pluginOptions' => ['allowClear' => true],  
                        ]); 
                        ?> 
                    </div>                   
                </div> 
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <?= Html::submitButton('Export', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
<?php ActiveForm::end(); ?>
</div>
