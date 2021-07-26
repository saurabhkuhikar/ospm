<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use app\models\CylinderType;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\CylinderBooking form for customer */
/* @var $form yii\widgets\ActiveForm */

?>
<!-- MultiStep Form -->

<div class="col-md-2"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center">
            <div class="card">
                <h2><strong>Oxygen Cylinder Booking</strong></h2>
                <p>Fill all form field to go to next step</p>
                <div class="row">
                    <div class="col-md-12">
                        <?php $form = ActiveForm::begin(['id'=>'msform']); ?>
                        
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="account"><strong>Cylinder Details</strong></li>
                                <li id="personal"><strong>COVID Details</strong></li>
                                <li id="payment"><strong>Cart Details</strong></li>
                                <li id="confirm"><strong>Payment</strong></li>
                            </ul> <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Cylinder Details</h2>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <?= $form->field($model, 'cylinder_type')->widget(Select2::classname(), [
                                                    'data' => ArrayHelper::map(CylinderType::find()->all(),'id','litre_quantity',),                                        
                                                    'options' => ['placeholder' => 'Select Cylinder Types',],
                                                    'pluginOptions' => ['allowClear' => true],  
                                                ]);?>
                                            </div>
                                            <div class="col-md-6">
                                                <?= $form->field($model, 'cylinder_quantity')->textInput(['maxlength' => true,'class'=>'form-control','autocomplete'=> 'off','placeholder'=>'Enter the Cylinder Quantity','type' => 'number','min'=>1,'max'=>5]) ?>
                                            </div>
                                            <div class="col-md-12">
                                                <?= $form->field($model, 'order_date')->widget(DatePicker::className(),
                                                    [
                                                        // inline too, not bad
                                                        'inline' => false,
                                                        'options' => ['placeholder' => 'Select Order Date ','class'=>'form-control','autocomplete'=> 'off'],
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
                                    </div> 
                                </div> <input type="button" name="next" class="next action-button" value="Next Step" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">COVID Details</h2> 
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php $data = array('Positive'=>'Positive','Negative'=>'Negative')?>
                                            <?= $form->field($model, 'covid_test_result')->widget(Select2::classname(), [
                                                'data' => $data,                                        
                                                'options' => ['placeholder' => 'Select Identity Proof','autocomplete'=>'off',],
                                                'pluginOptions' => ['allowClear' => true],]); 
                                            ?> 
                                        </div>
                                        <div class="col-md-6">
                                            <?= $form->field($model, 'covid_test_date')->widget(DatePicker::className(),
                                                [
                                                    // inline too, not bad
                                                    'inline' => false,
                                                    'options' => ['placeholder' => 'Select Covid Test date ','autocomplete'=>'off',],
                                                    
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
                                </div> <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="next" class="next action-button" value="Next Step" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Cart Details</h2>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class = "mt-24">
                                                <p><strong>View Booking Details</strong></p>
                                                <div>
                                                    <span>Cylinder Type : </span><span id = "cylinderType"></span>
                                                </div>
                                                <div>
                                                    <span>Cylinder Quantity: </span><span id = "cylinderQuantity"></span>
                                                </div>
                                                <div>
                                                    <span>Order Date : </span><span id = "orderDate"></span>
                                                </div>

                                            </div>
                                        </div>  
                                    </div>
                                </div> <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="next" class="next action-button" value="Next Step" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                        <?= $form->field($model, 'total_amount')->textInput(['readOnly'=>true,'maxlength' => true]) ?>
                                        <?= $form->field($model, 'token')->hiddenInput(['readOnly'=>true,'maxlength' => true,'value' => $token])->label(false) ?>

                                    <h2 class="fs-title ">Payment Information</h2> <br><br>
                                    
                                    <div class="row">
                                        <div class="col-md-12">                                           
                                            <?= $form->field($model, 'payment_option')->radioList(['Cash on Delivery'=>'Cash on Delivery', 'Online' => 'Online'], ['unselect' => null])?>
                                        </div>                        
                                    </div> 
                                </div>
                                <?= Html::submitButton('Submit', ['class' => 'btn btn-success', 'name' => 'payment-option-button']) ?>
                            </fieldset>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2"></div>

<!-- js file -->
<?php
  $this->registerJsFile(
    Yii::getAlias('@homeUrl') . '/js/booking_form.js',
    ['depends' => [\yii\bootstrap\BootstrapAsset::className(), \yii\web\JqueryAsset::className()]]
  );
?>