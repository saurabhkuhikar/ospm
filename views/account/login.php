<?php

  /* @var $this \yii\web\View */
  /* @var $this yii\web\View */
  /* @var $form yii\bootstrap\ActiveForm */
  /* @var $model app\models\LoginForm */
  
  use yii\helpers\Html;
  use yii\bootstrap\ActiveForm;
  
  $this->title = 'Login';
  // $this->params['breadcrumbs'][] = $this->title;
  /* @var $content string */
  use app\widgets\Alert;
  
  use yii\widgets\Breadcrumbs;
  use app\assets\LoginAsset;
	LoginAsset::register($this);
?>  

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5">
            <h2 class="heading-section">Login to OSPM</h2>
        </div>
    </div>
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="wrap d-md-flex">
                <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                    <div class="text w-100">
                        <h2>Welcome to login</h2>
                        <p>Don't have an account?</p>
                        <a href="#" class="btn btn-white btn-outline-white">Sign Up</a>
                    </div>
                </div>
                <div class="login-wrap p-4 p-lg-5">
                    <div class="d-flex">
                        <div class="w-100">
                            <h3 class="mb-4">Sign In</h3>
                        </div>
                        <div class="w-100">
                            <p class="social-media d-flex justify-content-end">
                                <span><i class="fa fa-facebook" aria-hidden="true"></i></span>
                                <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                            </p>
                        </div>
                    </div>                
                    <div class="form-group mb-3">
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder' => 'Username']) ?>    
                    </div>
                    <div class="form-group mb-3">
                        <?= $form->field($model, 'password')->passwordInput(['autofocus' => true,'placeholder' => 'Password']) ?>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton('Login', ['class' => 'form-control btn btn-primary submit px-3', 'name' => 'login-button']) ?>
                    </div>
                    <div class="form-group d-md-flex">
                        <div class="w-50 text-left">                               
                        </div>
                        <div class="w-50 text-md-right">
                            <a href="/account/forgot-password">Forgot Password</a>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>    
    <?php ActiveForm::end(); ?>
</div>


             