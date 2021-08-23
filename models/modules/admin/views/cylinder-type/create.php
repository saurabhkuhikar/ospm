<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\CylinderType */

$this->title = 'Create Cylinder Type';
$this->params['breadcrumbs'][] = ['label' => 'Cylinder Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cylinder-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
