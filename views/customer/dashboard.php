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
        <h2>Pending</h2>  
          <?php 
          $count = 0;     
          $id = Yii::$app->user->identity->id;            
          foreach($cylinder_booking as $cylinder_bookings){ 
            if(in_array("Pending",$cylinder_bookings) && in_array(Yii::$app->user->identity->id,$cylinder_bookings)){
              $count++;
            }
          }
          ?><?= Html::a($count, ['/cylinder-booking/index','status'=>'Pending'])?>
        </div>  
      </div>
    </div>       
    <div class="col-md-4">
      <div class="panel panel-primary">
        <div class="panel-body">               
          <h2>Process</h2>
          <?php 
            $count = 0;  
            foreach($cylinder_booking as $cylinder_bookings){                   
              if(in_array("Process",$cylinder_bookings) && in_array(Yii::$app->user->identity->id,$cylinder_bookings)){
                $count++;
            }}
          ?><?= Html::a($count, ['/cylinder-booking/index','status'=>'Process'])?>
        </div>
      </div>
    </div>       
    <div class="col-md-4">
      <div class="panel panel-primary">
        <div class="panel-body"> 
          <h2>Delivered</h2> 
          <?php 
            $count = 0;  
            foreach($cylinder_booking as $cylinder_bookings){                   
              if(in_array("Delivered",$cylinder_bookings) && in_array(Yii::$app->user->identity->id,$cylinder_bookings)){
                $count++;
              }
            }
          ?><?= Html::a($count, ['/cylinder-booking/index','status'=>'Delivered'])?>               
        </div>
      </div>
    </div>       
  </div>
</div>    