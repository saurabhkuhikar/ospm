<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <nav id="w0" class="navbar-inverse navbar-fixed-top navbar">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#w0-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">My Application</a></div><div id="w0-collapse" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
                <ul id="w1" class="navbar-nav navbar-right nav">                  
                  
                    <?php if (!Yii::$app->user->isGuest){ 
                        if(Yii::$app->user->identity->account_type == "Customer"){?>
                        <li><a href="/site/index">Home</a></li>    
                        <li><a href="/customer/dashboard">Dashboard</a></li>
                        <li><a href="/customer/profile">My Profile</a></li>  
                        <?php }if(Yii::$app->user->identity->account_type == "Supplier")
                        {
                            ?>
                            <li><a href="/cylinder-list/index">Cylinder List</a></li>  
                            <li><a href="/supplier/dashboard">Dashboard</a></li>
                            <li><a href="/supplier/profile">My Profile</a></li>  
                        <?php                                            
                        }
                        ?>                                           
                        <li> 
                            <form action="<?= Yii::getAlias('@homeUrl') .'/site/logout';?>" method="post">
                                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken; ?>">
                                <button type="submit" class="btn btn-link logout">Logout (<?= Yii::$app->user->identity->first_name; ?>)</button>
                            </form>
                        </li>
                    <?php }else{ ?>
                        <li><a href="/site/index">Home</a></li>  
                        <li><a href="/site/contact">Contact</a></li>                  
                        <li><a href="/site/about">About</a></li>
                        <li><a href="/account/customer-signup">Customer SignUp</a></li>
                        <li><a href="/account/supplier-signup">Supplier SignUp</a></li>
                        <li><a href="/account/login">Login</a></li>
                    <?php } ?>                    
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
