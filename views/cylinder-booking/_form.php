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
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><?= Html::encode($this->title) ?></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'first_name')->textInput(['autofocus'=>true,'placeholder'=>'First Name','autocomplete'=>'off','maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'last_name')->textInput(['autofocus'=>true,'placeholder'=>'Last Name','autocomplete'=>'off','maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        <?php $data = array('Positive'=>'Positive','Negative'=>'Negative')?>
                                <?= $form->field($model, 'covid_test_result')->widget(Select2::classname(), [
                                        'data' => $data,                                        
                                        'options' => ['placeholder' => 'Select Identity Proof','autocomplete'=>'off',],
                                        'pluginOptions' => ['allowClear' => true],  
                                    ]); 
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
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'cylinder_type')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(CylinderType::find()->all(),'liter','liter'),                                        
                                'options' => ['placeholder' => 'Select Cylinder Types'],
                                'pluginOptions' => ['allowClear' => true],  
                            ]);?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'cylinder_quantity')->textInput(['maxlength' => true,'autocomplete'=> 'off','placeholder'=>'Enter the Cylinder Quantity','type' => 'number','min'=>1,'max'=>5]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'total_amount')->textInput(['readOnly'=>true,'maxlength' => true]) ?>
                            <?= $form->field($model, 'token')->hiddenInput(['readOnly'=>true,'maxlength' => true,'value' => $token])->label(false) ?>
                        </div>        
                        <div class="col-md-6">
                            <?= $form->field($model, 'order_date')->widget(DatePicker::className(),
                                [
                                    // inline too, not bad
                                    'inline' => false,
                                    'options' => ['placeholder' => 'Select Order Date ','autocomplete'=> 'off'],
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
                                <?= Html::submitButton('Next', ['class' => 'btn btn-success','id' => "checkout-button"]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    <?php ActiveForm::end(); ?>
</div>
<?php
  $this->registerJsFile(
    Yii::getAlias('@homeUrl') . '/js/get_total_amount.js',
    ['depends' => [\yii\bootstrap\BootstrapAsset::className(), \yii\web\JqueryAsset::className()]]
  );
?>

<script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Create an instance of the Stripe object with your publishable API key
    var stripe = Stripe("pk_test_51J4ToQSBTVzFci2yjMBcjvGwnXo1KKzlYtOU38tmrS5hRbm6CwehyE9D3y25PowTekGwU6UtTGR9bhHYYHXixJhA00NN197Wqq");
    var checkoutButton = document.getElementById("checkout-button");
    
    checkoutButton.addEventListener("click", function () {
        fetch("/test/create-payment-request", {
            method: "POST"
        })
        .then(function (response) {
            return response.json();
        })
        .then(function (session) {
            return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(function (result) {
            if (result.error) {
                console.log(result.error.message);
            }
        })
        .catch(function (error) {
            console.error("Error:", error);
        });
    });
</script>