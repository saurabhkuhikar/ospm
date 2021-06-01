<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CylinderType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cylinder-type-form">
<div class="col-md-2"></div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading"><?= Html::encode($this->title) ?></div>
            <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?= $form->field($model, 'liter')->textInput() ?>   
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
    <?php ActiveForm::end(); ?>
</div>
