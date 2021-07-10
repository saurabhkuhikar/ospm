<?php
    use yii\helpers\Html;
    /* @var $this yii\web\View */
    $this->title = 'My Yii Application';
?>       

<!-- page content -->
<div role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Supplier list</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_content">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12 text-center clearfix">                
              </div>
              <div class="clearfix"></div>
              <?php  foreach($supplierTable as $supplierTable)
              {?>               
              <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                <div class="well profile_view">
                  <div class="col-sm-12">
                    <h4 class="brief"><i><span><?= $supplierTable['company_name'] ?></span></i></h4>
                    <div class="left col-xs-7">
                      <h2><?= $supplierTable['first_name'] ?></h2>
                      <p><strong>State: </strong><?= $supplierTable['state'] ?></p>
                      <p><strong>City: </strong><?= $supplierTable['city'] ?></p>
                      <ul class="list-unstyled">
                        <li><i class="fa fa-phone"></i><strong> Phone : </strong><?= $supplierTable['phone_number'] ?> </li>                     
                      </ul>
                    </div>
                    <div class="right col-xs-5 text-center">
                      <img src="/upload/profile_pictures/empty_image.png" alt="" class="img-circle img-responsive">
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

                      <button type="button" id = "list" value = "<?= $supplierTable['id'] ?>" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalForm"> <i class="fa fa-user">
                        </i> <i class="fa fa-comments-o"></i> </button>
                        <?= Html::a('Book', ['/cylinder-booking/create','token'=>base64_encode($supplierTable['id'])], ['class'=>'btn btn-primary btn-xs'])?>
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
</div>

<div class="modal fade" id="modalForm" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->     
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Available cylinder lists </h4>
      </div>     
      <table class="table table-bordered center-txt">
        <thead>
            <tr>
                <th class="center-txt">LTR</th>
                <th class="center-txt">QTY</th>
            </tr>   
        </thead>                
        <tbody>
        </tbody>       
      </table>              
    </div>
  </div> 
</div>