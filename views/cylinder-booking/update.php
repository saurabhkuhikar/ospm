<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CylinderBooking */

$this->title = 'Update Cylinder Booking: ';
// $this->params['breadcrumbs'][] = ['label' => 'Cylinder Bookings', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="cylinder-booking-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
