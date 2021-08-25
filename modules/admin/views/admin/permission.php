<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\AuthItem;
use app\models\AuthAssignment;
use yii\helpers\ArrayHelper;
?>

<div class="user-index">
    <?php $form = ActiveForm::begin(['action'=>'/admin/admin/permission?token='.$token,'method'=>'post',]); ?>
    <div class="col-md-2"></div>
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">User Permission list</div>
            <div class="panel-body">                                                    
                <div class="row">   
                    <div class="col-md-12">
                        <input type="checkbox" name="checkedAll" id="checkedBoxAll" />
                        <label>Select all</label>
                        <div class="row">
                            <div class="col-md-4">  
                                <div class="x_panel">
                                    <h4>Cylinder List</h4> 
                                    <div class="x_title">
                                        <input type="checkbox" name="checkedAll" id="cylinderListAll" />
                                        <label>Select all</label>
                                        <div class="form-group"> 
                                            <input type="checkbox" name="checkbox[]" class="cylinderList" value="<?= $AuthItems['cylinder-list/create'] ?>" <?= array_key_exists($AuthItems['cylinder-list/create'],$authAssignmentItem)? "checked" : ""; ?>>
                                            <label>create</label>
                                        </div>
                                        <div class="form-group">   
                                            <input type="checkbox" name="checkbox[]" class="cylinderList" value="<?= $AuthItems['cylinder-list/update'] ?>" <?= array_key_exists($AuthItems['cylinder-list/update'],$authAssignmentItem)? "checked" : ""; ?>>
                                            <label>update</label>
                                        </div>
                                        <div class="form-group">   
                                            <input type="checkbox" name="checkbox[]" class="cylinderList" value="<?= $AuthItems['cylinder-list/view'] ?>" <?= array_key_exists($AuthItems['cylinder-list/view'],$authAssignmentItem)? "checked" : ""; ?>>                              
                                            <label>view</label>
                                        </div>
                                        <div class="form-group"> 
                                            <input type="checkbox" name="checkbox[]" class="cylinderList" value="<?= $AuthItems['cylinder-list/delete'] ?>" <?= array_key_exists($AuthItems['cylinder-list/delete'],$authAssignmentItem)? "checked" : ""; ?>>                 
                                            <label>delete</label>  
                                        </div>  
                                    </div>    
                                </div>    
                            </div>    
                            <div class="col-md-4"> 
                                <div class="x_panel">
                                    <h4>Cylinder Type</h4> 
                                    <div class="x_title"> 
                                    <input type="checkbox" name="checkedAll" id="cylinderTypeAll" />
                                        <label>Select all</label>
                                        <div class="form-group"> 
                                            <input type="checkbox" name="checkbox[]" class="cylinderType" value="<?= $AuthItems['cylinder-type/create'] ?>" <?= array_key_exists($AuthItems['cylinder-type/create'],$authAssignmentItem)? "checked" : ""; ?>>
                                            <label>create</label>
                                        </div> 
                                        <div class="form-group"> 
                                            <input type="checkbox" name="checkbox[]" class="cylinderType" value="<?= $AuthItems['cylinder-type/update'] ?>" <?= array_key_exists($AuthItems['cylinder-type/update'],$authAssignmentItem)? "checked" : ""; ?>>
                                            <label>update</label>
                                        </div> 
                                        <div class="form-group"> 
                                            <input type="checkbox" name="checkbox[]" class="cylinderType" value="<?= $AuthItems['cylinder-type/view'] ?>" <?= array_key_exists($AuthItems['cylinder-type/view'],$authAssignmentItem)? "checked" : ""; ?>>                              
                                            <label>view</label>
                                        </div> 
                                        <div class="form-group"> 
                                            <input type="checkbox" name="checkbox[]" class="cylinderType" value="<?= $AuthItems['cylinder-type/delete'] ?>" <?= array_key_exists($AuthItems['cylinder-type/delete'],$authAssignmentItem)? "checked" : ""; ?>>                 
                                            <label>delete</label>  
                                        </div>  
                                    </div>  
                                </div>  
                            </div>    
                            <div class="col-md-4">  
                                <div class="x_panel">
                                    <h4>Cylinder Booking</h4> 
                                    <div class="x_title">
                                    <input type="checkbox" name="checkedAll" id="cylinderBookingAll" />
                                        <label>Select all</label>
                                        <div class="form-group"> 
                                            <input type="checkbox" name="checkbox[]" class="cylinderBooking" value="<?= $AuthItems['cylinder-booking/create'] ?>" <?= array_key_exists($AuthItems['cylinder-booking/create'],$authAssignmentItem)? "checked" : ""; ?>>
                                            <label>create</label>
                                        </div> 
                                        <div class="form-group"> 
                                            <input type="checkbox" name="checkbox[]" class="cylinderBooking" value="<?= $AuthItems['cylinder-booking/update'] ?>" <?= array_key_exists($AuthItems['cylinder-booking/update'],$authAssignmentItem)? "checked" : ""; ?>>
                                            <label>update</label>
                                        </div> 
                                        <div class="form-group"> 
                                            <input type="checkbox" name="checkbox[]" class="cylinderBooking" value="<?= $AuthItems['cylinder-booking/view'] ?>" <?= array_key_exists($AuthItems['cylinder-booking/view'],$authAssignmentItem)? "checked" : ""; ?>>                              
                                            <label>view</label>
                                        </div> 
                                        <div class="form-group"> 
                                            <input type="checkbox" name="checkbox[]" class="cylinderBooking" value="<?= $AuthItems['cylinder-booking/delete'] ?>" <?= array_key_exists($AuthItems['cylinder-booking/delete'],$authAssignmentItem)? "checked" : ""; ?>>                 
                                            <label>delete</label>  
                                        </div>  
                                    </div>  
                                </div>  
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="x_panel">
                                    <h4>Booking Request</h4> 
                                    <div class="x_title">
                                        <input type="checkbox" name="checkedAll" id="bookingRequestAll" />
                                        <label>Select all</label>
                                        <div class="form-group"> 
                                            <input type="checkbox" name="checkbox[]" class="bookingRequest" value="<?= $AuthItems['booking-request/create'] ?>" <?= array_key_exists($AuthItems['booking-request/create'],$authAssignmentItem)? "checked" : ""; ?> >
                                            <label>create</label>
                                        </div> 
                                        <div class="form-group"> 
                                            <input type="checkbox" name="checkbox[]" class="bookingRequest" value="<?= $AuthItems['booking-request/update'] ?>" <?= array_key_exists($AuthItems['booking-request/update'],$authAssignmentItem)? "checked" : ""; ?>>
                                            <label>update</label>
                                        </div> 
                                        <div class="form-group"> 
                                            <input type="checkbox" name="checkbox[]" class="bookingRequest" value="<?= $AuthItems['booking-request/view'] ?>" <?= array_key_exists($AuthItems['booking-request/view'],$authAssignmentItem)? "checked" : ""; ?>>                              
                                            <label>view</label>
                                        </div> 
                                        <div class="form-group"> 
                                            <input type="checkbox" name="checkbox[]" class="bookingRequest" value="<?= $AuthItems['booking-request/delete'] ?>" <?= array_key_exists($AuthItems['booking-request/delete'],$authAssignmentItem)? "checked" : ""; ?>>                 
                                            <label>delete</label>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?= Html::SubmitButton('Save', ['class' => 'btn btn-success','name'=>'save_permission',]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<!-- js file -->
<?php
  $this->registerJsFile(
    Yii::getAlias('@homeUrl') . '/js/permission_form.js',
    ['depends' => [\yii\bootstrap\BootstrapAsset::className(), \yii\web\JqueryAsset::className()]]
  );
?>