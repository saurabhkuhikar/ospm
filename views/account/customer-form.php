<?php
  use yii\helpers\Html;
  use yii\bootstrap\ActiveForm;
  $this->title = 'Customer Signup';
?>  
 
<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
<div class="col-md-2"></div>
<div class="col-md-8 col-lg-8">
    <div class="wrap d-md-flex">
        <div class="col-md-12">
            <div class="d-flex">
                <div class="w-100">
                 <h3 class="hd">Customer Signup</h3>
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
                <div class="col-md-12">
                    <div class="form-group">
                    <?= $form->field($model, 'password')->passwordInput(['autofocus'=>true,'placeholder'=>'Password']) ?>
                    </div>  
                </div>                            
            </div><br>
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