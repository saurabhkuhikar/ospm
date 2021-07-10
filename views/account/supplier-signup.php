<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\States;
use app\models\Cities;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
// $this->title = 'Supplier Signup Form';
// $this->params['breadcrumbs'][] = $this->title;
?> 
 
<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
<div class="col-md-2"></div>
<div class="col-md-8 col-lg-8">
    <div class="wrap d-md-flex">
        <div class="col-md-12">
            <div class="d-flex">
                <div class="w-100">
                 <h3 class="hd">Supplier Signup</h3>
                </div>            
            </div> 
            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>
            <?php $form = ActiveForm::begin(['id' => 'register-form']); ?>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $form->field($model, 'first_name')->textInput(['autofocus' => true,'placeholder' => 'First Name']) ?>    
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $form->field($model, 'last_name')->textInput(['autofocus' => true,'placeholder' => 'Last Name']) ?>    
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $form->field($model, 'email')->textInput(['autofocus'=>true,'placeholder'=>'Email']) ?>    
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                                <?= $form->field($model, 'phone_number')->textInput(['autofocus'=>true,'placeholder'=>'Phone Number']) ?>    
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $form->field($model, 'gender')->radioList(['male'=>'male', 'female' => 'female'], ['unselect' => null])?>
                            </div>  
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <?= $form->field($model, 'aadhar_card_number')->textInput(['autofocus'=>true,'placeholder'=>'Enter your Aadharcard Number']) ?>  
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?= $form->field($model, 'company_name')->textInput(['autofocus'=>true,'placeholder'=>'Enter Your Company Name','autocomplete' => 'offgg']) ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?= $form->field($model, 'address')->textInput(['autofocus'=>true,'placeholder'=>'Enter the Address','autocomplete' => 'offgg']) ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $form->field($model, 'state')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(States::find()->all(),'state_name','state_name'),
                                'options' => ['placeholder' => 'Select States'],
                                'pluginOptions' => ['allowClear' => true],]);
                            ?> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $form->field($model, 'city')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(Cities::find()->all(),'city_name','city_name'),                                        
                                'options' => ['placeholder' => 'Select Cities'],
                                'pluginOptions' => ['allowClear' => true],  
                                ]);
                            ?>   
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?= $form->field($model, 'password')->passwordInput(['autofocus'=>true,'placeholder'=>'Password']) ?>
                        </div>
                    </div>
                </div>  
                <br>                     
                <div class="row">
                    <div class="col-md-12">
                        <?= Html::submitButton('Signup', ['class' => 'form-control btn btn-primary submit px-3', 'name' => 'login-button']) ?>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>                         
        </div>      
    </div>
</div>
<div class="col-md-2"></div>