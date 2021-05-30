<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\CylinderBookings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cylinder-bookings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'covid_test_result')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'covid_test_date')->widget(DatePicker::className(),
                                [
                                    // inline too, not bad
                                    'inline' => false,
                                    // modify template for custom rendering
                                    // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                    'clientOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd'
                                    ]
                                ]); ?>

    <?= $form->field($model, 'cylinder_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cylinder_quantity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_date')->widget(DatePicker::className(),
                                [
                                    // inline too, not bad
                                    'inline' => false,
                                    // modify template for custom rendering
                                    // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                    'clientOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd'
                                    ]
                                ]);?>

    <?= $form->field($model, 'order_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->textInput() ?>
  

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
