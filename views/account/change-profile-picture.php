<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Change Profile Picture';
$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="col-md-2"></div>
    <div class="col-md-12">
        <div class="panel ">
            <div class="panel-heading">
            <strong>Change Profile Picture</strong>
            </div>
            <div class="panel-body">
            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?= $form->field($model, 'profile_picture')->fileInput()?>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <?= Html::submitButton('Change Profile', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?> &nbsp;&nbsp;
                    </div>
                </div>
                </div>            
            <?php ActiveForm::end(); ?>
            </div>
        </div>        
    </div>
<div class="col-md-2"></div>
</body>
</html>