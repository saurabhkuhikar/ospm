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
$this->title = 'Signup Form';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading"><?= Html::encode($this->title) ?></div>
            <div class="panel-body">
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
                                <?= $form->field($model, 'password')->passwordInput(['autofocus'=>true,'placeholder'=>'Password']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= $form->field($model, 'phone_number')->textInput(['autofocus'=>true,'placeholder'=>'Phone Number']) ?>
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <?= $form->field($model, 'age')->textInput(['autofocus'=>true,'placeholder'=>'Age']) ?>
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
                                    'pluginOptions' => ['allowClear' => true],
                                ]);
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
                            <div class="col-md-6">
                                <div class="form-group">
                                <?= $form->field($model, 'identity_proof')->textInput(['autofocus'=>true,'placeholder'=>'Identity Proof']) ?>  
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <?= $form->field($model, 'aadhar_card_number')->textInput(['autofocus'=>true,'placeholder'=>'Enter your Aadharcard Number']) ?>  
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= $form->field($model, 'account_type')->dropDownList(['Supplier' => 'Supplier', 'Customer' => 'Customer'],['prompt'=>'Select'])?>
                                </div>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>