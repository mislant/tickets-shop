<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
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
<body style="background-color: #edeef0;font-family: 'Amatic SC', cursive;">
<?php $this->beginBody() ?>

<div class="wrap">
    <?php echo $this->render('navItems') ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <? if (Yii::$app->user->isGuest): ?>
            <div class='row'
                 style="background-color: #ffffff;border: 1px solid;border-color:transparent;border-radius: 2rem;padding-top: 2rem;padding-bottom: 2rem; ;box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);min-height: 20rem;">
                <div class="col-md-12">
                    <?= $content ?>
                    <?= Alert::widget() ?>
                </div>
            </div>
        <? else: ?>
            <div class="row"
                 style="background-color: #ffffff;border: 1px solid;border-color:transparent;border-radius: 2rem;padding-top: 2rem;padding-bottom: 2rem;box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);min-height: 20rem;">
                <div class="col-md-10">
                    <?= $content ?>
                    <?= Alert::widget() ?>
                </div>
                <div class="col-md-2">
                    <? require 'sideBar.php' ?>
                </div>
            </div>
        <? endif ?>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<?php ?>
