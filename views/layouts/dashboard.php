<?php

    /* @var $this \yii\web\View */
    /* @var $content string */

    use app\widgets\Alert;
    use yii\helpers\Html;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\widgets\Breadcrumbs;
    use app\assets\DashboardAsset;
    use app\components\Helper;

    DashboardAsset::register($this);
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
    <body class="nav-md">
        <?php $this->beginBody() ?>
            <div class="container body main_container ">    
                <?= $this->render('../include/theme/header_menu'); ?>
                <?= $this->render('../include/theme/sidebar'); ?> 
                <div class="right_col" role="main" style="min-height: 1267.99px;">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                    <?= $content ?>
                </div>
                <?= $this->render('../include/theme/footer'); ?>
            </div>        
          
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>