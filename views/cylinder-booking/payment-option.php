<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model app\models\CylinderBooking */
$this->title = 'Payment Option';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="col-md-2"></div>
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading"><?= Html::encode($this->title) ?></div>
            <div class="panel-body">                
                <?php $form = ActiveForm::begin(); ?>                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= $form->field($model, 'payment_option')->radioList(['Cash on Delivery'=>'Cash on Delivery', 'Online' => 'Online'], ['unselect' => null])?>
                            </div>
                        </div>                        
                    </div>                    
                    <div class="row">
                        <div class="col-md-12">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-success', 'name' => 'payment-option-button']) ?>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>               
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
