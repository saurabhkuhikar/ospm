<?php
use yii\helpers\Html;
use app\components\Helper;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>   
<div class="container">
  <div class="row">      
      
  </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>

<!-- js file -->
<?php
  $this->registerJsFile(
    Yii::getAlias('@homeUrl') . '/js/supplier_chart.js',
    ['depends' => [\yii\bootstrap\BootstrapAsset::className(), \yii\web\JqueryAsset::className()]]
  );
?>