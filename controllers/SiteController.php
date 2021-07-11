<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\CylinderList;
use app\components\Helper;

class SiteController extends Controller
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
                        'actions' => ['logout','contact','about','login','index','get-cylinder-list-detail'],
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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = "home";
        $supplierList = User::find()->select(['company_name','id','first_name','state','city','phone_number'])->where(['account_type' => ['Supplier']])->asArray()->all();
        return $this->render('index',['supplierList'=>$supplierList]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionGetCylinderListDetail(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();  
            $cylinders = [
                ['cylinder_type' => '5 Litre', 'cylinder_quantity' => 0, 'cylinder_price' => 0],
                ['cylinder_type' => '10 Litre', 'cylinder_quantity' => 0, 'cylinder_price' => 0],
                ['cylinder_type' => '15 Litre', 'cylinder_quantity' => 0, 'cylinder_price' => 0]
            ];

            $cylinderLists = CylinderList::find()->select(['cylinder_type','cylinder_quantity','cylinder_price'])->where(['user_id'=> base64_decode($data['supplierInfo'])])->asArray()->all();
            
            if(count($cylinderLists) > 0){
                $cylinders = $cylinderLists;
            }
            
            return json_encode(['status'=>200,'cylinders'=>$cylinders]);
        }
    }
}
