<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CylinderLists */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Supplier Form';
?>
<div class="row">
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
                <div class="form-group">
                    <?= $form->field($model, 'cylinder_type')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'cylinder_quantity')->textInput(['maxlength' => true]) ?>
                 </div>
                <div class="form-group">
                    <?= $form->field($model, 'cylinder_price')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'cylinder_status')->textInput(['maxlength' => true]) ?>
                </div>
                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'supplier-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
            
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
