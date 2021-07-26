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
        $user_data = User::find()->select(['company_name','id','first_name','state','city','phone_number','profile_picture']);
        if ($model->load(Yii::$app->request->post())){            
            if(!empty($model->search_input) && !empty($model->state_name) && !empty($model->city_name)) {
                $user = $user_data->where(['status' => 'Enabled','account_type' => ['Supplier'],'state'=>$model->state_name,'city'=>$model->city_name,])->andwhere(['company_name'=>trim($model->search_input," ")]);
            }
            elseif(!empty($model->state_name) && !empty($model->city_name)){
                $user = $user_data->andwhere(['state'=>$model->state_name,'city'=>$model->city_name,'status' => 'Enabled','account_type' => ['Supplier'],]);
            }
            elseif(!empty($model->search_input)) {                
                $user = $user_data->where(['status' => 'Enabled','account_type' => ['Supplier'],])->andWhere(['like', 'company_name', trim($model->search_input," ")]);
            }else{  
                $user = $user_data->where(['status' => 'Enabled','account_type' => ['Supplier'],]);
            }
            $pagination = new Pagination(['totalCount' => $user->count(),'defaultPageSize' => 6]);        
            $supplierList = $user->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
        }else{
            $user = $user_data->where(['status' => 'Enabled','account_type' => ['Supplier'],]);
            $pagination = new Pagination(['totalCount' => $user->count(),'defaultPageSize' => 6]);        
            $supplierList = $user->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
        }
        if(empty($supplierList)){
            Yii::$app->session->setFlash('error', "No result found");
        }
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
                ['cylinderTypes'=>['litre_quantity' => '5','label'=>'liter'], 'cylinder_quantity' => 0, 'selling_price' => 0],
                ['cylinderTypes'=>['litre_quantity' => '10','label'=>'liter'], 'cylinder_quantity' => 0, 'selling_price' => 0],
                ['cylinderTypes'=>['litre_quantity' => '15','label'=>'liter'], 'cylinder_quantity' => 0, 'selling_price' => 0]
            ];

            $cylinderLists = CylinderList::find()->select(['cylinder_type_id','cylinder_quantity','selling_price'])->where(['user_id'=> base64_decode($data['supplierInfo'])])->joinWith(['cylinderTypes'])->asArray()->all();
            if(count($cylinderLists) > 0){
                $cylinders = $cylinderLists;
            }
            // helper::dd( $cylinders);
            return json_encode(['status'=>200,'cylinders'=>$cylinders]);
        }
    }

    /* Get city list*/
    public function actionGetCityList(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if(isset($_POST['getStateName'])){
                $cityLists = Cities::find()->where(['state_name'=>$_POST['getStateName']])->joinWith('states')->asArray()->all();
            }
        }        
        return json_encode(['status'=>200,'cityLists'=>$cityLists]);
    } 
}
