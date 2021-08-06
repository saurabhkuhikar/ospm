<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\CylinderBooking */

$this->title = "Online Payment";
// $this->params['breadcrumbs'][] = ['label' => 'Cylinder Bookings', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
// \yii\web\YiiAsset::register($this);
?>
<div class="online-payment">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-5">
            <div class="panel">
                <div class="panel-heading"><?= Html::encode($this->title) ?></div>
                <div class="panel-body">                
                    <?php $form = ActiveForm::begin(); ?>                    
                        <div class="row">
                            <div class="col-md-12">                        
                                <div class="form-group">
                                    <h3>Payment</h3>
                                    <label for="fname">Accepted Cards</label>
                                    <div class="icon-container">
                                        <i class="fa fa-cc-visa" style="color:navy;font-size:50px;"></i>
                                        <i class="fa fa-cc-amex" style="color:blue;font-size:50px;"></i>
                                        <i class="fa fa-cc-mastercard" style="color:red;font-size:50px;"></i>
                                        <i class="fa fa-cc-discover" style="color:orange;font-size:50px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-12">  
                                <div class="form-group"> 
                                    <label for="ccnum">Credit card number</label>
                                    <div class="input-group">
                                        <input type="text"  class="form-control" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">  
                                <div class="form-group"> 
                                    <label for="expmonth">Exp Month</label>
                                    <input type="text"  class="form-control" id="expmonth" name="expmonth" placeholder="September">
                                </div>
                            </div>
                        </div>
                            
                        <div class="row">                                                          
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expyear">Exp Year</label>
                                    <input type="number" class="form-control"  id="expyear" name="expyear" placeholder="2018">
                                </div>
                            </div>    
                            <div class="col-md-6">
                                <div class="form-group">                                        
                                    <label for="cvv">CVV</label>
                                    <input type="text" class="form-control" id="cvv" name="cvv" placeholder="352">
                                </div>
                            </div>   
                            <div class="col-md-12">  
                                <div class="form-group">                            
                                    <label for="cname">Name on Card</label>
                                    <input type="text" class="form-control" id="cname" name="cardname" placeholder="John More Doe">
                                </div>    
                            </div>                    
                        </div>           
                        <div class="row">                       
                            <div class="col-md-12">
                                <div class="mt-20">  
                                    <?= Html::submitButton('Submit', ['class' => 'btn btn-success form-control', 'name' => 'payment-button']) ?>
                                </div>                       
                            </div>                       
                        </div>
                    <?php ActiveForm::end(); ?>               
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>