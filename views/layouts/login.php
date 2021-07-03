<?php

  /* @var $this \yii\web\View */
  /* @var $content string */
  use app\widgets\Alert;
  use yii\helpers\Html;
  use yii\widgets\Breadcrumbs;
  use app\assets\LoginAsset;

  LoginAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
  <head>
    <meta charset="utf-8">
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
        <?= $this->render('../include/header_menu'); ?>
        <div class="container">
          <div class="hold-transition login-page">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
          </div>
        </div>
      </div>
    <?= $this->render('../include/footer'); ?>
    <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>
