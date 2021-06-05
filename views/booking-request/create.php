<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BookingRequest */

$this->title = 'Create Booking Request';
$this->params['breadcrumbs'][] = ['label' => 'Booking Requests', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
