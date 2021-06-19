<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Forgot Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">   
  <div class="col-md-2"></div>
  <div class="col-md-12">
    <div class="col-sm-6 col-md-4 col-md-offset-4">
      <div class="panel panel-info">
        <div class="panel-heading">
          <strong>Forgot Password</strong>
        </div></br>
        <p class="col-md-12">You forgot your password? Here you can easily retrieve a new password.</p>
        <div class="panel-body">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="email" class="form-control" placeholder="Email">                  
                  <span><i class="fas fa-envelope"></i></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <?= Html::submitButton('Request new password', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?> &nbsp;&nbsp;
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                <a href="/account/login">Back to Login</a>
                </div>
              </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
      </div>        
    </div>
      <div class="col-md-2"></div>
  </div>
</div>

