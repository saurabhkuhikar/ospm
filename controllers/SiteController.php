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
use app\models\Cities;
use app\models\States;
use yii\data\Pagination;
use app\models\Search;
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
                        'actions' => ['logout','contact','about','login','index','get-cylinder-list-detail','get-city-list'],
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
        $model = new Search();
        if ($model->load(Yii::$app->request->post())){            
            if(!empty($model->state_name) || !empty($model->city_name)|| !empty($model->search_input) ){
                $user = User::find()->select(['company_name','id','first_name','state','city','phone_number','profile_picture'])->orwhere(['state'=>$model->state_name,])->orwhere(['company_name'=>$model->search_input])->orwhere(['city'=>$model->city_name,'status' => 'Enabled','account_type' => ['Supplier'],]);
            }
            else{
                $user = User::find()->select(['company_name','id','first_name','state','city','phone_number','profile_picture'])->where(['status' => 'Enabled','account_type' => ['Supplier'],]);
            }
        }
        else{
            $user = User::find()->select(['company_name','id','first_name','state','city','phone_number','profile_picture'])->where(['status' => 'Enabled','account_type' => ['Supplier'],]);
        }
        $pagination = new Pagination(['totalCount' => $user->count(),'defaultPageSize' => 6]);        
        $supplierList = $user->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
        
        return $this->render('index',['supplierList'=>$supplierList,'pagination'=>$pagination,'model'=> $model]);
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

    /* Get city list*/
    public function actionGetCityList(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if(isset($_POST['getStateName'])){
                $cityId = States::find()->select('id')->where(['state_name'=>$_POST['getStateName']])->asArray()->one();
                $cityLists = Cities::find()->select('city_name')->where(['state_id'=>$cityId])->asArray()->all();
            }
        }        
        return json_encode(['status'=>200,'cityLists'=>$cityLists]);
    } 
}
