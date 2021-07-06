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
$this->title = 'My Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="panel">
            <div class="panel-heading"><?= Html::encode($this->title) ?></div>
            <div class="panel-body">
                <?php if (Yii::$app->session->hasFlash('success')): ?>
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <?= Yii::$app->session->getFlash('success') ?>
                    </div>
                <?php endif; ?>
                <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data'],'id' => 'update-profile','method' => 'post','action' => '/customer/profile']); ?>
                    
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
                                <?= $form->field($model, 'email')->textInput(['autofocus'=>true,'readonly'=>true,'placeholder'=>'Email']) ?>    
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= $form->field($model, 'phone_number')->textInput(['autofocus'=>true,'readOnly'=>true,'placeholder'=>'Phone Number']) ?>
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
                                <?= $form->field($model, 'age')->textInput(['autofocus'=>true,'placeholder'=>'Age']) ?>
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
                                    'pluginOptions' => ['allowClear' => true],]);
                                ?>   
                            </div>
                        </div>
                    </div>
                    <div class="row">                            
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php $data = array('Adhaar card(UID)'=>'Adhaar card(UID)','Passport'=>'Passport','Driving License'=>'Driving License',
                                'Ration Card with address'=>'Ration Card with address','Pan Card'=>'Pan Card')?>
                                <?= $form->field($model, 'identity_proof')->widget(Select2::classname(), [
                                    'data' => $data,                                        
                                    'options' => ['placeholder' => 'Select Identity Proof'],
                                    'pluginOptions' => ['allowClear' => true],]); 
                                ?>                                   
                            </div> 
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                             <?= $form->field($model, 'identity_proof_type')->fileInput()?>
                             </div>
                        </div>                        
                        <div class="col-md-2 col-md-offset-1">
                            <div class="form-group">
                                <?php if(!empty($model->identity_proof_type)){ ?>                                
                                    <img src='<?= '/upload/indentity_proof_images/'.$model->identity_proof_type; ?>' alt="Profile_img" height = 45px width = 70px>
                                <?php } ?> 
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= $form->field($model, 'aadhar_card_number')->textInput(['autofocus'=>true,'placeholder'=>'Enter your Aadharcard Number']) ?>  
                            </div>
                        </div>                                                                                   
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= Html::submitButton('Update', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>               
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>