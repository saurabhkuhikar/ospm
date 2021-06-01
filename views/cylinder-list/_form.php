<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\CylinderType;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\CylinderList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cylinder-list-form">
<?php $form = ActiveForm::begin(); ?>
    <div class="col-md-2"></div>
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading"><?= Html::encode($this->title) ?></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'cylinder_type')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(CylinderType::find()->all(),'liter','liter'),                                        
                            'options' => ['placeholder' => 'Select Cylinder Types'],
                            'pluginOptions' => ['allowClear' => true],  
                        ]); 
                        ?> 
                    </div>
                    <div class="col-md-12">
                    <?= $form->field($model, 'cylinder_quantity')->textInput(['maxlength' => true,'placeholder'=>'Enter the Quantity','type' => 'number','min'=>1,'max'=>50]) ?>

                    </div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'cylinder_price')->textInput(['placeholder'=>'Enter the Cylinder Price','maxlength' => true]) ?>

                    </div>
                </div> 
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
<?php ActiveForm::end(); ?>
</div>
