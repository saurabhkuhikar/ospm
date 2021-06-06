<?php

namespace app\controllers;

use Yii;
use app\models\CylinderBooking;
use app\models\CylinderBookingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
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
        $searchModel = new CylinderBookingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // // print_r($_GET['id']);
        if($_GET['id'] == "Pending"){                
           $searchModel = new CylinderBookingSearch(['order_status'=>'Pending','customer_id'=>Yii::$app->user->identity->id]);
           $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
           return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);
        }
        if($_GET['id'] == "Process"){                
           $searchModel = new CylinderBookingSearch(['order_status'=>'Process','customer_id'=>Yii::$app->user->identity->id]);
           $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
           return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);
        }
        if($_GET['id'] == "Delivered"){                
           $searchModel = new CylinderBookingSearch(['order_status'=>'Delivered','customer_id'=>Yii::$app->user->identity->id]);
           $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
           return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);
        }
        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);
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
        if (!Yii::$app->user->isGuest){
            if(isset($_GET['id'])){
                $model = new CylinderBooking();            
                if ($model->load(Yii::$app->request->post())) {
                    $model->customer_id = \Yii::$app->user->identity->id;
                    $model->supplier_id = $_GET['id'];
                    
                    // return $this->render('/customer/dashboard',['model' => $model]);            
                    $query = (new \yii\db\Query())->select(['user_id','cylinder_type','cylinder_quantity','cylinder_price'])
                            ->from('cylinder_lists')->where(['user_id' => $_GET['id']]);
                    $command = $query->createCommand();
                    $models = $command->queryAll();
                    // print_r($models);
                    foreach($models as $values){
                        if($_GET['id'] === $values['user_id']){  
                            if($model->cylinder_type === $values['cylinder_type']){
                                // print_r($values['cylinder_price']);
                                $totalPrice = $values['cylinder_price'] * $model->cylinder_quantity;
                                // print_r($totalPrice);
                                $model->total_amount = $values['cylinder_price'] * $model->cylinder_quantity;
                            }
                        }
                    }
                
                    if($model->save()){
                        return $this->redirect(['view','id' => $model->id]);
                    }
                }
            }
            return $this->render('create', [
                'model' => $model,
            ]);
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
            $model->customer_id = \Yii::$app->user->identity->id;           
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
