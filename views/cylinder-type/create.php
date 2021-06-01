<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CylinderType */

$this->title = 'Add Cylinder Type';
$this->params['breadcrumbs'][] = ['label' => 'Cylinder Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cylinder-type-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
