<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\CylinderBooking;
use app\models\CylinderBookingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\Helper;

/**
 * CylinderBookingController implements the CRUD actions for CylinderBooking model.
 */
class CylinderBookingController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['Index','View','Create','Update','Delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CylinderBooking models.
     * @return mixed
     */
    public function actionIndex()
    {
            if(Yii::$app->user->identity->account_type == "Customer"){
            $searchModel = new CylinderBookingSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);        
            return $this->render('index', ['searchModel' => $searchModel,'dataProvider' => $dataProvider]);    
        }else{
            throw new \yii\web\NotFoundHttpException('You are not authorised to access this page.');
        } 
    }

    /**
     * Displays a single CylinderBooking model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CylinderBooking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Helper::checkLogin();
            if(isset($_GET['status'])){
                $model = new CylinderBooking();            
                if ($model->load(Yii::$app->request->post())) {
                    $model->customer_id = Helper::getID();
                    $model->supplier_id = $_GET['status'];
                    
                    $query = (new \yii\db\Query())->select(['user_id','cylinder_type','cylinder_quantity','cylinder_price'])
                            ->from('cylinder_lists')->where(['user_id' => $_GET['status']]);
                    $command = $query->createCommand();
                    $cylinder_lists = $command->queryAll();
                    foreach($cylinder_lists as $cylinder_list){
                        if($_GET['status'] === $cylinder_list['user_id']){  
                            if($model->cylinder_type === $cylinder_list['cylinder_type']){
                                $totalPrice = $cylinder_list['cylinder_price'] * $model->cylinder_quantity;
                                $model->total_amount = $cylinder_list['cylinder_price'] * $model->cylinder_quantity;
                            }
                        }
                    }
                
                    if($model->save()){
                        return $this->redirect(['view','id' => $model->id]);
                    }
                }
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            else{
                throw new \yii\web\NotFoundHttpException('You are not authorised to access this page.');
            } 
        
        return $this->redirect(['account/login']);
    }

    /**
     * Updates an existing CylinderBooking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->customer_id = Helper::getID();           
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CylinderBooking model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CylinderBooking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CylinderBooking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CylinderBooking::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
