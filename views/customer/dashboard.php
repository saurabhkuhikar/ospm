<?php
  use yii\helpers\Html;
  use app\components\Helper;
  /* @var $this yii\web\View */

  $this->title = 'My Yii Application';
?>   

<div class="container">
  <div class="row">
    <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Cylinders Status</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="tile_count">
        <div class="col-md-2 tile_stats_count">
          <span class="count_top"><i class="fa fa-user"></i> Pending</span>
          <div class="count"><?=$cylinderBookings['pending'] ?></div>
        </div>
        <div class="col-md-2 tile_stats_count">
          <span class="count_top"><i class="fa fa-clock-o"></i> Process </span>
          <div class="count"><?=$cylinderBookings['process'] ?></div>
        </div>
        <div class="col-md-2 tile_stats_count">
          <span class="count_top"><i class="glyphicon glyphicon-ok"></i> Delivered</span>
          <div class="count green"><?=$cylinderBookings['delivered'] ?></div>
        </div>     
      </div>         
      </div>      
    </div>

    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Cylinders Stocks</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content tile_count">
          <div class="chart-container">
            <canvas id="booking_status"></canvas>
          </div>
        </div>
      </div>
    </div> 
  </div>
</div>    

<!-- js file -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>

<?php
  $this->registerJsFile(
    Yii::getAlias('@homeUrl') . '/js/customer_chart.js',
    ['depends' => [\yii\bootstrap\BootstrapAsset::className(), \yii\web\JqueryAsset::className()]]
  );
?>