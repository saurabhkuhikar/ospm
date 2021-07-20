<?php
  use yii\helpers\Html;
  use yii\bootstrap\ActiveForm;
  $this->title = 'Login';
?>  
 
<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
  <div class="row justify-content-center">
    <div class="col-md-12 col-lg-10">
      <div class="wrap d-md-flex">
        <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
          <div class="text w-100">
            <h2>Welcome to OSPM</h2>
            <p>Don't have an account?</p>
            <a href="/account/customer-signup" class="btn btn-white btn-outline-white"> Customer Sign Up</a>
            <a href="/account/supplier-signup" class="btn btn-white btn-outline-white">Supplier Sign Up</a>
          </div>
        </div>
        <div class="login-wrap p-4 p-lg-5">
          <div class="d-flex">
            <div class="w-100">
              <h3 class="mb-4">Sign In</h3>
            </div>            
          </div>                
            <div class="form-group mb-3">
              <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder' => 'Username']) ?>    
            </div>
            <div class="form-group mb-3">
              <?= $form->field($model, 'password')->passwordInput(['autofocus' => true,'placeholder' => 'Password']) ?>
            </div>
            <div class="form-group">
              <?= Html::submitButton('Login', ['class' => 'form-control btn btn-primary submit px-3','id'=>'login-btn', 'name' => 'login-button']) ?>
            </div>
            <div class="form-group d-md-flex">
              <div class="w-50 text-left"></div>
              <div class="w-50 text-md-right">
                <a href="/account/forgot-password">Forgot Password</a>
              </div>
            </div>
        </div>    
      </div>
    </div>
  </div>    
<?php ActiveForm::end(); ?>
<?php
  $this->registerJsFile(
    Yii::getAlias('@homeUrl') . '/js/login.js',
    ['depends' => [\yii\bootstrap\BootstrapAsset::className(), \yii\web\JqueryAsset::className()]]
  );
?>