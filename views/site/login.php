<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="col-md-2"></div>
        <div class="col-md-12">       
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="panel panel-success">
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
                                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?> &nbsp;&nbsp;
                                </div>
                            </div>    
                                <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="col-md-2"></div>
</div>
