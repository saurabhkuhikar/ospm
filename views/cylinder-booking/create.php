<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CylinderBooking */

$this->title = 'Cylinder Booking';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cylinder-booking-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
