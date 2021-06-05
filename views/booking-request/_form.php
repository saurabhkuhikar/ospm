<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\BookingRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="booking-request-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">Update Booking</div>
                <div class="panel-body">
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
