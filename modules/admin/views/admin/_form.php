<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="col-md-2"></div>
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">Add User </div>
                <div class="panel-body">                                     
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                             <?= $form->field($model, 'age')->textInput() ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'profile_picture')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'identity_proof')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>   
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'identity_proof_type')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'aadhar_card_number')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>   
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'account_type')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>  
                    <div class="form-group text-center">
                        <?= Html::submitButton('Save Details', ['class' => 'btn btn-success']) ?>
                    </div>
 
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
