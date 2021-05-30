<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CylinderBookings */

// $this->title = 'Create Cylinder Bookings';
$this->params['breadcrumbs'][] = ['label' => 'Cylinder Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cylinder-bookings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
