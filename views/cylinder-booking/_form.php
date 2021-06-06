<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use app\models\CylinderType;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\CylinderBooking */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="cylinder-booking-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading"><?= Html::encode($this->title) ?></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'first_name')->textInput(['autofocus'=>true,'placeholder'=>'First Name','maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'last_name')->textInput(['autofocus'=>true,'placeholder'=>'Last Name','maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        <?php $data = array('Positive'=>'Positive','Negative'=>'Negative')?>
                                <?= $form->field($model, 'covid_test_result')->widget(Select2::classname(), [
                                        'data' => $data,                                        
                                        'options' => ['placeholder' => 'Select Identity Proof'],
                                        'pluginOptions' => ['allowClear' => true],  
                                    ]); 
                                    ?> 
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'covid_test_date')->widget(DatePicker::className(),
                                [
                                    // inline too, not bad
                                    'inline' => false,
                                    // modify template for custom rendering
                                    // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                    'clientOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd'
                                    ]
                                ]); 
                            ?> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'cylinder_type')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(CylinderType::find()->all(),'liter','liter'),                                        
                                'options' => ['placeholder' => 'Select Cylinder Types'],
                                'pluginOptions' => ['allowClear' => true],  
                            ]);?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'cylinder_quantity')->textInput(['maxlength' => true,'type' => 'number','min'=>1,'max'=>5]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'total_amount')->textInput(['readOnly'=>true,'maxlength' => true]) ?>
                        </div>        
                        <div class="col-md-6">
                            <?= $form->field($model, 'order_date')->widget(DatePicker::className(),
                                [
                                    // inline too, not bad
                                    'inline' => false,
                                    // modify template for custom rendering
                                    // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                    'clientOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd'
                                    ]
                                ]); 
                            ?> 
                        </div>                            
                    </div>                            
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    <?php ActiveForm::end(); ?>
</div>