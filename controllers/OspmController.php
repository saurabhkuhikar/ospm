<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\SignupForm;
use app\models\Profile;
//use app\models\CylinderLists;
// use app\models\SupplierForm;
// use app\models\Supplier;



/**
 * OsmpController implements the CRUD actions for Users model.
 */
class OspmController extends Controller
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
                        'actions' => ['logout','dashboard','profile'],
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

        /* Signup form */
        public function actionSignup()
    {
        $model = new SignupForm();

        if($model->load(Yii::$app->request->post()) && $model->signup()){
            return $this->redirect(['/ospm/dashboard']);
            
        }
        return $this->render('signup', ['model' => $model]);
    }
    /* Supplier form */

    // public function actionSupplier()
    // {
    //     $model = new SupplierForm();
    //     Yii::$app->session->setFlash('success','Successfully entered !..');

    //     if($model->load(Yii::$app->request->post()) && $model->supplier()){

    //         return $this->redirect(['/ospm/supplier']);
                        
    //     }
    //     return $this->render('supplier', ['model' => $model]);
    // }
   

     /* dashboard view*/
    public function actionDashboard()
    {
        return $this->render('/ospm/dashboard');
          
    }   

    public function actionProfile()
    {
        $model = $this->findProfile(Yii::$app->user->identity->id); 
        $model->setScenario('updateProfile');
        
        if($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->session->setFlash('success','Profile Updated Successfully'); 
            return $this->redirect(['ospm/profile']);
        }
        return $this->render('profile', ['model' => $model]);
    }        
     

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProfile($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        }       

        throw new NotFoundHttpException('The requested page does not exist.');
    }   

}
