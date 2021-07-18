<?php
  use yii\helpers\Html;
  use app\components\Helper;
  use yii\widgets\ActiveForm;
  use app\models\States;
  use app\models\Cities;
  use kartik\select2\Select2;
  use yii\helpers\ArrayHelper;
  use yii\widgets\LinkPager;
  $this->title = 'My Yii Application'; 
  
  
?>       
<?php $form = ActiveForm::begin(['id' => 'login-form']); ?> 
<!-- page content -->
<div role="main">
  <div class="page-title">
    <div class="title_left">
      <h3>Supplier List</h3>
    </div>    <br>
    <div class="title_right">
    
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="city">States</label>
            <?=
              Html::dropDownList('state', null,
              ArrayHelper::map(States::find()->all(), 'state_name', 'state_name'),
              ['id' => 'search-state-name','class'=>'form-control','prompt'=>'- Select state -',
              
            ]);?>
              
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="city">City</label>
            <?=
              Html::dropDownList('state', null,
              ArrayHelper::map(Cities::find()->all(), 'city_name', 'city_name'),
              ['id' => 'search-city-name','class'=>'form-control','prompt'=>'- Select City -']);
            ?>
          </div>          
        </div>
        <div class="col-md-4">
          <div class="alignright">
            <?=
              LinkPager::widget([
              'pagination' => $pagination,
              ]);
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php  ActiveForm::end(); ?>

  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_content">          
          <div class="row">              
            <?php foreach($supplierList as $supplier){ ?>               
              <div class="col-md-4  profile_details">
                <div class="well profile_view">
                  <div class="col-sm-12">
                    <h4 class="brief"><i><span><?=substr($supplier['company_name'],0,31).'...' ?></span></i></h4>
                    <div class="left col-xs-7">
                      <h2><?= $supplier['first_name'] ?></h2>
                      <p ><strong>State: </strong><?=substr($supplier['state'], 0, 10).'...'?></p>
                      <p ><strong>City: </strong><?=substr( $supplier['city'],0,14). '...'?></p>
                      <ul class="list-unstyled">
                        <li><i class="fa fa-phone"></i><strong> Phone : </strong><?= $supplier['phone_number'] ?> </li>                     
                      </ul>
                    </div>
                    <div class="right">
                      <img src="/upload/profile_pictures/<?=$supplier['profile_picture']?>" alt="" class="img-circle img-responsive">
                    </div>
                  </div>
                  <div class="col-xs-12 bottom text-center">
                    <div class="col-xs-12 col-sm-6 emphasis">
                      <p class="ratings">
                        <a>4.0</a>
                        <a href="#"><span class="fa fa-star"></span></a>
                        <a href="#"><span class="fa fa-star"></span></a>
                        <a href="#"><span class="fa fa-star"></span></a>
                        <a href="#"><span class="fa fa-star"></span></a>
                        <a href="#"><span class="fa fa-star-o"></span></a>
                      </p>
                    </div>
                    <div class="col-xs-12 col-sm-6 emphasis">
                      <button type="button" id="supplierInfo"  state-name = "<?= $supplier['state']?>" city-name = "<?= $supplier['city']?>" supplier-data= "<?= base64_encode($supplier['id']) ?>" data-company="<?= $supplier['company_name'] ?>" class="btn btn-success btn-xs">
                        View <i class="fa fa-list"></i> 
                      </button>
                      <?= Html::a('Book', ['/cylinder-booking/create','token'=>base64_encode($supplier['id'])], ['class'=>'btn btn-primary btn-xs'])?>
                    </div>
                  </div>
                </div>
              </div>
            <?php }?>              
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Availble Cylinders popup :: start -->

<div id="supplierModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Available List of Cylinders : <span id="company-name"></span></h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <thead>
            <div>    
              <h4 class="model-inline">State : <span id="supplier-state"></span></h4> &nbsp;&nbsp;&nbsp;
              <h4 class="model-inline">City : <span id="cityName"></span></h4>
            </div><br>
            <tr class="info center-txt">
              <th class="center-txt">LTR</th>
              <th class="center-txt">QTY</th>
              <th class="center-txt">PRICE</th>
            </tr>   
          </thead>                
          <tbody id="cylinders"></tbody>       
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Availble Cylinders popup :: End -->

<?php
  $this->registerJsFile(
    Yii::getAlias('@homeUrl') . '/js/supplier_list.js',
    ['depends' => [\yii\bootstrap\BootstrapAsset::className(), \yii\web\JqueryAsset::className()]]
  );
?>