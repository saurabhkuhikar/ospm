<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CylinderList */

$this->title = 'Update Cylinder List';
// $this->params['breadcrumbs'][] = ['label' => 'Cylinder Lists', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
// ?>
<div class="cylinder-list-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
