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
use app\models\CylinderList;

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
                'only' => ['logout','index','view','create','update'],
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','delete'],
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
        Helper::checkAccess("Customer"); 
         
        $searchModel = new CylinderBookingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);        
        return $this->render('index', ['searchModel' => $searchModel,'dataProvider' => $dataProvider]);    
       
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
        $decodedId = base64_decode($_GET['status']);
        if(isset($decodedId)){  
            $model = new CylinderBooking();            
            if ($model->load(Yii::$app->request->post())) {
                $model->customer_id = Helper::getCurrentUserId();
                $model->supplier_id = $decodedId;
                
                $cylinderLists = CylinderList::find()->where(['user_id' => $decodedId,'cylinder_type' => $model->cylinder_type])->one();
                $model->total_amount = $cylinderLists->cylinder_price * $model->cylinder_quantity;
            
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
            $model->customer_id = Helper::getCurrentUserId();           
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
