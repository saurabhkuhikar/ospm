<?php
  use yii\helpers\Html;
  use app\components\Helper;
  /* @var $this yii\web\View */

  $this->title = 'My Yii Application';
?>   

<!DOCTYPE html>
<html>
 <head>
  <title>Webslesson Tutorial | How to use Morris.js chart with PHP & Mysql</title>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

 </head>
  <body>
    <div class="container">
      <div class="row tile_count">
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Pending</span>
            <div class="count"><?=$cylinderBookings['pending'] ?></div>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Process </span>
            <div class="count"><?=$cylinderBookings['process'] ?></div>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="glyphicon glyphicon-ok"></i> Delivered</span>
            <div class="count green"><?=$cylinderBookings['delivered'] ?></div>
          </div>   
      
          <div class="col-md-6">
          <div class="panel">
            <div class="panel-heading">Stocks Avaliable </div>
              <div class="panel-body">
                <h3 align="center">Stocks Avaliable </h3>      
                <div id="chart"></div>
              </div>
            </div>
          </div>
        </div>  
      </div>      
    </div>    
  </body>
</html>

<script>
$(document).ready(function () { 
  Morris.Bar({
  element: 'chart',
  data: [
    { x: '5 Liter', y:<?= $cylinderBookings['pending'] ?>, },
    { x: '10 Liter', y:<?= $cylinderBookings['process'] ?>,  },
    { x: '15 Liter', y:<?= $cylinderBookings['delivered'] ?>,  },
  ],
  xkey: 'x',
  ykeys: ['y'],
  labels: ['Quantity']
});
});
</script>