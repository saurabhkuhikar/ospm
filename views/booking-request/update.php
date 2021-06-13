<?php

use yii\helpers\Html;
use yii\web\NotFoundHttpException;
/* @var $this yii\web\View */
/* @var $model app\models\BookingRequest */

$this->title = 'Update Booking Request: ' . $model->id;
?>
<div class="booking-request-update">

    <?php 
        if($model->order_status != "Delivered"){
            echo $this->render('_form',[
            'model' => $model,
            ]);            
        }else{
            throw new NotFoundHttpException('Your customer order is Successfully delivered.');
        }
        
    ?>
</div>
