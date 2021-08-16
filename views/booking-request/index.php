<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\daterange\DateRangePicker;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BookingRequesttSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Booking Requests';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-request-index">  
    <div class="col-md-2"></div>
    <div class="col-md-12">  
        <div class="panel">
            <div class="panel-heading"><?=$_GET['status']?></div>
            <div class="panel-body">
                <?= Html::a('Excel Export', ['booking-request/export-booking-list','status'=>$_GET['status'],], ['class' => 'btn btn-success mt-24']) ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="/supplier/get-cylinder-status-list?status=<?= $_GET['status'] ?>" class="btn btn-info mt-24"><i class="fa fa-download"></i> Download PDF</a>
                <?= Html::button('PDF Export', ['class' => 'btn btn-dark mt-24','id'=>'cylinderBookOrderStatus']) ?>   
               
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id',                   
                        // 'customer_id',
                        // 'supplier_id',
                        //'covid_test_result',
                        // 'covid_test_date',
                        // 'cylinder_type_id',
                        [
                            'attribute' => 'litre_quantity',
                            'format' => 'html',
                            'label' => 'Cylinder Type',
                            'filterInputOptions' => [
                                'class'       => 'form-control',                                
                            ],
                            'value' => function ($model) {                         
                                if (isset($model->cylindertypes->litre_quantity) && $model->cylindertypes->litre_quantity !== null) {
                                    return $model->cylindertypes->litre_quantity.' '.$model->cylindertypes->label;
                                } else {
                                    return "";
                                }
                            },
                        ],
                        'cylinder_quantity',
                        'total_amount',
                        // 'order_date',
                        [
                            'attribute'=>'order_date',
                            'value' => function($searchModel) {                                   
                                if (isset($searchModel->order_date) && $searchModel->order_date !== null) {
                                    /*$d = $searchModel->created_date;
                                    $expDate = explode('-',$d);
                                    $dbDate = $expDate[2].'-'.$expDate[1].'-'.$expDate[0]; 
                                    return $dbDate;*/
                                    return $searchModel->order_date;
                                } else {
                                    return "";
                                }
                            },
                            'filter'=>DateRangePicker::widget([
                                'model'=>$searchModel,
                                'attribute'=>'order_date',
                                'convertFormat'=>true,
                                'pluginOptions'=>[
                                    //'timePicker'=>true,
                                    //'timePickerIncrement'=>30,
                                    'locale'=>[
                                        'format'=>'Y-m-d'
                                    ]
                                ],
                            ]),
                        ],
                        'order_status',
                        //'payment_id',
                        //'payment_token',
                        //'payment_status',
                        //'created',
                        //'updated',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>

<!-- Availble Cylinders popup :: start -->

<div id="orderStatusModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Export Cylinders Stock</h4>
         </div>
        <div class="modal-body">
        <?php $form = ActiveForm::begin(['action'=>'cylinder-booking-status-pdf','method'=>'post']); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group"> 
                        <label for="cylinderType">Select Order Date</label>                       
                        <?= DatePicker::widget([
                            'name' => 'order_date',
                            'id' => 'orderDate',
                            'value' => '',
                            'options' => ['placeholder' => 'Select Order Date ','autocomplete'=> 'off'],
                            'template' => '{addon}{input}',
                                'clientOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                            ]);
                        ?> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 mt-24">
                        <?= Html::SubmitButton('Download', ['class' => 'btn btn-success','id'=>'export_btn']) ?>
                    </div>  
                </div>
            </div>
            <?php if (Yii::$app->session->hasFlash('fail')): ?>
                <div class="alert alert-error alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?= Yii::$app->session->getFlash('fail') ?>
                </div>
            <?php endif; ?>
            <p class="error-message"></p>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<!-- Availble Cylinders popup :: End -->

<?php
  $this->registerJsFile(
    Yii::getAlias('@homeUrl') . '/js/order_status_export.js',
    ['depends' => [\yii\bootstrap\BootstrapAsset::className(), \yii\web\JqueryAsset::className()]]
  );
?>