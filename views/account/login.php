<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="col-md-2"></div>
    <div class="col-md-12">       
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <strong> Sign in to continue</strong>
                </div>
                <div class="panel-body">
                    <p>Please fill out the following fields to login to account:</p>

                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">                                                                             
                                <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder' => 'Username']) ?>    
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true,'placeholder' => 'Password']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?= Html::submitButton('Login', ['class' => 'btn btn-success btn-block', 'name' => 'login-button']) ?>
                             </div>
                        </div>
                    </div></br>  
                    <div class="row">                          
                        <p class="col-md-12">
                        <a href="/account/forgot-password">I forgot my password</a>
                        </p>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
