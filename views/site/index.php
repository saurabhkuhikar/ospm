<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>       
<div class="container">
    <div class="row">
    <?php 
       foreach($supplierTable as $supplierTable)
       {?>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading"><span><?= $supplierTable['company_name'] ?></span></div>
                    <div class="panel-body">
                        <table class="table table-bordered center-txt">
                            <thead>
                                <tr>
                                    <th class="center-txt">LTR</th>
                                    <th class="center-txt">QTY</th>
                                </tr>   
                            </thead>                
                            <tbody>
                                <?php foreach($cylinderLists as $cylinderList)
                                {
                                    if($supplierTable['id'] == $cylinderList['user_id']){
                                        ?>
                                        <tr>
                                            <td><?= $cylinderList['cylinder_type'];?> </td>
                                            <td><?= $cylinderList['cylinder_quantity'];?> </td>                                
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>                                                
                            </tbody>
                        </table>                        
                        <div class="row">
                            <div class="center-txt">
                            <?= Html::a('Book', ['/cylinder-booking/create','status'=>base64_encode($supplierTable['id'])], ['class'=>'btn btn-success'])?>
                            </div>                        
                        </div>                       
                    </div>
                </div>
            </div>
        <?php } ?>    
    </div>
</div>    