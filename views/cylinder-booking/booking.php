<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use dosamigos\datepicker\DatePicker;
    use app\models\CylinderType;
    use yii\helpers\ArrayHelper;
    use kartik\select2\Select2;
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
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="active" id="account"><strong>Cylinder Details</strong></li>
                            <li id="personal"><strong>COVID Details</strong></li>
                            <li id="payment"><strong>Cart Details</strong></li>
                            <li id="confirm"><strong>Payment</strong></li>
                        </ul> 

                        <div id="msform" data-token=<?= (isset($token))? $token: Null?>>
                            <!-- fieldsets -->

                            <fieldset>
                                <?php $form = ActiveForm::begin(['id'=>'formCylinderDetails','action'=>'cylinder-booking/save-cylinder-detail']); ?>
                                    <div class="form-card">
                                        <h2 class="fs-title">Cylinder Details</h2>
                                        <div class="panel-details">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <?= $form->field($model, 'cylinder_type_id')->widget(Select2::classname(), [
                                                            'data'=>ArrayHelper::map(CylinderType::find()->all(),'id',function($litre){return $litre->litre_quantity.' '.$litre->label;}),                                        
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
                                        </div>
                                    </div> 
                                    <input type="button" class="save_cylinder_details btn btn-info" value="Next Step" />
                                <?php ActiveForm::end(); ?>
                            </fieldset>

                            <fieldset>
                                <?php $form = ActiveForm::begin(['id'=>'formCovidDetails','action'=>'']); ?>
                                    <div class="form-card">
                                        <h2 class="fs-title">COVID Details</h2> 
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="panel-details">
                                                    <?php $data = array('Positive'=>'Positive','Negative'=>'Negative')?>
                                                    <?= $form->field($model, 'covid_test_result')->widget(Select2::classname(), [
                                                        'data' => $data,                                        
                                                        'options' => ['placeholder' => 'Select Identity Proof','autocomplete'=>'off',],
                                                        'pluginOptions' => ['allowClear' => true],]); 
                                                    ?> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="panel-details">
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
                                        </div>
                                    </div> 
                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> 
                                    <input type="button" name="next" class="next action-button" value="Next Step" />
                                <?php ActiveForm::end(); ?>
                            </fieldset>
                            
                            <fieldset>
                                <?php $form = ActiveForm::begin(['id'=>'formCartDetails','action'=>'']); ?>
                                    <div class="form-card">
                                        <h2 class="fs-title">Cart Details</h2>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class = "mt-24">
                                                    <div class = "mb-20">
                                                        <span>Cylinder Type : </span><span id = "cylinderType" class ="txt"></span>
                                                    </div>
                                                    <div class = "mb-20">
                                                        <span>Cylinder Quantity: </span><span id = "cylinderQuantity" class ="txt"></span>
                                                    </div>
                                                    <div class = "mb-20">
                                                        <span>Order Date : </span><span id = "orderDate" class ="txt"></span>
                                                    </div>
                                                    <div class = "mb-20">
                                                        <span>GST : </span><span id = "GST_value" class ="txt"></span>
                                                    </div>
                                                    <div class = "mb-20">
                                                        <span>SGST : </span><span id = "SGST_value" class ="txt"></span>  
                                                    </div>
                                                    <div class = "mb-20">
                                                        <span>CGST : </span><span id = "CGST_value" class ="txt"></span>
                                                    </div>
                                                    <div class = "mb-20">
                                                        <span class = "totalAmountLabel">Total amount : </span><span class ="right" id ="cylinderbooking-total_amount"></span>
                                                        <?= $form->field($model, 'token')->hiddenInput(['readOnly'=>true,'maxlength' => true,'value' => $token])->label(false) ?> 
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                    </div> 
                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> 
                                    <input type="button" name="next" class=" next action-button-conform" value="Conform" />
                                <?php ActiveForm::end(); ?>
                            </fieldset>
                            
                            <fieldset>
                                <?php $form = ActiveForm::begin(['id'=>'formPaymentInformation','action'=>'']); ?>
                                    <div class="form-card">                                    
                                        <h2 class="fs-title ">Payment Information</h2>
                                        <div class = "panel-details">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12"> 
                                                        <label for="">Select Payment Mode</label>
                                                        <?= $form->field($model, 'payment_option')->radioList(['Cash on Delivery'=>'Cash on Delivery', 'Online' => 'Online'], ['unselect' => null])->label(false)?>
                                                    </div>                        
                                                </div>                        
                                            </div>         
                                            <div class="right mt-24">
                                                <span >Total amount : </span><span  class="right" id ="cylinderbooking-total-amount"></span>
                                            </div>                              
                                        </div>
                                    </div>
                                    <?= Html::submitButton('Placed Order', ['class' => 'btn btn-lg btn-success', 'name' => 'payment-option-button']) ?>
                                <?php ActiveForm::end(); ?>
                            </fieldset>
                        </div>
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