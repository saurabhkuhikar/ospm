<?php
  use yii\helpers\Html;
  use app\components\Helper;
  /* @var $this yii\web\View */

  $this->title = 'My Yii Application';
?>       
<div class="container">
  <div class="row">  
    <div class="col-md-4">
      <div class="panel panel-primary">
        <div class="panel-body">                 
        <h2>Pending</h2>  
          <?= Html::a($Pending, ['/cylinder-booking/index','status'=>'Pending'])?>
        </div>  
      </div>
    </div>       
    <div class="col-md-4">
      <div class="panel panel-primary">
        <div class="panel-body">               
          <h2>Process</h2>
          <?= Html::a($Process, ['/cylinder-booking/index','status'=>'Process'])?>
        </div>
      </div>
    </div>       
    <div class="col-md-4">
      <div class="panel panel-primary">
        <div class="panel-body"> 
          <h2>Delivered</h2> 
          <?= Html::a($Delivered, ['/cylinder-booking/index','status'=>'Delivered'])?>               
        </div>
      </div>
    </div>       
  </div>
</div>    