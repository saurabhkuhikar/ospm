<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CylinderBookingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cylinder-booking-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>



    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'covid_test_result') ?>

    <?php // echo $form->field($model, 'covid_test_date') ?>

    <?php // echo $form->field($model, 'cylinder_type_id') ?>

    <?php // echo $form->field($model, 'cylinder_quantity') ?>

    <?php // echo $form->field($model, 'total_amount') ?>

    <?php // echo $form->field($model, 'order_date') ?>

    <?php // echo $form->field($model, 'order_status') ?>

    <?php // echo $form->field($model, 'payment_id') ?>

    <?php // echo $form->field($model, 'payment_token') ?>

    <?php // echo $form->field($model, 'payment_status') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
