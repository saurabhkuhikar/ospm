<?php

namespace app\components;
use Yii;

use yii\base\Component;
use yii\base\InvalidConfigException;
use app\models\LoginForm;

class Helper extends Component {
  // public static function SetSession($k,$v){
  //   $session = yii::$app->session;
  //   return $session->set($k,$v);
  // }

  // public static function GetSession($k){
  //   $session = yii::$app->session;
  //   return $session->get($k);
  // }

  public static function dd($arg){
    echo "<pre>";
    print_r($arg);
    echo "</pre>";   
  }

  



  public static function checkAccess($type){
    // print_r($type);
    // print_r(Yii::$app->user->identity->account_type);
    // die();
    
    if($type == "Customer"){
     return Yii::$app->getResponse()->redirect(['customer/dashboard']);
    }   
    if($type == "Supplier"){
      Yii::$app->getResponse()->redirect(['supplier/dashboard']);
    }   
       
  }
  public static function getID(){
    
    return Yii::$app->user->identity->id;   
    
  }

  public static function checkLogin(){
    if (Yii::$app->user->isGuest){  
      // $url = 'account/login';
      Yii::$app->getResponse()->redirect('account/login');
    }      
  }
} 
?>