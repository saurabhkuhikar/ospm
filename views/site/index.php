<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>       
<div class="container">
    <div class="row">
    <?php 
    // if (Yii::$app->user->isGuest){
       foreach($model as $models)
         { ?>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading"><span><?= $models['company_name'] ?></span></div>
                <div class="panel-body">
                    <table class="table table-bordered center-txt">
                        <thead>
                            <tr>
                                <th class="center-txt">LTR</th>
                                <th class="center-txt">QTY</th>
                            </tr>   
                        </thead>                
                        <tbody>
                        <?php foreach($data as $list)
                            {
                                if($models['id'] == $list['user_id']){
                                ?>
                                <tr>
                                    <td><?= $list['cylinder_type'];?> </td>
                                    <td><?= $list['cylinder_quantity'];?> </td>                                
                                </tr>
                        <?php }}?>                                                
                        </tbody>
                    </table>
                    <?php  if (!Yii::$app->user->isGuest){?>
                    <div class="row">
                        <div class="center-txt">
                         <?= Html::a('Book', ['/cylinder-booking/create','id'=>$models['id']], ['class'=>'btn btn-success'])?>
                        </div>                        
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>    
    </div>
</div>    