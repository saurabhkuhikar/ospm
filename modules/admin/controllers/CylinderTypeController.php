<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\CylinderType;
use app\modules\admin\models\CylinderTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CylinderTypeController implements the CRUD actions for CylinderType model.
 */
class CylinderTypeController extends Controller
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
     * Lists all CylinderType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CylinderTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CylinderType model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('cylinder-type/view')){ 
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }else{
            throw new NotFoundHttpException('The requested page does not authoried.');
        }
    }

    /**
     * Creates a new CylinderType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if(Yii::$app->user->can('cylinder-type/create')){
            $model = new CylinderType();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }else{
            throw new NotFoundHttpException('The requested page does not authoried.');
        }
    }

    /**
     * Updates an existing CylinderType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        if(Yii::$app->user->can('cylinder-type/update')){

            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }else{
            throw new NotFoundHttpException('The requested page does not authoried.');
        }
    }

    /**
     * Deletes an existing CylinderType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('cylinder-type/delete')){
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }else{
            throw new NotFoundHttpException('The requested page does not authoried.');
        }
    }

    /**
     * Finds the CylinderType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CylinderType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CylinderType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
