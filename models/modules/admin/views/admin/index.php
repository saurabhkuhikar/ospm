<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="col-md-2"></div>
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">User list</div>
            <div class="panel-body">    
                <?php if (Yii::$app->session->hasFlash('permission')): ?>
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <?= Yii::$app->session->getFlash('permission') ?>
                    </div>
                <?php endif; ?>                                  
                <div class="row">   
                    <div class="col-md-12"> 
                        <p>
                            <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
                        </p>
                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                
                                [
                                    'header'=>'Sr No.',
                                    'class' => 'yii\grid\SerialColumn'
                                ],
                            

                                // 'id',
                                'first_name',
                                'last_name',
                                'email:email',
                                // 'password',
                                //'auth_key',
                                //'phone_number',
                                //'age',
                                //'gender',
                                //'address',
                                // 'state',
                                // 'city',
                                'company_name',
                                //'profile_picture',
                                //'identity_proof',
                                //'identity_proof_type',
                                //'aadhar_card_number',
                                'account_type',
                                //'status',
                                //'created',
                                //'updated',

                                ['class' => 'yii\grid\ActionColumn'],
                                [
                                    'label'=>"Permission",
                                    'format'=>'raw',
                                    'value'=>function ($data)
                                    {
                                        return Html::a('View', ['/admin/admin/permission','token'=>base64_encode($data->id)], ['class'=>'btn btn-primary btn-xs']);

                                        // return Html::a(Html::encode('View'),['/admin/admin/permission','id'=>$model->id]);
                                    }

                                ],
                            ],
                        ]); ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
