<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>       
<div class="container">
    <div class="row">
    <?php 
       foreach($supplier_table as $supplier_tables)
       {?>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading"><span><?= $supplier_tables['company_name'] ?></span></div>
                    <div class="panel-body">
                        <table class="table table-bordered center-txt">
                            <thead>
                                <tr>
                                    <th class="center-txt">LTR</th>
                                    <th class="center-txt">QTY</th>
                                </tr>   
                            </thead>                
                            <tbody>
                                <?php foreach($cylinder_list as $cylinder_lists)
                                {
                                    if($supplier_tables['id'] == $cylinder_lists['user_id']){
                                    ?>
                                    <tr>
                                        <td><?= $cylinder_lists['cylinder_type'];?> </td>
                                        <td><?= $cylinder_lists['cylinder_quantity'];?> </td>                                
                                    </tr>
                                <?php
                                    }}
                            ?>                                                
                            </tbody>
                        </table>
                        
                            <div class="row">
                                <div class="center-txt">
                                <?= Html::a('Book', ['/cylinder-booking/create','status'=>$supplier_tables['id']], ['class'=>'btn btn-success'])?>
                                </div>                        
                            </div>
                       
                    </div>
                </div>
            </div>
        <?php } ?>    
    </div>
</div>    