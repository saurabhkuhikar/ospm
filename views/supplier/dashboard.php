<?php
use yii\helpers\Html;
use app\components\Helper;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>   
<div class="container">
  <div class="row tile_count">
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Pending</span>
      <div class="count"><?=$bookingRequests['pending'] ?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-clock-o"></i> Process </span>
      <div class="count"><?=$bookingRequests['process'] ?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="glyphicon glyphicon-ok"></i> Delivered</span>
      <div class="count green"><?=$bookingRequests['delivered'] ?></div>
    </div>     
  </div>      
</div>