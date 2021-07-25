<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\CylinderList;
use app\models\CylinderListSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\Helper;
use app\models\Profile;
use app\models\ExportCylinderStock;
/**
 * CylinderListController implements the CRUD actions for CylinderList model.
 */
class CylinderListController extends Controller
{
   /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index','view','create','update','delete','relation'],
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','delete','relation'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CylinderList models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'dashboard';
        $searchModel = new CylinderListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new ExportCylinderStock();
        if ($model->load(Yii::$app->request->post()) ) {
            if(!empty($model->export_list)){
                $stock_data = '';
                $stock_data .='
                <table bordered="1"> 
                <tr>                         
                    <th>Cylinder Quantity</th>
                    <th>Selling Price</th>
                </tr>';

                $model->export_list == "All" ? $cylinder_lists = CylinderList::find()->where(['user_id'=>Helper::getCurrentUserId(),])->all()               
                :$cylinder_lists = CylinderList::find()->where(['user_id'=>Helper::getCurrentUserId(),'cylinder_type_id'=>$model->export_list])->all();
                

                foreach($cylinder_lists as $cylinder_list){
                    $stock_data .='
                    <tr>                    
                    <td>'.$cylinder_list->cylinder_quantity.'</td>
                    <td>'.$cylinder_list->selling_price.'</td>                    
                    </tr>';
                }
                $stock_data .='</table>';
                // Helper::dd($stock_data);
                header("Content-Type: application/xls");
                header("Content-Disposition:attachment; filename=CylinderStocksAvaliable.xls");
                return $stock_data;
            }
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,
        ]);
    }

    /**
     * Displays a single CylinderList model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = 'dashboard';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CylinderList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {        
        $this->layout = 'dashboard';
        $model = new CylinderList();
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Helper::getCurrentUserId();
            $cylinderLists = CylinderList::find()->where(['cylinder_type'=>$model->cylinder_type,'user_id'=>Helper::getCurrentUserId()])->one();
            if($model->cylinder_type == $cylinderLists['cylinder_type_id']){
                $cylinderLists->cylinder_quantity = $cylinderLists['cylinder_quantity'] + $model->cylinder_quantity;
                $cylinderLists->selling_price = $model->selling_price;
                $cylinderLists->save();
                return $this->redirect(['view', 'id' => $cylinderLists->id]);
            }            
            if($model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    
    }

    /**
     * Updates an existing CylinderList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout = 'dashboard';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Helper::getCurrentUserId();
           if($model->save()){
               return $this->redirect(['view', 'id' => $model->id]);
           }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CylinderList model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->layout = 'dashboard';
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CylinderList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CylinderList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CylinderList::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}