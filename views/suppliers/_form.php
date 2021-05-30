<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Suppliers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="suppliers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cylinder_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cylinder_quantity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cylinder_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cylinder_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
