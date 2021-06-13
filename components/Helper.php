<?php

namespace app\components;
use Yii;

use yii\base\Component;
use yii\base\InvalidConfigException;
use app\models\LoginForm;

class Helper extends Component { 

  public static function dd($arg){
    echo "<pre>";
    print_r($arg);
    echo "</pre>";  
    die(); 
  }

  public static function checkAccess($type){           
    if(Yii::$app->user->identity->account_type != $type){        
      throw new \yii\web\NotFoundHttpException('You are not authorised to access this page.');
    }    
  }

  public static function getCurrentUserId(){    
    return Yii::$app->user->identity->id;      
  }
  
} 
?>