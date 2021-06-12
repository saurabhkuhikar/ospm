<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>       
<div class="container">
  <div class="row">  
    <div class="col-md-4">
      <div class="panel panel-primary">
        <div class="panel-body">                 
          <?php 
            $value = 0;     
            foreach($supplierDashboard as $supplierDashboards){ 
              if(in_array("Pending",$supplierDashboards) && in_array(Yii::$app->user->identity->id,$supplierDashboards)){
              $value++;
            }
          }
          ?>  
          <h2>Pending</h2>  
          <?= Html::a($value, ['/booking-request/index','status'=>'Pending'])?>
        </div>  
      </div>
    </div>       
    <div class="col-md-4">
        <div class="panel panel-primary">
          <div class="panel-body">               
            <h2>Process</h2>
            <?php 
              $value = 0;
              foreach($supplierDashboard as $supplierDashboards){                   
                if(in_array("Process",$supplierDashboards) && in_array(Yii::$app->user->identity->id,$supplierDashboards)){
                  $value++;
                }
              }
            ?> 
              <?= Html::a($value, ['/booking-request/index','status'=>'Process'])?>
          </div>
        </div>
    </div>       
    <div class="col-md-4">
        <div class="panel panel-primary">
          <div class="panel-body"> 
            <h2>Delivered</h2> 
            <?php 
              $value = 0;
              foreach($supplierDashboard as $supplierDashboards){                   
                if(in_array("Delivered",$supplierDashboards) && in_array(Yii::$app->user->identity->id,$supplierDashboards)){
                  $value++;
                }
              }
            ?> 
              <?= Html::a($value, ['/booking-request/index','status'=>'Delivered'])?>               
          </div>
        </div>
    </div>       
  </div>
</div>    