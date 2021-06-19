<?php

use yii\helpers\Html;
use yii\web\NotFoundHttpException;
/* @var $this yii\web\View */
/* @var $model app\models\BookingRequest */

$this->title = 'Update Booking Request: ' . $model->id;
?>
<div class="booking-request-update">
    <?= $this->render('_form',[
        'model' => $model,
        ]); 
    ?>
</div>
