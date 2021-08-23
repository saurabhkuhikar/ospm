<?php
 use yii\helpers\Html;
 use yii\widgets\ActiveForm;
 use dosamigos\datepicker\DatePicker;
 use app\models\AuthRule;
 use yii\helpers\ArrayHelper;
 use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <!-- <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?> -->

    <!-- <?= $form->field($model, 'rule_name')->widget(Select2::classname(), [
        'data'=>ArrayHelper::map(AuthRule::find()->all(),'name','name'),  
        'options' => ['placeholder' => 'Select Cylinder Types',],
        'pluginOptions' => ['allowClear' => true],  
    ]);?>   -->
    
    <!-- <?= $form->field($model, 'data')->textarea(['rows' => 6]) ?>   -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
