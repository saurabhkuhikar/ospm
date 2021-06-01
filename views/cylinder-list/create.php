<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CylinderList */

$this->title = 'Add Cylinder List';
$this->params['breadcrumbs'][] = ['label' => 'Cylinder Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cylinder-list-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
