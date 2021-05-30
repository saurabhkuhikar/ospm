<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CylinderLists */

// $this->title = 'Create Cylinder Lists';
$this->params['breadcrumbs'][] = ['label' => 'Cylinder Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cylinder-lists-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
