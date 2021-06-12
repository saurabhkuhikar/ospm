<?php

namespace app\components;
use Yii;

use yii\base\Component;
use yii\base\InvalidConfigException;
use app\models\LoginForm;

class Helper extends Component {
  public static function SetSession($k,$v){
    $session = yii::$app->session;
    return $session->set($k,$v);
  }

  public static function GetSession($k){
    $session = yii::$app->session;
    return $session->get($k);
  }

  public static function dd($arg){
    echo "<pre>";
    print_r($arg);
    echo "</pre>";   
  }
  public static function checkAccess($type){

    if(Yii::$app->user->identity->account_type == $type && $type == "Customer"){
      return Yii::$app->controller->redirect(['customer/dashboard']); 
    }
  
    if(Yii::$app->user->identity->account_type == $type && $type == "Supplier"){
      return Yii::$app->controller->redirect(['supplier/dashboard']);
      
    }
    
  }

  public static function checkLogin(){
    if (Yii::$app->user->isGuest){     
      return $this->redirect(['account/login']); 
    }      
  }
} 
?>