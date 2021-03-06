<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\CylinderType;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\BookingRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="booking-request-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="container">
        <div class="col-md-2"></div>
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">Update Booking</div>
                <div class="panel-body">
                                     
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'cylinder_type_id')->widget(Select2::classname(), [
                                'data'=>ArrayHelper::map(CylinderType::find()->all(),'id',function($litre){return $litre->litre_quantity.' '.$litre->label;}),                                        
                                'options' => ['placeholder' => 'Select Cylinder Types',],
                                'pluginOptions' => ['allowClear' => true],  
                            ]);?>                        
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'cylinder_quantity')->textInput(['maxlength' => true,'readOnly'=>true,'type' => 'number','min'=>1,'max'=>5]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'total_amount')->textInput(['readOnly'=>true,'maxlength' => true]) ?>
                        </div>        
                        <div class="col-md-6">
                            <?= $form->field($model, 'order_date')->textInput(['maxlength' => true,'readOnly'=>true]) ?> 
                        </div>                            
                    </div>    
                    <div class="row">
                        <div class="col-md-12">
                            <?php $data = array('Pending'=>'Pending','Process'=>'Process','Delivered'=>'Delivered')?>
                            <?= $form->field($model, 'order_status')->widget(Select2::classname(), [
                                'data' => $data,              
                                'options' => ['placeholder' => 'Select order status'],
                                'pluginOptions' => ['allowClear' => true],  
                                ]); 
                            ?>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
